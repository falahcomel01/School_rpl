<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * 
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::role('guru')->with('guru.mapel');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $guru = $query->latest()->paginate(10);

        return view('guru.list', compact('guru', 'search'));
    }

    /**
     * FORM TAMBAH GURU
     */
    public function create()
    {
        $mapels = Mapel::all();
        return view('guru.create', compact('mapels'));
    }

    /**
     * SIMPAN DATA GURU BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'username'       => 'required|string|max:255|unique:users,username',
            'email'          => 'nullable|email|unique:users,email',
            'password'       => 'required|string|min:5',
            'alamat'         => 'nullable|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'nullable|string|in:Laki-laki,Perempuan',
            'mapel_id'       => 'nullable|exists:mapels,id',
        ]);

        // 1. SIMPAN USER
        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
              'password' => $request->password,
        ]);

        // 2. TAMBAHKAN ROLE
        $user->assignRole('guru');

        // 3. SIMPAN DATA DI TABEL GURU
        Guru::create([
            'user_id'        => $user->id,
            'alamat'         => $request->alamat,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'mapel_id'       => $request->mapel_id,
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * EDIT GURU
     */
    public function edit($id)
    {
        $user = User::with('guru.mapel')->findOrFail($id);
        $mapels = Mapel::all();

        return view('guru.edit', compact('user', 'mapels'));
    }

    /**
     * UPDATE DATA GURU
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'username'       => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'          => 'nullable|email|unique:users,email,' . $user->id,
            'alamat'         => 'nullable|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'nullable|string|in:Laki-laki,Perempuan',
            'mapel_id'       => 'nullable|exists:mapels,id',
        ]);

        $user->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
        ]);

        if ($user->guru) {
            $user->guru->update([
                'alamat'         => $request->alamat,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'mapel_id'       => $request->mapel_id,
            ]);
        } else {
            Guru::create([
                'user_id'        => $user->id,
                'alamat'         => $request->alamat,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'mapel_id'       => $request->mapel_id,
            ]);
        }

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * HAPUS GURU
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('guru')) {
            $user->delete();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
        }

        return redirect()->route('guru.index')->with('error', 'Hanya data guru yang dapat dihapus.');
    }
}
