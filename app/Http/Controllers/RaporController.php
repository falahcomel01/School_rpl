<?php

namespace App\Http\Controllers;

use App\Models\RekapNilaiAkhir;
use App\Models\Siswa;
use App\Models\CatatanPerkembangan;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class RaporController extends Controller
{
    /**
     * Helper untuk detect role user
     */
    private function getUserRole()
    {
        $user = auth()->user();
        
        // Prioritas: cek session dulu, kalau tidak ada detect dari relasi
        if (session('active_role')) {
            return session('active_role');
        }
        
        // Auto detect dari relasi
        if ($user->siswa) return 'siswa';
        if ($user->orangtua) return 'orangtua';
        if ($user->guru && $user->guru->walikelas) return 'walikelas';
        if ($user->hasRole('superadmin')) return 'superadmin';
        
        return 'guest';
    }

    /**
     * =============================
     * LIST RAPOR (ADMIN / WALIKELAS)
     * =============================
     */
    public function index()
    {
        $role = $this->getUserRole();
        
        // Orang tua & siswa tidak boleh lihat list semua
        if ($role === 'orangtua' || $role === 'siswa') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = auth()->user();

        $query = RekapNilaiAkhir::select(
            'siswa_id',
            'kelas_id',
            'semester',
            'tahun_ajaran',
            DB::raw('AVG(nilai_akhir) as rata_rata'),
            DB::raw('COUNT(*) as jumlah_mapel')
        )->groupBy('siswa_id', 'kelas_id', 'semester', 'tahun_ajaran');

        if ($user->guru && $user->guru->walikelas) {
            $query->where('kelas_id', $user->guru->walikelas->kelas_id);
        }

        $rapors = $query->with(['siswa.user', 'kelas'])
            ->orderBy('tahun_ajaran', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        return view('rapor.index', compact('rapors'));
    }

    /**
     * =============================
     * DETAIL RAPOR (ADMIN / WALIKELAS / ORANGTUA)
     * =============================
     */
    public function show($siswa_id, $semester, $tahun_ajaran)
    {
        $user = auth()->user();
        $role = $this->getUserRole();
        $tahun_ajaran = str_replace('-', '/', $tahun_ajaran);

        // ORANG TUA: hanya anak sendiri
        if ($role === 'orangtua') {
            abort_if(
                !$user->orangtua || $user->orangtua->siswa_id != $siswa_id,
                403,
                'Anda hanya bisa melihat rapor anak Anda.'
            );
        }

        // SISWA: hanya dirinya
        if ($role === 'siswa') {
            abort_if(
                !$user->siswa || $user->siswa->id != $siswa_id,
                403,
                'Anda hanya bisa melihat rapor Anda sendiri.'
            );
        }

        // WALI KELAS: hanya kelasnya
        if ($role === 'walikelas') {
            $siswaCheck = Siswa::findOrFail($siswa_id);
            abort_if(
                !$user->guru ||
                !$user->guru->walikelas ||
                $user->guru->walikelas->kelas_id != $siswaCheck->kelas_id,
                403,
                'Anda hanya bisa melihat rapor siswa di kelas Anda.'
            );
        }

        $siswa = Siswa::with(['user', 'kelas.jurusan'])->findOrFail($siswa_id);

        $rekaps = RekapNilaiAkhir::where([
                ['siswa_id', $siswa_id],
                ['semester', $semester],
                ['tahun_ajaran', $tahun_ajaran],
            ])
            ->with(['mapel', 'pembobotan'])
            ->get();

        if ($rekaps->isEmpty()) {
            return back()->with('error', 'Data rapor belum tersedia.');
        }

        $rata_rata = $rekaps->avg('nilai_akhir');
        $catatan = CatatanPerkembangan::where('siswa_id', $siswa_id)->first();
        $presensi = $this->getPresensiSiswa($siswa_id, $semester, $tahun_ajaran);
        $ekstrakurikuler = $this->getEkstrakurikulerSiswa($siswa_id);
        $prestasi = $this->getPrestasiSiswa($siswa_id, $semester, $tahun_ajaran);

        return view('rapor.show', compact(
            'siswa',
            'rekaps',
            'semester',
            'tahun_ajaran',
            'rata_rata',
            'catatan',
            'presensi',
            'ekstrakurikuler',
            'prestasi'
        ));
    }

    /**
     * =============================
     * LIST RAPOR SISWA & ORANGTUA
     * =============================
     */
    public function raporSiswa()
    {
        $user = auth()->user();
        $role = $this->getUserRole();

        if ($role === 'siswa') {
            $siswa = $user->siswa;
        } elseif ($role === 'orangtua') {
            $siswa = $user->orangtua?->siswa;
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        abort_if(!$siswa, 403, 'Data siswa tidak ditemukan.');

        $rapors = RekapNilaiAkhir::select(
                'semester',
                'tahun_ajaran',
                DB::raw('AVG(nilai_akhir) as rata_rata'),
                DB::raw('COUNT(*) as jumlah_mapel')
            )
            ->where('siswa_id', $siswa->id)
            ->groupBy('semester', 'tahun_ajaran')
            ->orderBy('tahun_ajaran', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        return view('rapor.rapor_siswa', compact('rapors', 'siswa'));
    }

    /**
     * =============================
     * DETAIL RAPOR SISWA & ORANGTUA
     * =============================
     */
    public function detailRaporSiswa($semester, $tahun_ajaran)
    {
        $user = auth()->user();
        $role = $this->getUserRole();

        if ($role === 'siswa') {
            $siswa = $user->siswa;
        } elseif ($role === 'orangtua') {
            $siswa = $user->orangtua?->siswa;
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        abort_if(!$siswa, 403, 'Data siswa tidak ditemukan.');

        $tahun_ajaran = str_replace('-', '/', $tahun_ajaran);

        $rekaps = RekapNilaiAkhir::where([
                ['siswa_id', $siswa->id],
                ['semester', $semester],
                ['tahun_ajaran', $tahun_ajaran],
            ])
            ->with(['mapel', 'pembobotan'])
            ->get();

        if ($rekaps->isEmpty()) {
            return back()->with('error', 'Data rapor belum tersedia untuk periode ini.');
        }

        $rata_rata = $rekaps->avg('nilai_akhir');
        $catatan = CatatanPerkembangan::where('siswa_id', $siswa->id)->first();
        $presensi = $this->getPresensiSiswa($siswa->id, $semester, $tahun_ajaran);
        $ekstrakurikuler = $this->getEkstrakurikulerSiswa($siswa->id);
        $prestasi = $this->getPrestasiSiswa($siswa->id, $semester, $tahun_ajaran);

        return view('rapor.detail_siswa', compact(
            'siswa',
            'rekaps',
            'semester',
            'tahun_ajaran',
            'rata_rata',
            'catatan',
            'presensi',
            'ekstrakurikuler',
            'prestasi'
        ));
    }

    /**
     * =============================
     * CETAK PDF (SISWA & ORANGTUA)
     * =============================
     */
    public function cetakPdf($siswa_id, $semester, $tahun_ajaran)
    {
        $user = auth()->user();
        $role = $this->getUserRole();

        if ($role === 'siswa') {
            abort_if($user->siswa->id != $siswa_id, 403, 'Anda hanya bisa mencetak rapor Anda sendiri.');
        }

        if ($role === 'orangtua') {
            abort_if(!$user->orangtua || $user->orangtua->siswa_id != $siswa_id, 403, 'Anda hanya bisa mencetak rapor anak Anda.');
        }

        $tahun_ajaran = str_replace('-', '/', $tahun_ajaran);

        $siswa = Siswa::with(['user', 'kelas.jurusan'])->findOrFail($siswa_id);

        $rekaps = RekapNilaiAkhir::where([
                ['siswa_id', $siswa_id],
                ['semester', $semester],
                ['tahun_ajaran', $tahun_ajaran],
            ])
            ->with('mapel')
            ->get();

        if ($rekaps->isEmpty()) {
            return back()->with('error', 'Data rapor belum tersedia untuk dicetak.');
        }

        $rata_rata = $rekaps->avg('nilai_akhir');
        $catatan = CatatanPerkembangan::where('siswa_id', $siswa_id)->first();
        $presensi = $this->getPresensiSiswa($siswa_id, $semester, $tahun_ajaran);
        $ekstrakurikuler = $this->getEkstrakurikulerSiswa($siswa_id);
        $prestasi = $this->getPrestasiSiswa($siswa_id, $semester, $tahun_ajaran);

        $pdf = Pdf::loadView('rapor.pdf', compact(
            'siswa',
            'rekaps',
            'semester',
            'tahun_ajaran',
            'rata_rata',
            'catatan',
            'presensi',
            'ekstrakurikuler',
            'prestasi'
        ));

        return $pdf->download(
            'Rapor_' . $siswa->user->name . '_' . $semester . '.pdf'
        );
    }

    public function cetakPdfSiswa($semester, $tahun_ajaran)
    {
        $user = auth()->user();
        $role = $this->getUserRole();

        if ($role === 'siswa') {
            $siswa = $user->siswa;
        } elseif ($role === 'orangtua') {
            $siswa = $user->orangtua?->siswa;
        } else {
            abort(403, 'Anda tidak memiliki akses untuk mencetak rapor.');
        }

        abort_if(!$siswa, 403, 'Data siswa tidak ditemukan.');

        // PANGGIL METHOD UTAMA
        return $this->cetakPdf($siswa->id, $semester, $tahun_ajaran);
    }

    /**
     * =============================
     * HELPER
     * =============================
     */
    private function getPresensiSiswa($siswa_id, $semester, $tahun_ajaran)
    {
        $siswa = Siswa::with('user')->find($siswa_id);
        if (!$siswa) return ['izin' => 0, 'sakit' => 0, 'alpa' => 0];

        [$awal, $akhir] = explode('/', $tahun_ajaran);

        [$mulai, $selesai] = strtolower($semester) === 'ganjil'
            ? [$awal . '-07-01', $awal . '-12-31']
            : [$akhir . '-01-01', $akhir . '-06-30'];

        $data = DB::table('presensis')
            ->where('user_id', $siswa->user_id)
            ->whereBetween('tanggal', [$mulai, $selesai])
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'izin'  => $data['izin'] ?? 0,
            'sakit' => $data['sakit'] ?? 0,
            'alpa'  => $data['alpa'] ?? 0,
        ];
    }

    private function getEkstrakurikulerSiswa($siswa_id)
    {
        return Ekstrakurikuler::whereHas('peserta', fn ($q) =>
            $q->where('siswa_id', $siswa_id)
        )->with('pembina.user')->get();
    }

    private function getPrestasiSiswa($siswa_id, $semester, $tahun_ajaran)
    {
        [$awal, $akhir] = explode('/', $tahun_ajaran);

        [$mulai, $selesai] = strtolower($semester) === 'ganjil'
            ? [$awal . '-07-01', $awal . '-12-31']
            : [$akhir . '-01-01', $akhir . '-06-30'];

        return Prestasi::where('siswa_id', $siswa_id)
            ->whereBetween('tanggal', [$mulai, $selesai])
            ->orderBy('tanggal', 'desc')
            ->get();
    }
}