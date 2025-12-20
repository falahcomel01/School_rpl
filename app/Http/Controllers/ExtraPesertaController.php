<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\ExtraPeserta;
use Illuminate\Http\Request;

class ExtraPesertaController extends Controller
{
    /**
     * SISWA DAFTAR EKSTRAKURIKULER
     */
    public function daftar(Ekstrakurikuler $ekstrakurikuler)
    {
        $siswa = auth()->user()->siswa;

        // ❌ belum login sebagai siswa
        if (!$siswa) {
            return back()->with('error', 'Akun ini bukan siswa.');
        }

        // ❌ sudah terdaftar
        $sudahDaftar = ExtraPeserta::where('siswa_id', $siswa->id)
            ->where('ekstrakurikuler_id', $ekstrakurikuler->id)
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Kamu sudah terdaftar di ekstrakurikuler ini.');
        }

        // ❌ kuota penuh
        $jumlahPeserta = ExtraPeserta::where('ekstrakurikuler_id', $ekstrakurikuler->id)->count();

        if ($jumlahPeserta >= $ekstrakurikuler->kuota) {
            return back()->with('error', 'Kuota ekstrakurikuler sudah penuh.');
        }

        // ✅ SIMPAN PENDAFTARAN
        ExtraPeserta::create([
            'siswa_id' => $siswa->id,
            'ekstrakurikuler_id' => $ekstrakurikuler->id,
        ]);

        return back()->with('success', 'Berhasil mendaftar ekstrakurikuler.');
    }

    /**
     * SISWA BATAL DARI EKSTRAKURIKULER
     */
    public function batal(Ekstrakurikuler $ekstrakurikuler)
    {
        $siswa = auth()->user()->siswa;

        ExtraPeserta::where('siswa_id', $siswa->id)
            ->where('ekstrakurikuler_id', $ekstrakurikuler->id)
            ->delete();

        return back()->with('success', 'Berhasil keluar dari ekstrakurikuler.');
    }
}
