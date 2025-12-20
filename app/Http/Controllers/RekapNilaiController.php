<?php

namespace App\Http\Controllers;

use App\Models\PembobotanNilai;
use App\Models\RekapNilaiAkhir;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Ujian;
use App\Models\UjianSiswa;
use App\Models\Tugaspengumpulan;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapNilaiController extends Controller
{
    /**
     * Halaman daftar pembobotan untuk guru
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!$user->guru) {
            return redirect()->route('dashboard')
                ->with('error', 'Hanya guru yang dapat mengakses halaman ini.');
        }

        $guru = $user->guru;
        
        // Ambil pembobotan yang dibuat guru ini
        $pembobotan = PembobotanNilai::where('guru_id', $guru->id)
            ->with(['kelas', 'mapel'])
            ->withCount('rekaps')
            ->latest()
            ->get();

        return view('rekap_nilai.index', compact('pembobotan'));
    }

    /**
     * Form untuk set bobot
     */
    public function create()
    {
        $user = auth()->user();
        
        if (!$user->guru) {
            return redirect()->route('rekap_nilai.index')
                ->with('error', 'Hanya guru yang dapat membuat pembobotan.');
        }

        $guru = $user->guru;
        $mapel = $guru->mapel;
        
        // Ambil kelas yang diampu guru dari jadwal
        $kelas = Kelas::whereHas('jadwals', function($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();

        return view('rekap_nilai.create', compact('kelas', 'mapel'));
    }

    /**
     * Simpan pembobotan
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        if (!$user->guru) {
            return redirect()->route('rekap_nilai.index')
                ->with('error', 'Hanya guru yang dapat membuat pembobotan.');
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'bobot_tugas' => 'required|integer|min:0|max:100',
            'bobot_uts' => 'required|integer|min:0|max:100',
            'bobot_uas' => 'required|integer|min:0|max:100',
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        // Validasi total bobot harus 100%
        $totalBobot = $validated['bobot_tugas'] + $validated['bobot_uts'] + $validated['bobot_uas'];
        if ($totalBobot != 100) {
            return back()->withErrors(['bobot' => 'Total bobot harus 100%. Saat ini: ' . $totalBobot . '%'])->withInput();
        }

        $guru = $user->guru;
        $validated['guru_id'] = $guru->id;
        $validated['mapel_id'] = $guru->mapel_id;

        try {
            PembobotanNilai::create($validated);
            return redirect()->route('rekap_nilai.index')
                ->with('success', 'Pembobotan nilai berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Pembobotan untuk kelas, mapel, semester, dan tahun ajaran ini sudah ada!'])->withInput();
        }
    }

    /**
     * Form edit bobot
     */
    public function edit(PembobotanNilai $pembobotan)
    {
        $user = auth()->user();
        
        if (!$user->guru || $user->guru->id != $pembobotan->guru_id) {
            return redirect()->route('rekap_nilai.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit pembobotan ini.');
        }

        $guru = $user->guru;
        $mapel = $guru->mapel;
        
        $kelas = Kelas::whereHas('jadwals', function($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();

        return view('rekap_nilai.edit', compact('pembobotan', 'kelas', 'mapel'));
    }

    /**
     * Update pembobotan
     */
    public function update(Request $request, PembobotanNilai $pembobotan)
    {
        $user = auth()->user();
        
        if (!$user->guru || $user->guru->id != $pembobotan->guru_id) {
            return redirect()->route('rekap_nilai.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengupdate pembobotan ini.');
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'bobot_tugas' => 'required|integer|min:0|max:100',
            'bobot_uts' => 'required|integer|min:0|max:100',
            'bobot_uas' => 'required|integer|min:0|max:100',
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        // Validasi total bobot harus 100%
        $totalBobot = $validated['bobot_tugas'] + $validated['bobot_uts'] + $validated['bobot_uas'];
        if ($totalBobot != 100) {
            return back()->withErrors(['bobot' => 'Total bobot harus 100%. Saat ini: ' . $totalBobot . '%'])->withInput();
        }

        $pembobotan->update($validated);

        return redirect()->route('rekap_nilai.index')
            ->with('success', 'Pembobotan nilai berhasil diupdate!');
    }

    /**
     * Generate/regenerate rekap nilai untuk satu kelas
     */
    public function generate(PembobotanNilai $pembobotan)
    {
        $user = auth()->user();
        
        if (!$user->guru || $user->guru->id != $pembobotan->guru_id) {
            return redirect()->route('rekap_nilai.index')
                ->with('error', 'Anda tidak memiliki akses untuk generate rekap ini.');
        }

        $kelas_id = $pembobotan->kelas_id;
        $mapel_id = $pembobotan->mapel_id;
        $semester = $pembobotan->semester;
        $tahun_ajaran = $pembobotan->tahun_ajaran;

        // Ambil semua siswa di kelas ini
        $siswas = Siswa::where('kelas_id', $kelas_id)->get();

        foreach ($siswas as $siswa) {
            // 1. Hitung rata-rata tugas
            $rataTugas = DB::table('tugaspengumpulans')
                ->join('tugas', 'tugaspengumpulans.tugas_id', '=', 'tugas.id')
                ->where('tugaspengumpulans.siswa_id', $siswa->id)
                ->where('tugas.mapel_id', $mapel_id)
                ->where('tugas.kelas_id', $kelas_id)
                ->avg('tugaspengumpulans.nilai');

            $rataTugas = $rataTugas ?? 0;

            // 2. Ambil nilai UTS
            $ujianSiswaUTS = UjianSiswa::whereHas('ujian', function($q) use ($mapel_id, $kelas_id, $pembobotan) {
                    $q->where('jenis_ujian', 'LIKE', '%UTS%')
                      ->where('guru_id', $pembobotan->guru_id)
                      ->where('kelas_id', $kelas_id);
                })
                ->where('siswa_id', $siswa->id)
                ->where('status', 'selesai')
                ->first();

            $nilaiUTS = $ujianSiswaUTS ? $ujianSiswaUTS->nilai_total : 0;

            // 3. Ambil nilai UAS
            $ujianSiswaUAS = UjianSiswa::whereHas('ujian', function($q) use ($mapel_id, $kelas_id, $pembobotan) {
                    $q->where('jenis_ujian', 'LIKE', '%UAS%')
                      ->where('guru_id', $pembobotan->guru_id)
                      ->where('kelas_id', $kelas_id);
                })
                ->where('siswa_id', $siswa->id)
                ->where('status', 'selesai')
                ->first();

            $nilaiUAS = $ujianSiswaUAS ? $ujianSiswaUAS->nilai_total : 0;

            // 4. Hitung nilai akhir
            $nilaiAkhir = ($rataTugas * $pembobotan->bobot_tugas / 100) +
                          ($nilaiUTS * $pembobotan->bobot_uts / 100) +
                          ($nilaiUAS * $pembobotan->bobot_uas / 100);

            // 5. Simpan atau update rekap
            RekapNilaiAkhir::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'mapel_id' => $mapel_id,
                    'semester' => $semester,
                    'tahun_ajaran' => $tahun_ajaran,
                ],
                [
                    'pembobotan_nilai_id' => $pembobotan->id,
                    'kelas_id' => $kelas_id,
                    'rata_rata_tugas' => round($rataTugas, 2),
                    'nilai_uts' => round($nilaiUTS, 2),
                    'nilai_uas' => round($nilaiUAS, 2),
                    'nilai_akhir' => round($nilaiAkhir, 2),
                ]
            );
        }

        return redirect()->route('rekap_nilai.show', $pembobotan->id)
            ->with('success', 'Rekap nilai berhasil di-generate untuk ' . $siswas->count() . ' siswa!');
    }

    /**
     * Lihat rekap nilai kelas (untuk guru)
     */
    public function show(PembobotanNilai $pembobotan)
    {
        $user = auth()->user();
        
        if (!$user->guru || $user->guru->id != $pembobotan->guru_id) {
            return redirect()->route('rekap_nilai.index')
                ->with('error', 'Anda tidak memiliki akses untuk melihat rekap ini.');
        }

        $rekaps = RekapNilaiAkhir::where('kelas_id', $pembobotan->kelas_id)
            ->where('mapel_id', $pembobotan->mapel_id)
            ->where('semester', $pembobotan->semester)
            ->where('tahun_ajaran', $pembobotan->tahun_ajaran)
            ->with(['siswa.user'])
            ->orderBy('nilai_akhir', 'desc')
            ->get();

        return view('rekap_nilai.show', compact('pembobotan', 'rekaps'));
    }

    /**
     * Halaman rekap nilai untuk siswa (lihat nilai sendiri)
     */
    public function rekapSiswa()
    {
        $user = auth()->user();
        
        if (!$user->siswa) {
            return redirect()->route('dashboard')
                ->with('error', 'Hanya siswa yang dapat mengakses halaman ini.');
        }

        $siswa = $user->siswa;

        // Ambil semua rekap nilai siswa ini
        $rekaps = RekapNilaiAkhir::where('siswa_id', $siswa->id)
            ->with(['mapel', 'kelas', 'pembobotan'])
            ->orderBy('semester', 'desc')
            ->orderBy('tahun_ajaran', 'desc')
            ->get();

        return view('rekap_nilai.rekap_siswa', compact('rekaps', 'siswa'));
    }

    /**
     * Hapus pembobotan
     */
    public function destroy(PembobotanNilai $pembobotan)
    {
        $user = auth()->user();
        
        if (!$user->guru || $user->guru->id != $pembobotan->guru_id) {
            return redirect()->route('rekap_nilai.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus pembobotan ini.');
        }

        // Hapus juga rekap nilai yang terkait
        RekapNilaiAkhir::where('kelas_id', $pembobotan->kelas_id)
            ->where('mapel_id', $pembobotan->mapel_id)
            ->where('semester', $pembobotan->semester)
            ->where('tahun_ajaran', $pembobotan->tahun_ajaran)
            ->delete();

        $pembobotan->delete();

        return redirect()->route('rekap_nilai.index')
            ->with('success', 'Pembobotan dan rekap nilai terkait berhasil dihapus!');
    }
}
