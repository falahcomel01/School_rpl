<?php

namespace App\Http\Controllers;

use App\Models\JawabanSiswa;
use App\Models\Ujian;
use App\Models\UjianSiswa;
use App\Models\UjianSoal;
use Illuminate\Http\Request;

class UjianSiswaController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;

        if (!$siswa) {
            return redirect()->route('dashboard')
                ->with('error', 'Hanya siswa yang punya akun siswa bisa mengakses halaman ini.');
        }

        $ujians = Ujian::where('kelas_id', $siswa->kelas_id)
            ->with(['guru.user', 'guru.mapel'])
            ->latest()
            ->get();

        foreach ($ujians as $ujian) {
            $ujian->status_real = $this->hitungStatusReal($ujian);

            $ujianSiswa = UjianSiswa::where('ujian_id', $ujian->id)
                ->where('siswa_id', $siswa->id)
                ->first();

            $ujian->status_siswa = $ujianSiswa->status ?? 'belum_mulai';
            $ujian->ujian_siswa_id = $ujianSiswa->id ?? null;
            $ujian->paket_siswa = $ujianSiswa->paket ?? null;
        }

        return view('ujian_siswa.index', compact('ujians', 'siswa'));
    }

    public function mulai(Ujian $ujian)
    {
        $siswa = auth()->user()->siswa;

        $statusReal = $this->hitungStatusReal($ujian);
        if ($statusReal !== 'aktif') {
            return redirect()->route('ujian_siswa.index')
                ->with('error', "Ujian tidak bisa dikerjakan. Status: {$statusReal}");
        }

        $ujianSiswa = UjianSiswa::where('ujian_id', $ujian->id)
            ->where('siswa_id', $siswa->id)
            ->first();

        if ($ujianSiswa && $ujianSiswa->status === 'selesai') {
            return redirect()->route('ujian_siswa.index')
                ->with('error', 'Anda sudah menyelesaikan ujian ini.');
        }

        if (!$ujianSiswa) {
            // Tentukan paket untuk siswa ini
            $paket = $this->assignPaketToSiswa($ujian, $siswa);

            $ujianSiswa = UjianSiswa::create([
                'ujian_id' => $ujian->id,
                'siswa_id' => $siswa->id,
                'paket' => $paket,
                'status' => 'sedang_dikerjakan',
                'waktu_mulai' => now(),
            ]);

            $ujianSoals = UjianSoal::where('ujian_id', $ujian->id)->get();

            if ($ujianSoals->isEmpty()) {
                return redirect()->route('ujian_siswa.index')
                    ->with('error', 'Ujian ini belum memiliki soal.');
            }

            // Shuffle soal berdasarkan paket
            if ($ujian->tipe_paket === 'random' && $ujian->jumlah_paket > 1) {
                // Setiap paket mendapat urutan soal yang berbeda dengan seed based on paket
                $ujianSoals = $ujianSoals->shuffle(ord($paket))->take($ujian->jumlah_soal);
            } else {
                // Tipe 1 paket atau random dengan 1 paket, semua dapat urutan yang sama
                $ujianSoals = $ujianSoals->take($ujian->jumlah_soal);
            }

            foreach ($ujianSoals as $ujianSoal) {
                JawabanSiswa::create([
                    'ujian_siswa_id' => $ujianSiswa->id,
                    'ujian_soal_id' => $ujianSoal->id,
                    'opsi_jawaban_id' => null,
                    'jawaban_essay' => null,
                    'is_benar' => null,
                    'nilai' => 0.0,
                ]);
            }
        }

        return redirect()->route('ujian_siswa.kerjakan', $ujianSiswa->id);
    }

    public function kerjakan(UjianSiswa $ujian_siswa)
    {
        $siswa = auth()->user()->siswa;
        if (!$siswa || $ujian_siswa->siswa_id != $siswa->id) {
            abort(403);
        }

        if ($ujian_siswa->status === 'selesai') {
            return redirect()->route('ujian_siswa.hasil', $ujian_siswa->id)
                ->with('info', 'Ujian sudah selesai.');
        }

        $ujianSiswa = UjianSiswa::with([
            'ujian.kelas',
            'jawabanSiswas.ujianSoal.soal.opsiJawaban'
        ])->findOrFail($ujian_siswa->id);

        // Pastikan waktu_mulai ter-set
        if (!$ujianSiswa->waktu_mulai) {
            $ujianSiswa->waktu_mulai = now();
            $ujianSiswa->save();
        }

        $waktuMulai = $ujianSiswa->waktu_mulai;
        $waktuSelesai = $waktuMulai->copy()->addMinutes($ujianSiswa->ujian->durasi_menit);
        $waktuTersisa = now()->diffInSeconds($waktuSelesai, false);

        if ($waktuTersisa <= 0) {
            $this->selesai($ujian_siswa);
            return redirect()->route('ujian_siswa.hasil', $ujian_siswa->id)
                ->with('info', 'Waktu habis.');
        }

        return view('ujian_siswa.kerjakan', [
            'ujianSiswa' => $ujianSiswa,
            'waktuMulaiIso' => $waktuMulai->toISOString(),
        ]);
    }

    public function simpanJawaban(Request $request, UjianSiswa $ujian_siswa)
    {
        $siswa = auth()->user()->siswa;
        if ($siswa->id != $ujian_siswa->siswa_id) abort(403);

        $request->validate([
            'jawaban_id' => 'required|exists:jawaban_siswas,id',
        ]);

        $jawaban = JawabanSiswa::where('id', $request->jawaban_id)
            ->where('ujian_siswa_id', $ujian_siswa->id)
            ->firstOrFail();

        if ($request->has('opsi_jawaban_id')) {
            $jawaban->opsi_jawaban_id = $request->opsi_jawaban_id;
            $this->autoGrade($jawaban);
        }

        if ($request->has('jawaban_essay')) {
            $jawaban->jawaban_essay = $request->jawaban_essay;
            $jawaban->is_benar = null;
            $jawaban->nilai = 0.0;
        }

        $jawaban->waktu_jawab = now();
        $jawaban->save();

        return response()->json(['success' => true]);
    }

    public function updateJawaban(Request $request, UjianSiswa $ujianSiswa, JawabanSiswa $jawabanSiswa)
    {
        $siswa = auth()->user()->siswa;
        if (!$siswa || $siswa->id != $ujianSiswa->siswa_id) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        }

        if ($jawabanSiswa->ujian_siswa_id != $ujianSiswa->id) {
            return response()->json(['success' => false, 'error' => 'Invalid jawaban'], 400);
        }

        if ($request->has('opsi_jawaban_id') && $request->opsi_jawaban_id) {
            $jawabanSiswa->opsi_jawaban_id = $request->opsi_jawaban_id;
            $jawabanSiswa->jawaban_essay = null;
            $jawabanSiswa->waktu_jawab = now();
            $this->autoGrade($jawabanSiswa);
            $jawabanSiswa->save();
            return response()->json(['success' => true, 'type' => 'pilihan_ganda']);
        }

        if ($request->has('jawaban_essay') && $request->jawaban_essay !== null) {
            $jawabanSiswa->jawaban_essay = $request->jawaban_essay;
            $jawabanSiswa->opsi_jawaban_id = null;
            $jawabanSiswa->is_benar = null;
            $jawabanSiswa->nilai = 0.0;
            $jawabanSiswa->waktu_jawab = now();
            $jawabanSiswa->save();
            return response()->json(['success' => true, 'type' => 'essay']);
        }

        $jawabanSiswa->waktu_jawab = now();
        $jawabanSiswa->save();

        return response()->json(['success' => true]);
    }

    public function selesai(UjianSiswa $ujian_siswa)
    {
        $siswa = auth()->user()->siswa;
        if ($siswa->id != $ujian_siswa->siswa_id) abort(403);

        foreach ($ujian_siswa->jawabanSiswas as $jawaban) {
            if ($jawaban->opsi_jawaban_id) {
                $this->autoGrade($jawaban);
            }
        }

        $ujian_siswa->update([
            'status' => 'selesai',
            'waktu_selesai' => now(),
        ]);

        return redirect()->route('ujian_siswa.hasil', $ujian_siswa->id);
    }

    public function hasil(UjianSiswa $ujian_siswa)
    {
        $siswa = auth()->user()->siswa;
        if ($siswa && $siswa->id != $ujian_siswa->siswa_id) abort(403);

        $ujianSiswa = UjianSiswa::with([
            'ujian',
            'jawabanSiswas.ujianSoal.soal.opsiJawaban',
            'jawabanSiswas.opsiJawaban'
        ])->findOrFail($ujian_siswa->id);

        return view('ujian_siswa.hasil', compact('ujianSiswa'));
    }

    private function autoGrade($jawaban)
    {
        $opsi = $jawaban->opsiJawaban;
        $soal = $jawaban->ujianSoal->soal;

        $jawaban->is_benar = $opsi->is_benar;
        // Default bobot adalah 5
        $jawaban->nilai = $opsi->is_benar ? ($soal->bobot ?? 5) : 0.0;
        $jawaban->save();
    }

    private function assignPaketToSiswa($ujian, $siswa)
    {
        // Jika tipe paket adalah 1_paket, semua siswa dapat paket A
        if ($ujian->tipe_paket === '1_paket' || $ujian->jumlah_paket <= 1) {
            return 'A';
        }

        // Hitung berapa siswa yang sudah mengerjakan ujian ini
        $jumlahSiswaSudahMulai = UjianSiswa::where('ujian_id', $ujian->id)->count();

        // Assign paket secara round-robin (A, B, C, ...)
        $indexPaket = $jumlahSiswaSudahMulai % $ujian->jumlah_paket;
        
        // Konversi index ke huruf (0->A, 1->B, 2->C, dst)
        return chr(65 + $indexPaket); // 65 adalah ASCII code untuk 'A'
    }

    public function daftarSiswa(Ujian $ujian)
    {
        $ujianSiswas = UjianSiswa::where('ujian_id', $ujian->id)
            ->with(['siswa.kelas', 'jawabanSiswas'])
            ->get();

        foreach ($ujianSiswas as $ujianSiswa) {
            $totalSoal = $ujianSiswa->jawabanSiswas->count();
            $totalBenar = $ujianSiswa->jawabanSiswas->where('is_benar', true)->count();
            $totalSalah = $ujianSiswa->jawabanSiswas->where('is_benar', false)->count();
            $totalNilai = $ujianSiswa->jawabanSiswas->sum('nilai');

            $ujianSiswa->total_soal = $totalSoal;
            $ujianSiswa->total_benar = $totalBenar;
            $ujianSiswa->total_salah = $totalSalah;
            $ujianSiswa->total_nilai = $totalNilai;
        }

        return view('ujian_siswa.daftar_peserta', compact('ujian', 'ujianSiswas'));
    }

    public function detailHasilSiswa(UjianSiswa $ujian_siswa)
    {
        $ujianSiswa = UjianSiswa::with([
            'ujian',
            'siswa.kelas',
            'jawabanSiswas.ujianSoal.soal.opsiJawaban',
            'jawabanSiswas.opsiJawaban'
        ])->findOrFail($ujian_siswa->id);

        // Hitung statistik
        $totalSoal = $ujianSiswa->jawabanSiswas->count();
        $soalBenar = $ujianSiswa->jawabanSiswas->where('is_benar', true)->count();
        $soalSalah = $ujianSiswa->jawabanSiswas->where('is_benar', false)->count();
        $soalBelumDinilai = $ujianSiswa->jawabanSiswas->where('is_benar', null)->count();

        return view('ujian_siswa.detail_penilaian', compact('ujianSiswa', 'totalSoal', 'soalBenar', 'soalSalah', 'soalBelumDinilai'));
    }

    public function updateNilai(Request $request, JawabanSiswa $jawaban)
    {
        // Cek apakah sudah pernah dinilai
        if ($jawaban->is_benar !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai sudah pernah disimpan dan tidak dapat diubah!'
            ], 400);
        }

        $request->validate([
            'nilai' => 'required|numeric|min:0'
        ]);

        $jawaban->nilai = $request->nilai;
        // Set is_benar ke true untuk menandai sudah dinilai
        // (untuk essay, is_benar = true artinya sudah dinilai)
        $jawaban->is_benar = true;
        $jawaban->save();

        return response()->json([
            'success' => true,
            'message' => 'Nilai berhasil disimpan'
        ]);
    }

    private function hitungStatusReal($ujian)
    {
        // Jika dinonaktifkan paksa, selalu nonaktif
        if ($ujian->status === 'nonaktif') {
            return 'nonaktif';
        }

        $now = now();
        $mulai = \Carbon\Carbon::parse($ujian->tanggal_mulai);
        $selesai = \Carbon\Carbon::parse($ujian->tanggal_selesai);

        // Cek berdasarkan tanggal, bukan status manual
        if ($now->lt($mulai)) {
            return 'menunggu';
        }
        
        if ($now->gt($selesai)) {
            return 'selesai';
        }

        // Sedang berlangsung
        return 'aktif';
    }
}
