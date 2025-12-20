<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembina;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    /**
     * LIST PEMBINA
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::role('pembina')->with('pembina');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pembina = $query->latest()->paginate(10);

        return view('pembina.index', compact('pembina', 'search'));
    }

    /**
     * FORM TAMBAH PEMBINA
     */
    public function create()
    {
        return view('pembina.create');
    }

    /**
     * SIMPAN PEMBINA BARU
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
            'agama'          => 'nullable|string|max:50',
        ]);

        // 1. SIMPAN USER
        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => $request->password,
        ]);

        // 2. ROLE
        $user->assignRole('pembina');

        // 3. SIMPAN DATA PEMBINA
        Pembina::create([
            'user_id'        => $user->id,
            'alamat'         => $request->alamat,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'agama'          => $request->agama,
        ]);

        return redirect()->route('pembina.index')->with('success', 'Data pembina berhasil ditambahkan!');
    }

    /**
     * EDIT PEMBINA
     */
    public function edit($id)
    {
        $user = User::with('pembina')->findOrFail($id);
        return view('pembina.edit', compact('user'));
    }

    /**
     * UPDATE PEMBINA
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
            'agama'          => 'nullable|string|max:50',
        ]);

        // UPDATE USER
        $user->update([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
        ]);

        // UPDATE PEMBINA
        if ($user->pembina) {
            $user->pembina->update([
                'alamat'         => $request->alamat,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'agama'          => $request->agama,
            ]);
        } else {
            Pembina::create([
                'user_id'        => $user->id,
                'alamat'         => $request->alamat,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'agama'          => $request->agama,
            ]);
        }

        return redirect()->route('pembina.index')->with('success', 'Data pembina berhasil diperbarui!');
    }

    /**
     * HAPUS PEMBINA
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('pembina')) {
            $user->delete();
            return redirect()->route('pembina.index')->with('success', 'Data pembina berhasil dihapus!');
        }

        return redirect()->route('pembina.index')->with('error', 'Hanya data pembina yang dapat dihapus.');
    }
}
