<?php

namespace App\Http\Controllers;

use App\Models\CatatanPerkembangan;
use App\Models\Siswa;
use App\Models\Walikelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CatatanPerkembanganController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view catatan_perkembangan', only: ['index', 'show']),
            new Middleware('permission:create catatan_perkembangan', only: ['create', 'store']),
            new Middleware('permission:edit catatan_perkembangan', only: ['edit', 'update']),
            new Middleware('permission:delete catatan_perkembangan', only: ['destroy']),
        ];
    }

    public function index()
{
    $user = auth()->user();

    // =====================
    // SISWA
    // =====================
    if ($user->siswa) {
        $catatan = CatatanPerkembangan::with(['siswa.user', 'walikelas.guru.user'])
            ->where('siswa_id', $user->siswa->id)
            ->paginate(10);

        return view('catatan_perkembangan.index', compact('catatan'));
    }

    // =====================
    // ORANG TUA
    // =====================
    if ($user->orangtua && $user->orangtua->siswa_id) {
        $catatan = CatatanPerkembangan::with(['siswa.user', 'walikelas.guru.user'])
            ->where('siswa_id', $user->orangtua->siswa_id)
            ->paginate(10);

        return view('catatan_perkembangan.index', compact('catatan'));
    }

    // =====================
    // GURU / WALI KELAS
    // =====================
    if ($user->guru) {
        $walikelas = Walikelas::where('guru_id', $user->guru->id)->first();

        if ($walikelas) {
            $catatan = CatatanPerkembangan::with(['siswa.user', 'walikelas.guru.user'])
                ->where('walikelas_id', $walikelas->id)
                ->paginate(10);

            $siswaKelas = Siswa::with('user')
                ->where('kelas_id', $walikelas->kelas_id)
                ->get();

            return view('catatan_perkembangan.index', compact('catatan', 'siswaKelas', 'walikelas'));
        }

        return view('catatan_perkembangan.index')->with('catatan', collect());
    }

    // =====================
    // ADMIN
    // =====================
    if ($user->hasRole('admin')) {
        $catatan = CatatanPerkembangan::with(['siswa.user', 'walikelas.guru.user', 'walikelas.kelas'])
            ->paginate(10);

        return view('catatan_perkembangan.index', compact('catatan'));
    }

    // =====================
    // DEFAULT (AMAN)
    // =====================
    return abort(403);
}


   public function create()
{
    $user = auth()->user();
    $walikelas = Walikelas::where('guru_id', $user->guru->id)->first();

    if (!$walikelas) {
        return redirect()->route('catatan_perkembangan.index')
            ->with('error', 'Anda bukan wali kelas.');
    }

    return view('catatan_perkembangan.create', [
        'walikelas' => $walikelas,
        'siswaKelas' => Siswa::with('user')
            ->where('kelas_id', $walikelas->kelas_id)
            ->get(),
        'semesterList' => ['ganjil', 'genap'],
    ]);
}


   public function store(Request $request)
{
    $user = auth()->user();
    $walikelas = Walikelas::where('guru_id', $user->guru->id)->first();

    if (!$walikelas) {
        return redirect()->route('catatan_perkembangan.index')
            ->with('error', 'Anda bukan wali kelas.');
    }

    $validator = Validator::make($request->all(), [
        'siswa_id' => 'required|exists:siswas,id',
        'semester' => 'required|in:ganjil,genap',
        'tahun_ajaran' => 'required', // contoh: 2024/2025
        'catatan_akademik' => 'required|string',
        'catatan_non_akademik' => 'required|string',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $siswa = Siswa::find($request->siswa_id);
    if ($siswa->kelas_id != $walikelas->kelas_id) {
        return back()->with('error', 'Siswa bukan dari kelas Anda.');
    }

    // ❗ CEK DUPLIKAT PER SEMESTER
    $exists = CatatanPerkembangan::where([
        'siswa_id' => $request->siswa_id,
        'semester' => $request->semester,
        'tahun_ajaran' => $request->tahun_ajaran,
    ])->exists();

    if ($exists) {
        return back()->with('error', 'Catatan untuk semester & tahun ajaran ini sudah ada.');
    }

    CatatanPerkembangan::create([
        'siswa_id' => $request->siswa_id,
        'walikelas_id' => $walikelas->id,
        'semester' => $request->semester,
        'tahun_ajaran' => $request->tahun_ajaran,
        'catatan_akademik' => $request->catatan_akademik,
        'catatan_non_akademik' => $request->catatan_non_akademik,
    ]);

    return redirect()->route('catatan_perkembangan.index')
        ->with('success', 'Catatan perkembangan berhasil dibuat.');
}


    public function show(CatatanPerkembangan $catatan_perkembangan)
    {
        $catatan_perkembangan->load(['siswa.user', 'walikelas.guru.user', 'walikelas.kelas']);
        
        return view('catatan_perkembangan.show', compact('catatan_perkembangan'));
    }

    public function edit(CatatanPerkembangan $catatan_perkembangan)
{
    $user = auth()->user();
    $walikelas = Walikelas::where('guru_id', $user->guru->id)->first();

    if (!$walikelas || $catatan_perkembangan->walikelas_id != $walikelas->id) {
        return redirect()->route('catatan_perkembangan.index')
            ->with('error', 'Anda tidak memiliki akses.');
    }

    return view('catatan_perkembangan.edit', compact('catatan_perkembangan'));
}


    public function update(Request $request, CatatanPerkembangan $catatan_perkembangan)
{
    $user = auth()->user();
    $walikelas = Walikelas::where('guru_id', $user->guru->id)->first();

    if (!$walikelas || $catatan_perkembangan->walikelas_id != $walikelas->id) {
        return redirect()->route('catatan_perkembangan.index')
            ->with('error', 'Anda tidak memiliki akses.');
    }

    $validator = Validator::make($request->all(), [
        'catatan_akademik' => 'required|string',
        'catatan_non_akademik' => 'required|string',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $catatan_perkembangan->update([
        'catatan_akademik' => $request->catatan_akademik,
        'catatan_non_akademik' => $request->catatan_non_akademik,
    ]);

    return redirect()->route('catatan_perkembangan.index')
        ->with('success', 'Catatan berhasil diperbarui.');
}

    public function destroy(CatatanPerkembangan $catatan_perkembangan)
    {
        $user = auth()->user();
        $walikelas = Walikelas::where('guru_id', $user->guru->id)->first();

        if (!$walikelas || $catatan_perkembangan->walikelas_id != $walikelas->id) {
            return redirect()->route('catatan_perkembangan.index')
                ->with('error', 'Anda tidak memiliki akses.');
        }

        $catatan_perkembangan->delete();

        return redirect()->route('catatan_perkembangan.index')
            ->with('success', 'Catatan berhasil dihapus.');
    }
}
