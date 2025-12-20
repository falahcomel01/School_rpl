<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tugas;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->guru && !$user->siswa) {
            abort(403, 'Hanya guru dan siswa yang dapat mengakses halaman ini.');
        }

        // Guru → tampilkan tugas miliknya
        if ($user->guru) {
            $tugas = Tugas::where('guru_id', $user->guru->id)
                ->latest()
                ->paginate(10);

            return view('tugas.index_guru', compact('tugas'));
        }

        // Siswa → tampilkan mapel berdasarkan jadwal kelas
        if ($user->siswa) {
            $kelas_id = $user->siswa->kelas_id;

            $mapel = Mapel::whereIn(
                'id',
                Jadwal::where('kelas_id', $kelas_id)->pluck('mapel_id')
            )->withCount(['tugas' => function($query) use ($kelas_id) {
                $query->where('kelas_id', $kelas_id);
            }])->get();

            return view('tugas.index_siswa', compact('mapel'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->guru) {
            abort(403, 'Hanya guru yang dapat membuat tugas.');
        }

        $mapel = $user->guru->mapel;

        $kelas = Kelas::whereIn(
            'id',
            Jadwal::where('mapel_id', $mapel->id)->pluck('kelas_id')
        )->get();

        $mapels = collect([$mapel]);

        return view('tugas.create', compact('mapels', 'kelas'));
    }

    /**
     * Store the newly created resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapel_id'   => 'required|exists:mapels,id',
            'kelas_id'   => 'required|exists:kelas,id',
            'judul_tugas'=> 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'deadline'   => 'required|date|after:now',
            'file_tugas' => 'nullable|file|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!Auth::user()->guru) {
            abort(403, 'Hanya guru yang dapat membuat tugas.');
        }

        $data = $validator->validated();
        $data['guru_id'] = Auth::user()->guru->id;

        if ($request->hasFile('file_tugas')) {
            $data['file_tugas'] = $request->file('file_tugas')->store('tugas', 'public');
        }

        Tugas::create($data);

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dibuat');
    }

    /**
     * Display specific tugas.
     */
   public function show(Tugas $tugas)
{
    $user = Auth::user();

    // Jika siswa, pastikan tugas adalah kelas dia
    if ($user->siswa) {
        if ($tugas->kelas_id != $user->siswa->kelas_id) {
            abort(403, "Anda tidak boleh melihat tugas kelas lain.");
        }
    }

    $tugas->load(['mapel', 'guru.user', 'kelas.siswas.user', 'pengumpulan.siswa.user']);
    $expired = now()->greaterThan($tugas->deadline);

    return view('tugas.show', compact('tugas', 'expired'));
}

    public function byMapel(Mapel $mapel)
    {
        $user = Auth::user();
        
        // Query tugas berdasarkan mapel
        $query = Tugas::where('mapel_id', $mapel->id);
        
        // Jika siswa, filter hanya tugas untuk kelasnya
        if ($user->siswa) {
            $query->where('kelas_id', $user->siswa->kelas_id);
        }
        
        $tugas = $query->latest()->paginate(10);

        $tugas->getCollection()->transform(function ($t) {
            $t->deadline = Carbon::parse($t->deadline);
            $t->isDeadlinePassed = now()->isAfter($t->deadline);
            return $t;
        });

        return view('tugas.index_by_mapel', compact('mapel', 'tugas'));
    }

    /**
     * Edit a tugas (guru only & harus pemilik).
     */
    public function edit(Tugas $tugas)
    {
        $user = Auth::user();

        if (!$user->guru || $user->guru->id !== $tugas->guru_id) {
            abort(403, 'Anda tidak berhak mengedit tugas ini.');
        }

        $mapels = Mapel::where('guru_id', $user->guru->id)->get();
        $kelas = Kelas::all();

        return view('tugas.edit', compact('tugas', 'mapels', 'kelas'));
    }

    /**
     * Update the tugas.
     */
    public function update(Request $request, Tugas $tugas)
    {
        $user = Auth::user();

        if (!$user->guru || $user->guru->id !== $tugas->guru_id) {
            abort(403, 'Anda tidak berhak mengupdate tugas ini.');
        }

        $validator = Validator::make($request->all(), [
            'mapel_id'   => 'required|exists:mapels,id',
            'kelas_id'   => 'required|exists:kelas,id',
            'judul_tugas'=> 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'deadline'   => 'required|date|after:now',
            'file_tugas' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:10240',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cek apakah mapel benar-benar milik guru ini
        $mapel = Mapel::findOrFail($request->mapel_id);

        if ($mapel->guru_id !== $user->guru->id) {
            abort(403, 'Anda tidak mengajar mapel ini.');
        }

        $data = $validator->validated();
        $data['guru_id'] = $user->guru->id;

        if ($request->hasFile('file_tugas')) {
            if ($tugas->file_tugas) {
                Storage::disk('public')->delete($tugas->file_tugas);
            }
            $data['file_tugas'] = $request->file('file_tugas')->store('tugas', 'public');
        }

        $tugas->update($data);

        return redirect()->route('tugas.show', $tugas)->with('success', 'Tugas berhasil diperbarui');
    }

    /**
     * Delete tugas.
     */
    public function destroy(Tugas $tugas)
    {
        $user = Auth::user();

        if (!$user->guru || $user->guru->id !== $tugas->guru_id) {
            abort(403, 'Anda tidak berhak menghapus tugas ini.');
        }

        if ($tugas->file_tugas) {
            Storage::disk('public')->delete($tugas->file_tugas);
        }

        foreach ($tugas->pengumpulan as $p) {
            if ($p->file_pengumpulan) {
                Storage::disk('public')->delete($p->file_pengumpulan);
            }
        }

        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus');
    }

    /**
     * Download file tugas.
     */
    public function downloadFile(Tugas $tugas)
    {
        if (!$tugas->file_tugas || !Storage::disk('public')->exists($tugas->file_tugas)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($tugas->file_tugas);
    }
}
