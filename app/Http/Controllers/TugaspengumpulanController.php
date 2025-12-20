<?php

namespace App\Http\Controllers;

use App\Models\TugasPengumpulan;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TugasPengumpulanController extends Controller
{
    // ============================
    // INDEX
    // ============================
    public function index()
    {
        $user = Auth::user();

        if ($user->siswa) {
            // Siswa hanya lihat pengumpulan miliknya
            $pengumpulan = TugasPengumpulan::with([
                'tugas.mapel',
                'tugas.guru.user'
            ])
            ->where('siswa_id', $user->siswa->id)
            ->latest()
            ->paginate(10);
        } else {
            // Guru/Admin lihat semua
            $pengumpulan = TugasPengumpulan::with([
                'tugas.mapel',
                'tugas.guru.user'
            ])
            ->latest()
            ->paginate(10);
        }

        return view('pengumpulan.index', compact('pengumpulan'));
    }

    // ============================
    // FORM CREATE
    // ============================
    public function create(Tugas $tugas)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        // Siswa hanya boleh akses tugas kelasnya
        if ($tugas->kelas_id != $siswa->kelas_id) {
            abort(403, "Anda tidak boleh mengumpulkan tugas kelas lain.");
        }

        // sudah submit?
        if (TugasPengumpulan::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->exists()) 
        {
            return redirect()->route('tugas.show', $tugas)
                ->with('error', 'Anda sudah mengumpulkan tugas ini.');
        }

        // cek deadline
        if (now()->greaterThan($tugas->deadline)) {
            return redirect()->route('tugas.show', $tugas)
                ->with('error', 'Deadline pengumpulan sudah lewat.');
        }

        return view('pengumpulan.create', compact('tugas'));
    }

    // ============================
    // STORE
    // ============================
    public function store(Request $request, Tugas $tugas)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        // Cek kelas
        if ($tugas->kelas_id != $siswa->kelas_id) {
            abort(403, "Anda tidak boleh mengumpulkan tugas kelas lain.");
        }

        $validated = $request->validate([
            'file_pengumpulan' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:10240',
            'catatan' => 'nullable|string|max:1000'
        ]);

        // upload file
        $file_path = $request->file('file_pengumpulan')->store('pengumpulan', 'public');

        TugasPengumpulan::create([
            'tugas_id' => $tugas->id,
            'siswa_id' => $siswa->id,
            'file_pengumpulan' => $file_path,
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()
            ->route('tugas.by.mapel', $tugas->mapel)
            ->with('success', 'Tugas berhasil dikumpulkan!');
    }

    // ============================
    // SHOW DETAIL PENGUMPULAN
    // ============================
    public function show($id)
    {
        $pengumpulan = TugasPengumpulan::with([
            'tugas.mapel',
            'tugas.kelas',
            'tugas.guru.user',
            'siswa.user'
        ])->findOrFail($id);

        $user = Auth::user();

        // siswa hanya boleh lihat punya sendiri & kelasnya
        if ($user->siswa) {
            if (
                $pengumpulan->siswa_id != $user->siswa->id ||
                $pengumpulan->tugas->kelas_id != $user->siswa->kelas_id
            ) {
                abort(403, "Anda tidak boleh melihat pengumpulan ini.");
            }
        }

        return view('pengumpulan.show', compact('pengumpulan'));
    }

    // ============================
    // UPDATE NILAI (Guru)
    // ============================
    public function updateNilai(Request $request, TugasPengumpulan $pengumpulan)
    {
        $request->validate([
            'nilai' => 'nullable|integer|min:0|max:100',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Pastikan guru hanya menilai tugas miliknya
        $user = Auth::user();

        if ($user->guru) {
            if ($pengumpulan->tugas->guru_id != $user->guru->id) {
                abort(403, "Anda tidak boleh menilai tugas ini.");
            }
        }

        $pengumpulan->update([
            'nilai' => $request->nilai,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('tugas.show', $pengumpulan->tugas)
            ->with('success', 'Nilai berhasil disimpan!');
    }

    // ============================
    // DOWNLOAD FILE
    // ============================
    public function downloadFile(TugasPengumpulan $pengumpulan)
    {
        if (!Storage::disk('public')->exists($pengumpulan->file_pengumpulan)) {
            abort(404);
        }

        return Storage::disk('public')->download($pengumpulan->file_pengumpulan);
    }
}
