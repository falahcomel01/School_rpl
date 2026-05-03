<?php

namespace App\Http\Controllers;

use App\Models\RekomendasiJurusan;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\RekapNilaiAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiJurusanController extends Controller
{
    // ================= SISWA =================

    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        // Nilai dari rekap nilai akhir
        $nilai = RekapNilaiAkhir::where('siswa_id', $siswa->id)
            ->with('mapel')
            ->get();

        // ✅ Hilangkan jurusan "UMUM" - hanya tampilkan IPA, IPS, Bahasa
        $jurusan = Jurusan::where('nama_jurusan', '!=', 'UMUM')
            ->orderBy('nama_jurusan')
            ->get();

        // Ambil rekomendasi jika sudah ada
        $rekomendasi = RekomendasiJurusan::where('siswa_id', $siswa->id)->first();

        return view('rekomendasi.index', compact(
            'jurusan',
            'rekomendasi',
            'nilai'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        // ✅ Validasi: Jurusan yang dipilih tidak boleh UMUM
        $jurusan = Jurusan::findOrFail($request->jurusan_id);
        if ($jurusan->nama_jurusan === 'UMUM') {
            return back()->with('error', 'Jurusan UMUM tidak dapat dipilih.');
        }

        // 🔒 CEK: jika ada rekomendasi existing
        $existing = RekomendasiJurusan::where('siswa_id', $siswa->id)->first();

        if ($existing) {
            // ✅ Jika ditolak, BOLEH update/ganti pilihan
            if ($existing->validasi === 'ditolak') {
                $existing->update([
                    'jurusan_id' => $request->jurusan_id,
                    'validasi' => 'pending',
                    'catatan_wali_kelas' => null,
                    'jurusan_rekomendasi_id' => null, // Reset rekomendasi sebelumnya
                ]);

                return back()->with('success', 'Pilihan jurusan berhasil diperbarui dan menunggu validasi wali kelas.');
            }

            return back()->with('error', 'Pilihan jurusan sudah dikirim dan tidak dapat diubah.');
        }

        // ✅ Jika belum ada rekomendasi, buat baru
        RekomendasiJurusan::create([
            'siswa_id' => $siswa->id,
            'jurusan_id' => $request->jurusan_id,
            'validasi' => 'pending',
            'catatan_wali_kelas' => null,
        ]);

        return back()->with('success', 'Pilihan jurusan berhasil disimpan dan menunggu validasi wali kelas.');
    }

    public function daftarRekomendasi()
    {
        $rekomendasi = RekomendasiJurusan::with([
                    'siswa.user',
                    'siswa.nilaiAkhir.mapel',
                    'jurusan',
                    'jurusanRekomendasi' 
                ])
                ->latest()
                ->get();

        // Pre-calculate grades for each student
        $rekomendasi->each(function ($item) {
            $nilai = $item->siswa->nilaiAkhir;
            if ($nilai->isEmpty()) {
                $item->nilai_ipa = 0;
                $item->nilai_ips = 0;
                $item->nilai_bahasa = 0;
                return;
            }

            // Filter koleksi untuk mendapatkan nilai IPA
            $nilaiIPA = $nilai->filter(function ($rek) {
                return $rek->mapel && $rek->mapel->tingkat === 'IPA';
            });
            $item->nilai_ipa = $nilaiIPA->avg('nilai_akhir') ?? 0;

            // Filter koleksi untuk mendapatkan nilai IPS
            $nilaiIPS = $nilai->filter(function ($rek) {
                return $rek->mapel && $rek->mapel->tingkat === 'IPS';
            });
            $item->nilai_ips = $nilaiIPS->avg('nilai_akhir') ?? 0;

            // Filter koleksi untuk mendapatkan nilai Bahasa
            $nilaiBahasa = $nilai->filter(function ($rek) {
                return $rek->mapel && $rek->mapel->tingkat === 'Bahasa';
            });
            $item->nilai_bahasa = $nilaiBahasa->avg('nilai_akhir') ?? 0;
        });

        return view('rekomendasi.daftar', compact('rekomendasi'));
    }

    public function validasi($id)
    {
        $rekomendasi = RekomendasiJurusan::with([
            'siswa.user',
            'siswa.nilaiAkhir.mapel',
            'jurusan'
        ])->findOrFail($id);

        // ✅ Ambil daftar jurusan (kecuali UMUM)
        $jurusans = Jurusan::where('nama_jurusan', '!=', 'UMUM')
            ->orderBy('nama_jurusan')
            ->get();

        // Pre-calculate grades untuk ditampilkan di form validasi
        $nilai = $rekomendasi->siswa->nilaiAkhir;
        
        if ($nilai->isEmpty()) {
            $rekomendasi->nilai_ipa = 0;
            $rekomendasi->nilai_ips = 0;
            $rekomendasi->nilai_bahasa = 0;
        } else {
            $nilaiIPA = $nilai->filter(fn($rek) => $rek->mapel && $rek->mapel->tingkat === 'IPA');
            $rekomendasi->nilai_ipa = $nilaiIPA->avg('nilai_akhir') ?? 0;

            $nilaiIPS = $nilai->filter(fn($rek) => $rek->mapel && $rek->mapel->tingkat === 'IPS');
            $rekomendasi->nilai_ips = $nilaiIPS->avg('nilai_akhir') ?? 0;

            $nilaiBahasa = $nilai->filter(fn($rek) => $rek->mapel && $rek->mapel->tingkat === 'Bahasa');
            $rekomendasi->nilai_bahasa = $nilaiBahasa->avg('nilai_akhir') ?? 0;
        }

        return view('rekomendasi.validasi', compact('rekomendasi', 'jurusans'));
    }

    public function prosesValidasi(Request $request, $id)
    {
        $request->validate([
            'jurusan_rekomendasi_id' => 'required|exists:jurusans,id',
            'validasi' => 'required|in:disetujui,ditolak',
            'catatan_wali_kelas' => 'nullable|string',
        ]);

        // ✅ Validasi: Jurusan rekomendasi tidak boleh UMUM
        $jurusan = Jurusan::findOrFail($request->jurusan_rekomendasi_id);
        if ($jurusan->nama_jurusan === 'UMUM') {
            return back()->with('error', 'Jurusan UMUM tidak dapat dijadikan rekomendasi.');
        }

        $rekomendasi = RekomendasiJurusan::findOrFail($id);

        $rekomendasi->update([
            'jurusan_rekomendasi_id' => $request->jurusan_rekomendasi_id,
            'validasi' => $request->validasi,
            'catatan_wali_kelas' => $request->catatan_wali_kelas,
        ]);

        return redirect()->route('rekomendasi.daftar')
            ->with('success', 'Rekomendasi berhasil divalidasi.');
    }

    public function batalRekomendasi($id)
    {
        $rekomendasi = RekomendasiJurusan::findOrFail($id);
        $rekomendasi->delete();

        return redirect()->route('rekomendasi.daftar')
            ->with('success', 'Rekomendasi berhasil dibatalkan.');
    }
}