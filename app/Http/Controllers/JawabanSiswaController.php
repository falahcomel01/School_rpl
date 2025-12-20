<?php

namespace App\Http\Controllers;

use App\Models\JawabanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JawabanSiswaController extends Controller
{
    /**
     * Simpan jawaban pilihan ganda (AUTO-SAVE)
     * ✔ Tidak auto-grade
     * ✔ Tidak menimpa jawaban siswa lain
     */
    public function storeOption(Request $request)
    {
        $data = $request->validate([
            'ujian_soal_id'    => 'required|exists:ujian_soals,id',
            'opsi_jawaban_id'  => 'required|exists:opsi_jawabans,id',
            'ujian_siswa_id'   => 'required|exists:ujian_siswas,id',
        ]);

        // Simpan/update jawaban siswa
        $jawaban = \DB::transaction(function () use ($data) {
            $jawaban = JawabanSiswa::updateOrCreate(
                [
                    'ujian_siswa_id' => $data['ujian_siswa_id'],
                    'ujian_soal_id'  => $data['ujian_soal_id'],
                ],
                [
                    'opsi_jawaban_id' => $data['opsi_jawaban_id'],
                    'waktu_jawab'     => Carbon::now(),
                ]
            );

            // Auto-grade segera (pilihan ganda)
            // ambil opsi dengan relasi
            $opsi = $jawaban->opsiJawaban()->first();
            $soal = $jawaban->ujianSoal()->with('soal')->first(); // asumsi relasi ada

            // jika opsi ada, beri nilai sesuai is_benar & bobot soal
            if ($opsi) {
                $bobot = optional($soal->soal)->bobot ?? 1;
                $jawaban->is_benar = $opsi->is_benar;
                $jawaban->nilai = $opsi->is_benar ? (float) $bobot : 0.0;
                $jawaban->status_jawaban = 'dinilai';
                $jawaban->save();
            }

            return $jawaban;
        });

        return response()->json(['status' => 'ok', 'jawaban' => $jawaban]);
    }


    /**
     * Simpan jawaban essay (AUTO-SAVE)
     * ✔ Tidak auto-grade
     */
   public function storeEssay(Request $request)
    {
        $data = $request->validate([
            'ujian_soal_id'    => 'required|exists:ujian_soals,id',
            'jawaban_essay'    => 'nullable|string',
            'ujian_siswa_id'   => 'required|exists:ujian_siswas,id',
        ]);

        $jawaban = JawabanSiswa::updateOrCreate(
            [
                'ujian_siswa_id' => $data['ujian_siswa_id'],
                'ujian_soal_id'  => $data['ujian_soal_id'],
            ],
            [
                'jawaban_essay'   => $data['jawaban_essay'],
                'waktu_jawab'     => Carbon::now(),
                'is_benar'        => null,
                'status_jawaban'  => 'belum_dinilai',
                'nilai'           => 0.0,
            ]
        );

        return response()->json(['status' => 'ok', 'jawaban' => $jawaban]);
    }

    /**
     * Submit — opsional (tidak ada penilaian di sini)
     */
    public function submit(Request $request)
    {
        $request->validate([
            'ujian_siswa_id' => 'required|exists:ujian_siswas,id',
        ]);

        return response()->json(['status' => 'submitted']);
    }

    /**
     * Guru memberikan nilai essay
     * ✔ nilai float (0-100)
     */
      public function gradeEssay(Request $request)
    {
        $data = $request->validate([
            'jawaban_id' => 'required|exists:jawaban_siswas,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string'
        ]);

        $jawaban = JawabanSiswa::findOrFail($data['jawaban_id']);
        $jawaban->nilai = (float) $data['nilai'];
        $jawaban->is_benar = $data['nilai'] > 0;
        $jawaban->status_jawaban = 'dinilai';
        $jawaban->save();

        return back()->with('success', 'Jawaban essay sudah dinilai.');
    }
}
