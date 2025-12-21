<?php

namespace App\Http\Controllers;

use App\Models\JenisUjian;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisUjianController extends Controller
{
    /**
     * =========================
     * LIST JENIS UJIAN
     * =========================
     */
    public function index()
    {
        $user = Auth::user();

        // GURU → hanya lihat miliknya
        if ($user->guru) {
            $jenisUjians = JenisUjian::with('guru.mapel')
                ->where('guru_id', $user->guru->id)
                ->get();
        }
        // TU / SUPERADMIN → lihat semua
        else {
            $jenisUjians = JenisUjian::with('guru.mapel')->get();
        }

        return view('jenis-ujian.index', compact('jenisUjians'));
    }

    /**
     * =========================
     * FORM TAMBAH
     * =========================
     */
    public function create()
    {
        $user = Auth::user();

        // GURU → tidak boleh pilih guru
        if ($user->guru) {
            $gurus = null;
        }
        // TU / SUPERADMIN → bisa pilih guru
        else {
            $gurus = Guru::with('user', 'mapel')->get();
        }

        return view('jenis-ujian.create', compact('gurus'));
    }

    /**
     * =========================
     * SIMPAN
     * =========================
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // =========================
        // GURU
        // =========================
        if ($user->guru) {
            $request->validate([
                'nama_jenis_ujian' => 'required|string|max:255',
            ]);

            $guru_id = $user->guru->id;
        }
        // =========================
        // TU / SUPERADMIN
        // =========================
        else {
            $request->validate([
                'guru_id' => 'required|exists:gurus,id',
                'nama_jenis_ujian' => 'required|string|max:255',
            ]);

            $guru_id = $request->guru_id;
        }

        // Cegah duplikasi
        $exists = JenisUjian::where('guru_id', $guru_id)
            ->where('nama_jenis_ujian', $request->nama_jenis_ujian)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'nama_jenis_ujian' => 'Jenis ujian sudah ada untuk guru ini'
            ])->withInput();
        }

        JenisUjian::create([
            'guru_id' => $guru_id,
            'nama_jenis_ujian' => $request->nama_jenis_ujian,
        ]);

        return redirect()->route('jenis-ujian.index')
            ->with('success', 'Jenis ujian berhasil dibuat');
    }

    /**
     * =========================
     * FORM EDIT
     * =========================
     */
    public function edit(JenisUjian $jenisUjian)
    {
        $user = Auth::user();

        // Guru hanya boleh edit miliknya
        if ($user->guru && $jenisUjian->guru_id !== $user->guru->id) {
            abort(403);
        }

        $gurus = $user->guru
            ? null
            : Guru::with('user', 'mapel')->get();

        return view('jenis-ujian.edit', compact('jenisUjian', 'gurus'));
    }

    /**
     * =========================
     * UPDATE
     * =========================
     */
    public function update(Request $request, JenisUjian $jenisUjian)
    {
        $user = Auth::user();

        // =========================
        // GURU
        // =========================
        if ($user->guru) {
            abort_if($jenisUjian->guru_id !== $user->guru->id, 403);

            $request->validate([
                'nama_jenis_ujian' => 'required|string|max:255',
            ]);

            $guru_id = $user->guru->id;
        }
        // =========================
        // TU / SUPERADMIN
        // =========================
        else {
            $request->validate([
                'guru_id' => 'required|exists:gurus,id',
                'nama_jenis_ujian' => 'required|string|max:255',
            ]);

            $guru_id = $request->guru_id;
        }

        // Cegah duplikasi
        $exists = JenisUjian::where('guru_id', $guru_id)
            ->where('nama_jenis_ujian', $request->nama_jenis_ujian)
            ->where('id', '!=', $jenisUjian->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'nama_jenis_ujian' => 'Jenis ujian sudah ada untuk guru ini'
            ])->withInput();
        }

        $jenisUjian->update([
            'guru_id' => $guru_id,
            'nama_jenis_ujian' => $request->nama_jenis_ujian,
        ]);

        return redirect()->route('jenis-ujian.index')
            ->with('success', 'Jenis ujian berhasil diperbarui');
    }

    /**
     * =========================
     * HAPUS
     * =========================
     */
    public function destroy(JenisUjian $jenisUjian)
    {
        $user = Auth::user();

        // Guru hanya boleh hapus miliknya
        if ($user->guru && $jenisUjian->guru_id !== $user->guru->id) {
            abort(403);
        }

        $jenisUjian->delete();

        return redirect()->route('jenis-ujian.index')
            ->with('success', 'Jenis ujian berhasil dihapus');
    }
}
