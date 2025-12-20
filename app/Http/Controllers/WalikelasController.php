<?php

namespace App\Http\Controllers;

use App\Models\Walikelas;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WalikelasController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view walikelas', only: ['index']),
            new Middleware('permission:create walikelas', only: ['create','store']),
            new Middleware('permission:edit walikelas', only: ['edit','update']),
            new Middleware('permission:delete walikelas', only: ['destroy']),
        ];
    }

    public function index()
    {
        $user = auth()->user();

        // Siswa → lihat wali kelas kelasnya
        if ($user->siswa) {
            $kelasId = $user->siswa->kelas_id;

            $walikelas = Walikelas::with(['guru','kelas'])
                ->where('kelas_id', $kelasId)
                ->paginate(10);

            return view('walikelas.index', compact('walikelas'));
        }

        // Guru → lihat hanya wali miliknya
        if ($user->guru) {
            $walikelas = Walikelas::with(['guru','kelas'])
                ->where('guru_id', $user->guru->id)
                ->paginate(10);

            return view('walikelas.index', compact('walikelas'));
        }

        // Admin / TU
        $walikelas = Walikelas::with(['guru','kelas'])->paginate(10);
        return view('walikelas.index', compact('walikelas'));
    }

    public function create()
    {
        return view('walikelas.create', [
            'guru' => Guru::all(),
            'kelas' => Kelas::all(),
        ]);
    }

    public function store(Request $request)
    {
        // 🔍 VALIDATOR
        $validator = Validator::make($request->all(), [
            'guru_id'  => 'required|exists:gurus,id|unique:walikelas,guru_id',
            'kelas_id' => 'required|exists:kelas,id|unique:walikelas,kelas_id',
        ], [
            'guru_id.unique'  => 'Guru ini sudah menjadi wali kelas.',
            'kelas_id.unique' => 'Kelas ini sudah memiliki wali kelas.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // CREATE
        $walikelas = Walikelas::create($validator->validated());

        // Tambahkan role ke guru
        $walikelas->guru->user->assignRole('walikelas');

        return redirect()->route('walikelas.index')
            ->with('success', 'Wali kelas berhasil ditambahkan.');
    }

    public function edit(Walikelas $walikelas)
    {
        return view('walikelas.edit', [
            'walikelas' => $walikelas,
            'guru'      => Guru::all(),
            'kelas'     => Kelas::all(),
        ]);
    }

    public function update(Request $request, Walikelas $walikelas)
    {
        // 🔍 VALIDATOR
        $validator = Validator::make($request->all(), [
            'guru_id'  => "required|exists:gurus,id|unique:walikelas,guru_id,{$walikelas->id}",
            'kelas_id' => "required|exists:kelas,id|unique:walikelas,kelas_id,{$walikelas->id}",
        ], [
            'guru_id.unique'  => 'Guru ini sudah menjadi wali kelas.',
            'kelas_id.unique' => 'Kelas ini sudah memiliki wali kelas.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        // Jika guru diganti
        if ($walikelas->guru_id != $data['guru_id']) {
            // Cek apakah guru lama masih jadi wali di kelas lain
            $guruLama = $walikelas->guru;
            $userLama = $guruLama->user;

            $masihWali = Walikelas::where('guru_id', $guruLama->id)
                ->where('id', '!=', $walikelas->id)
                ->exists();

            if (!$masihWali) {
                $userLama->removeRole('walikelas');
            }

            // Tambahkan role ke guru baru
            $guruBaru = Guru::find($data['guru_id']);
            if ($guruBaru && $guruBaru->user) {
                $guruBaru->user->assignRole('walikelas');
            }
        }

        $walikelas->update($data);

        return redirect()->route('walikelas.index')
            ->with('success', 'Wali kelas berhasil diperbarui.');
    }

    public function destroy(Walikelas $walikelas)
    {
        $guru = $walikelas->guru;
        $user = $guru->user;

        // Cek apakah masih wali di kelas lain
        $masihWali = Walikelas::where('guru_id', $guru->id)
            ->where('id', '!=', $walikelas->id)
            ->exists();

        if (!$masihWali) {
            $user->removeRole('walikelas');
        }

        $walikelas->delete();

        return redirect()->route('walikelas.index')
            ->with('success', 'Wali kelas berhasil dihapus.');
    }
}
