<?php

namespace App\Http\Controllers;

use App\Models\JenisUjian;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisUjianController extends Controller
{
    /**
     * List Jenis Ujian
     * Guru → hanya Jenis Ujian miliknya
     * Admin / TU → semua Jenis Ujian
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'guru') {
            // Guru hanya lihat Jenis Ujian miliknya
            $guru = $user->guru;

            $jenisUjians = JenisUjian::with('guru.mapel')
                ->where('guru_id', $guru->id)
                ->get();
        } else {
            // Admin / TU dapat lihat semua jenis ujian
            $jenisUjians = JenisUjian::with('guru.mapel')->get();
        }

        return view('jenis-ujian.index', compact('jenisUjians', 'user'));
    }

    /**
     * Form tambah Jenis Ujian
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'guru') {
            // guru tidak pilih guru lain
            $gurus = null;
        } else {
            // admin & TU bisa pilih guru
            $gurus = Guru::with('user', 'mapel')->get();
        }

        return view('jenis-ujian.create', compact('gurus', 'user'));
    }

    /**
     * Simpan Jenis Ujian
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Jika guru → guru_id otomatis
        if ($user->role === 'guru') {
            $request->validate([
                'nama_jenis_ujian' => 'required|string|max:255',
            ]);

            $guru_id = $user->guru->id;
        } else {
            // admin & TU harus memilih guru
            $request->validate([
                'guru_id'  => 'required|exists:gurus,id',
                'nama_jenis_ujian' => 'required|string|max:255',
            ]);

            $guru_id = $request->guru_id;
        }

        // ⛔ Cek duplikasi Jenis Ujian untuk guru tersebut
        $cek = JenisUjian::where('guru_id', $guru_id)
            ->where('nama_jenis_ujian', $request->nama_jenis_ujian)
            ->exists();

        if ($cek) {
            return back()->withErrors([
                'nama_jenis_ujian' => 'Jenis Ujian ini sudah ada untuk guru tersebut!'
            ])->withInput();
        }

        // Simpan
        JenisUjian::create([
            'guru_id'  => $guru_id,
            'nama_jenis_ujian' => $request->nama_jenis_ujian,
        ]);

        return redirect()->route('jenis-ujian.index')
            ->with('success', 'Jenis Ujian berhasil dibuat!');
    }

    /**
     * Edit Jenis Ujian
     */
    public function edit(JenisUjian $jenisUjian)
    {
        $user = Auth::user();

        // Guru hanya bisa edit jenis ujian miliknya sendiri
        if ($user->role === 'guru' && $jenisUjian->guru_id !== $user->guru->id) {
            abort(403);
        }

        $gurus = null;

        // Admin & TU bisa ganti guru Jenis Ujian
        if ($user->role !== 'guru') {
            $gurus = Guru::with('user', 'mapel')->get();
        }

        return view('jenis-ujian.edit', compact('jenisUjian', 'gurus', 'user'));
    }

    /**
     * Update Jenis Ujian
     */
    public function update(Request $request, JenisUjian $jenisUjian)
    {
        $user = Auth::user();

        if ($user->role === 'guru') {
            $request->validate([
                'nama_jenis_ujian' => 'required|string|max:255',
            ]);

            // Guru tidak boleh pindahkan jenis ujian ke guru lain
            if ($jenisUjian->guru_id !== $user->guru->id) {
                abort(403);
            }

            $guru_id = $user->guru->id;

        } else {
            // Admin / TU bisa pindahkan jenis ujian ke guru lain
            $request->validate([
                'nama_jenis_ujian' => 'required|string|max:255',
                'guru_id'  => 'required|exists:gurus,id',
            ]);

            $guru_id = $request->guru_id;
        }

        // ⛔ Cek duplikasi kecuali jenis ujian yang sedang diupdate
        $cek = JenisUjian::where('guru_id', $guru_id)
            ->where('nama_jenis_ujian', $request->nama_jenis_ujian)
            ->where('id', '!=', $jenisUjian->id)
            ->exists();

        if ($cek) {
            return back()->withErrors([
                'nama_jenis_ujian' => 'Jenis Ujian ini sudah ada untuk guru tersebut!'
            ])->withInput();
        }

        // Update
        $jenisUjian->update([
            'guru_id'  => $guru_id,
            'nama_jenis_ujian' => $request->nama_jenis_ujian,
        ]);

        return redirect()->route('jenis-ujian.index')
            ->with('success', 'Jenis Ujian berhasil diperbarui!');
    }

    /**
     * Hapus Jenis Ujian
     */
    public function destroy(JenisUjian $jenisUjian)
    {
        $user = Auth::user();

        if ($user->role === 'guru' && $jenisUjian->guru_id !== $user->guru->id) {
            abort(403);
        }

        $jenisUjian->delete();

        return redirect()->route('jenis-ujian.index')
            ->with('success', 'Jenis Ujian berhasil dihapus!');
    }
}