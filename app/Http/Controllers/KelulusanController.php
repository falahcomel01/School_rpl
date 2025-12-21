<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Models\Siswa;
use App\Models\AturanKelulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelulusanController extends Controller
{
    /**
     * Dashboard kelulusan dengan grafik dan statistik
     */
    public function dashboard(Request $request)
    {
        $user = auth()->user();
        $activeRole = session('active_role');

        // Inisialisasi variabel untuk scope
        $walikelas = null;
        $siswa = null;
        $orangtua = null;

        // Base query dengan filter berdasarkan role
        $baseQuery = Kelulusan::query();

        // Filter berdasarkan role aktif
        if ($activeRole === 'walikelas') {
            $walikelas = $user->walikelas;
            
            if (!$walikelas) {
                return redirect()->back()->with('error', 'Anda belum ditugaskan sebagai wali kelas');
            }
            
            // Hanya siswa dari kelas yang diampu
            $baseQuery->whereHas('siswa', function($q) use ($walikelas) {
                $q->where('kelas_id', $walikelas->kelas_id);
            });
        } 
        elseif ($activeRole === 'siswa') {
            $siswa = $user->siswa;
            
            if (!$siswa) {
                return redirect()->back()->with('error', 'Data siswa tidak ditemukan');
            }
            
            // Siswa hanya lihat kelulusannya sendiri
            $baseQuery->where('siswa_id', $siswa->id);
        }
        elseif ($activeRole === 'orangtua') {
            $orangtua = $user->orangtua;
            
            if (!$orangtua) {
                return redirect()->back()->with('error', 'Data orang tua tidak ditemukan');
            }
            
            // Orang tua hanya lihat kelulusan anaknya
            $baseQuery->where('siswa_id', $orangtua->siswa_id);
        }
        // Untuk superadmin, tus, kepsek -> lihat semua (no filter)

        // Ambil semua tahun lulus yang tersedia (sesuai role)
        $tahunList = (clone $baseQuery)
            ->select('tahun_lulus')
            ->distinct()
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('tahun_lulus');

        // Filter berdasarkan tahun jika ada
        $tahunFilter = $request->input('tahun');
        
        if ($tahunFilter) {
            $baseQuery->where('tahun_lulus', $tahunFilter);
        }

        // Statistik total lulus dan tidak lulus
        $totalLulus = (clone $baseQuery)->where('status', 'lulus')->count();
        $totalTidakLulus = (clone $baseQuery)->where('status', 'tidak_lulus')->count();

        // Statistik per jurusan (dengan filter role)
        $statsPerJurusanQuery = DB::table('kelulusans')
            ->select(
                DB::raw('COALESCE(jurusans.nama_jurusan, kelulusans.jurusan_legacy) as jurusan'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN kelulusans.status = "lulus" THEN 1 ELSE 0 END) as lulus'),
                DB::raw('SUM(CASE WHEN kelulusans.status = "tidak_lulus" THEN 1 ELSE 0 END) as tidak_lulus')
            )
            ->leftJoin('siswas', 'kelulusans.siswa_id', '=', 'siswas.id')
            ->leftJoin('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->leftJoin('jurusans', 'kelas.jurusan_id', '=', 'jurusans.id');

        // Terapkan filter role
        if ($activeRole === 'walikelas') {
            $statsPerJurusanQuery->where('kelas.id', $walikelas->kelas_id);
        } elseif ($activeRole === 'siswa') {
            $statsPerJurusanQuery->where('kelulusans.siswa_id', $siswa->id);
        } elseif ($activeRole === 'orangtua') {
            $statsPerJurusanQuery->where('kelulusans.siswa_id', $orangtua->siswa_id);
        }

        $statsPerJurusan = $statsPerJurusanQuery
            ->when($tahunFilter, function($q) use ($tahunFilter) {
                $q->where('kelulusans.tahun_lulus', $tahunFilter);
            })
            ->groupBy('jurusan')
            ->get();

        // Statistik per angkatan (tahun lulus) - menggunakan baseQuery
        $statsPerAngkatan = (clone $baseQuery)
            ->select(
                'tahun_lulus',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "lulus" THEN 1 ELSE 0 END) as lulus'),
                DB::raw('SUM(CASE WHEN status = "tidak_lulus" THEN 1 ELSE 0 END) as tidak_lulus'),
                DB::raw('ROUND((SUM(CASE WHEN status = "lulus" THEN 1 ELSE 0 END) * 100.0 / COUNT(*)), 2) as persentase_lulus')
            )
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus', 'desc')
            ->get();

        return view('kelulusan.dashboard', compact(
            'totalLulus',
            'totalTidakLulus',
            'statsPerJurusan',
            'statsPerAngkatan',
            'tahunList',
            'tahunFilter'
        ));
    }

    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $user = auth()->user();
    $activeRole = session('active_role');

    $query = Kelulusan::with(['siswa.user', 'siswa.kelas.jurusan', 'aturanKelulusan']);

    // 🔒 BATASI SISWA
    if ($activeRole === 'siswa') {
        if (!$user->siswa) {
            abort(403, 'Akses ditolak');
        }

        $query->where('siswa_id', $user->siswa->id);
    }

    // 🔒 BATASI ORANG TUA
    if ($activeRole === 'orangtua') {
        if (!$user->orangtua) {
            abort(403, 'Akses ditolak');
        }

        $query->where('siswa_id', $user->orangtua->siswa_id);
    }

    // 🔒 WALI KELAS (kelas yang diampu)
    if ($activeRole === 'walikelas') {
        if (!$user->walikelas) {
            abort(403, 'Akses ditolak');
        }

        $query->whereHas('siswa', function ($q) use ($user) {
            $q->where('kelas_id', $user->walikelas->kelas_id);
        });
    }

    // Filter jurusan (khusus admin/TU/kepsek)
    if ($request->filled('jurusan') && in_array($activeRole, ['superadmin','tus','kepsek'])) {
        $query->whereHas('siswa.kelas', function($q) use ($request) {
            $q->where('jurusan_id', $request->jurusan);
        });
    }

    $kelulusans = $query->orderBy('tahun_lulus', 'desc')->get();
    $aturans = AturanKelulusan::orderBy('tahun', 'desc')->get();
    $jurusans = \App\Models\Jurusan::orderBy('nama_jurusan')->get();

    return view('kelulusan.index', compact('kelulusans', 'aturans', 'jurusans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aturans = AturanKelulusan::orderBy('tahun', 'desc')->get();
        $jurusans = \App\Models\Jurusan::orderBy('nama_jurusan')->get();

        return view('kelulusan.create', compact('aturans', 'jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa_legacy'    => 'required|string|max:255',
            'jurusan_legacy'       => 'required|string|max:255',
            'aturan_kelulusan_id'  => 'required|exists:aturan_kelulusans,id',
            'nilai_akhir'          => 'required|numeric|min:0|max:100',
            'tahun_lulus'          => 'required|digits:4',
        ]);

        $aturan = AturanKelulusan::findOrFail($request->aturan_kelulusan_id);

        $status = $request->nilai_akhir >= $aturan->nilai_minimal ? 'lulus' : 'tidak_lulus';

        Kelulusan::create([
            'nama_siswa_legacy'   => $request->nama_siswa_legacy,
            'jurusan_legacy'      => $request->jurusan_legacy,
            'aturan_kelulusan_id' => $request->aturan_kelulusan_id,
            'nilai_akhir'         => $request->nilai_akhir,
            'status'              => $status,
            'tahun_lulus'         => $request->tahun_lulus,
            'is_legacy'           => true,
        ]);

        return redirect()
            ->route('kelulusan.index')
            ->with('success', 'Data kelulusan (legacy) berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelulusan $kelulusan)
{
    $user = auth()->user();
    $activeRole = session('active_role');

    // 🔒 SISWA
    if ($activeRole === 'siswa') {
        if (!$user->siswa || $kelulusan->siswa_id !== $user->siswa->id) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }
    }

    // 🔒 ORANG TUA
    if ($activeRole === 'orangtua') {
        if (
            !$user->orangtua ||
            $kelulusan->siswa_id !== $user->orangtua->siswa_id
        ) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }
    }

    // 🔒 WALI KELAS
    if ($activeRole === 'walikelas') {
        if (
            !$user->walikelas ||
            $kelulusan->siswa->kelas_id !== $user->walikelas->kelas_id
        ) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }
    }

    $kelulusan->load(['siswa.user', 'aturanKelulusan']);

    return view('kelulusan.show', compact('kelulusan'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelulusan $kelulusan)
    {
        $siswas  = Siswa::with('user')->orderBy('id')->get();
        $aturans = AturanKelulusan::orderBy('tahun', 'desc')->get();

        return view('kelulusan.edit', compact('kelulusan', 'siswas', 'aturans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelulusan $kelulusan)
    {
        $request->validate([
            'aturan_kelulusan_id' => 'required|exists:aturan_kelulusans,id',
            'nilai_akhir'         => 'nullable|numeric|min:0|max:100',
        ]);

        $aturan = AturanKelulusan::findOrFail($request->aturan_kelulusan_id);

        $status = 'tidak_lulus';
        if (!is_null($request->nilai_akhir) && $request->nilai_akhir >= $aturan->nilai_minimal) {
            $status = 'lulus';
        }

        $kelulusan->update([
            'aturan_kelulusan_id' => $request->aturan_kelulusan_id,
            'nilai_akhir'         => $request->nilai_akhir,
            'status'              => $status,
        ]);

        return redirect()
            ->route('kelulusan.index')
            ->with('success', 'Data kelulusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();

        return redirect()
            ->route('kelulusan.index')
            ->with('success', 'Data kelulusan berhasil dihapus');
    }
    
    /**
     * Auto-generate kelulusan untuk siswa kelas 12
     * FIXED: 1 SISWA HANYA BOLEH 1 TAHUN KELULUSAN (SEUMUR HIDUP)
     */
    public function autoGenerate(Request $request)
    {
        $request->validate([
            'tahun_lulus' => 'required|digits:4',
            'aturan_kelulusan_id' => 'required|exists:aturan_kelulusans,id',
        ]);

        $aturan = AturanKelulusan::findOrFail($request->aturan_kelulusan_id);

        DB::beginTransaction();

        try {
            // Ambil ID siswa yang SUDAH PERNAH LULUS (APAPUN TAHUNNYA)
            // Siswa yang sudah pernah lulus tidak boleh lulus lagi
            $siswaIdYangSudahPernahLulus = Kelulusan::whereNotNull('siswa_id')
                ->pluck('siswa_id')
                ->toArray();

            // Ambil HANYA siswa kelas 12 yang BELUM PERNAH LULUS
            $siswas = Siswa::with('nilaiAkhir')
                ->whereHas('kelas', function($query) {
                    $query->where('nama_kelas', 'LIKE', '%12%');
                })
                ->whereNotIn('id', $siswaIdYangSudahPernahLulus) // EXCLUDE yang sudah pernah lulus
                ->get();

            if ($siswas->isEmpty()) {
                DB::rollBack();
                return redirect()
                    ->route('kelulusan.index')
                    ->with('warning', 'Semua siswa kelas 12 sudah pernah di-generate. Tidak ada siswa baru yang bisa di-generate.');
            }

            $berhasil = 0;
            $dilewati = 0;

            foreach ($siswas as $siswa) {
                // DOUBLE CHECK: Pastikan siswa belum pernah lulus
                $sudahPernahLulus = Kelulusan::where('siswa_id', $siswa->id)
                    ->exists();

                if ($sudahPernahLulus) {
                    $dilewati++;
                    continue;
                }

                // Hitung rata-rata nilai akhir dari semua mata pelajaran
                $rataRataNilai = $siswa->nilaiAkhir()->avg('nilai_akhir');

                if (is_null($rataRataNilai) || $rataRataNilai == 0) {
                    $dilewati++;
                    continue;
                }

                $status = $rataRataNilai >= $aturan->nilai_minimal
                    ? 'lulus'
                    : 'tidak_lulus';

                Kelulusan::create([
                    'siswa_id'            => $siswa->id,
                    'aturan_kelulusan_id' => $aturan->id,
                    'nilai_akhir'         => round($rataRataNilai, 2),
                    'status'              => $status,
                    'tahun_lulus'         => $request->tahun_lulus,
                    'is_legacy'           => false,
                ]);

                $berhasil++;
            }

            DB::commit();

            if ($berhasil == 0) {
                return redirect()
                    ->route('kelulusan.index')
                    ->with('warning', "Tidak ada siswa baru yang bisa di-generate. Semua siswa kelas 12 sudah pernah lulus atau tidak memiliki nilai.");
            }

            return redirect()
                ->route('kelulusan.index')
                ->with('success', "Auto-generate selesai: $berhasil siswa berhasil di-generate untuk tahun {$request->tahun_lulus}" . ($dilewati > 0 ? ". $dilewati siswa dilewati (sudah pernah lulus/tidak ada nilai)" : ""));

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Gagal generate kelulusan: ' . $e->getMessage());
        }
    }
    
    /**
     * Halaman preview siswa yang akan di-generate
     * Menampilkan list siswa kelas 12 yang BELUM PERNAH LULUS
     */
    public function previewGenerate(Request $request)
    {
        $tahunLulus = $request->input('tahun_lulus', date('Y'));
        
        // Ambil ID siswa yang SUDAH PERNAH LULUS (apapun tahunnya)
        $siswaIdYangSudahPernahLulus = Kelulusan::whereNotNull('siswa_id')
            ->pluck('siswa_id')
            ->toArray();
        
        // Siswa kelas 12 yang BELUM PERNAH LULUS
        $siswaBelumGenerate = Siswa::with(['user', 'kelas.jurusan', 'nilaiAkhir'])
            ->whereHas('kelas', function($query) {
                $query->where('nama_kelas', 'LIKE', '%12%');
            })
            ->whereNotIn('id', $siswaIdYangSudahPernahLulus)
            ->get();
        
        // Siswa kelas 12 yang SUDAH PERNAH LULUS (dengan info kelulusan)
        $siswaSudahGenerate = Siswa::with(['user', 'kelas.jurusan'])
            ->whereHas('kelas', function($query) {
                $query->where('nama_kelas', 'LIKE', '%12%');
            })
            ->whereIn('id', $siswaIdYangSudahPernahLulus)
            ->get()
            ->map(function($siswa) {
                // Ambil data kelulusan siswa (tahun berapa pun)
                $siswa->kelulusan = Kelulusan::where('siswa_id', $siswa->id)
                    ->first();
                return $siswa;
            });
        
        $aturans = AturanKelulusan::orderBy('tahun', 'desc')->get();
        
        return view('kelulusan.preview', compact(
            'siswaBelumGenerate',
            'siswaSudahGenerate',
            'tahunLulus',
            'aturans'
        ));
    }
}