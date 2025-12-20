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
    $query = Kelulusan::with(['siswa.user', 'siswa.kelas.jurusan', 'aturanKelulusan']);

    if ($request->filled('jurusan')) {
        $query->whereHas('siswa.kelas', function($q) use ($request) {
            $q->where('jurusan_id', $request->jurusan);
        })->orWhere(function($q) use ($request) {
            $jurusan = \App\Models\Jurusan::find($request->jurusan);
            if ($jurusan) {
                $q->where('jurusan_legacy', $jurusan->nama_jurusan);
            }
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
    public function autoGenerate(Request $request)
{
    $request->validate([
        'tahun_lulus' => 'required|digits:4',
        'aturan_kelulusan_id' => 'required|exists:aturan_kelulusans,id',
    ]);

    $aturan = AturanKelulusan::findOrFail($request->aturan_kelulusan_id);

    DB::beginTransaction();

    try {
        $siswas = Siswa::with('nilaiAkhir')
            ->whereHas('kelas', function($query) {
                $query->where('nama_kelas', 'LIKE', '%12%');
            })
            ->get();

        $berhasil = 0;
        $dilewati = 0;

        foreach ($siswas as $siswa) {

            // Cegah duplikasi
            $exists = Kelulusan::where('siswa_id', $siswa->id)
                ->where('tahun_lulus', $request->tahun_lulus)
                ->exists();

            if ($exists) {
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

        return redirect()
            ->route('kelulusan.index')
            ->with('success', "Auto-generate selesai: $berhasil data dibuat, $dilewati dilewati (hanya kelas 12)");

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with('error', 'Gagal generate kelulusan');
    }
}
}
