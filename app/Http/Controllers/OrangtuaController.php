<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function index()
    {
        $orangtua = Orangtua::with(['user', 'siswa.user'])->get();
        return view('orangtua.index', compact('orangtua'));
    }

    public function create()
    {
        // Ambil ID orangtua yang sudah terhubung dengan siswa
        $connectedOrangtuaIds = Orangtua::pluck('user_id')->toArray();
        
        // Ambil ID siswa yang sudah terhubung dengan orangtua
        $connectedSiswaIds = Orangtua::pluck('siswa_id')->toArray();
        
        // Ambil user dengan role orangtua yang BELUM terhubung
        $orangtuaUsers = User::role('orangtua')
            ->whereNotIn('id', $connectedOrangtuaIds)
            ->get();
        
        // Ambil siswa yang BELUM terhubung dengan orangtua
        $siswas = Siswa::with('user')
            ->whereNotIn('id', $connectedSiswaIds)
            ->get();
        
        // Pesan jika tidak ada data tersedia
        $noOrangtuaAvailable = $orangtuaUsers->isEmpty();
        $noSiswaAvailable = $siswas->isEmpty();
        
        return view('orangtua.create', compact(
            'siswas', 
            'orangtuaUsers', 
            'noOrangtuaAvailable', 
            'noSiswaAvailable'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'  => [
                'required',
                'exists:users,id',
                // Validasi: orangtua ini belum terhubung dengan siswa lain
                function ($attribute, $value, $fail) {
                    if (Orangtua::where('user_id', $value)->exists()) {
                        $fail('Orangtua ini sudah terhubung dengan siswa lain.');
                    }
                },
            ],
            'siswa_id' => [
                'required',
                'exists:siswas,id',
                // Validasi: siswa ini belum terhubung dengan orangtua lain
                function ($attribute, $value, $fail) {
                    if (Orangtua::where('siswa_id', $value)->exists()) {
                        $fail('Siswa ini sudah terhubung dengan orangtua lain.');
                    }
                },
            ],
        ], [
            'user_id.required' => 'Silakan pilih orangtua.',
            'user_id.exists' => 'Data orangtua tidak valid.',
            'siswa_id.required' => 'Silakan pilih siswa.',
            'siswa_id.exists' => 'Data siswa tidak valid.',
        ]);

        Orangtua::create([
            'user_id' => $request->user_id,
            'siswa_id' => $request->siswa_id,
        ]);

        return redirect()->route('orangtua.index')
            ->with('success', 'Orang tua berhasil ditambahkan dan terhubung dengan siswa!');
    }

    public function edit($id)
    {
        $orangtua = Orangtua::with(['user', 'siswa.user'])->findOrFail($id);
        
        // Untuk edit, tampilkan:
        // 1. Orangtua yang sedang diedit (current)
        // 2. Orangtua yang belum terhubung
        $connectedOrangtuaIds = Orangtua::where('id', '!=', $id)
            ->pluck('user_id')
            ->toArray();
        
        $orangtuaUsers = User::role('orangtua')
            ->whereNotIn('id', $connectedOrangtuaIds)
            ->get();
        
        // Untuk siswa:
        // 1. Siswa yang sedang terhubung (current)
        // 2. Siswa yang belum terhubung
        $connectedSiswaIds = Orangtua::where('id', '!=', $id)
            ->pluck('siswa_id')
            ->toArray();
        
        $siswas = Siswa::with('user')
            ->whereNotIn('id', $connectedSiswaIds)
            ->get();
        
        return view('orangtua.edit', compact('orangtua', 'siswas', 'orangtuaUsers'));
    }

    public function update(Request $request, $id)
    {
        $orangtua = Orangtua::findOrFail($id);
        
        $request->validate([
            'user_id'  => [
                'required',
                'exists:users,id',
                // Validasi: orangtua ini belum terhubung dengan siswa lain (kecuali record ini)
                function ($attribute, $value, $fail) use ($id) {
                    if (Orangtua::where('user_id', $value)->where('id', '!=', $id)->exists()) {
                        $fail('Orangtua ini sudah terhubung dengan siswa lain.');
                    }
                },
            ],
            'siswa_id' => [
                'required',
                'exists:siswas,id',
                // Validasi: siswa ini belum terhubung dengan orangtua lain (kecuali record ini)
                function ($attribute, $value, $fail) use ($id) {
                    if (Orangtua::where('siswa_id', $value)->where('id', '!=', $id)->exists()) {
                        $fail('Siswa ini sudah terhubung dengan orangtua lain.');
                    }
                },
            ],
        ], [
            'user_id.required' => 'Silakan pilih orangtua.',
            'user_id.exists' => 'Data orangtua tidak valid.',
            'siswa_id.required' => 'Silakan pilih siswa.',
            'siswa_id.exists' => 'Data siswa tidak valid.',
        ]);

        $orangtua->update([
            'user_id' => $request->user_id,
            'siswa_id' => $request->siswa_id,
        ]);

        return redirect()->route('orangtua.index')
            ->with('success', 'Data hubungan orangtua dan siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ortu = Orangtua::findOrFail($id);
        $ortu->delete();

        return back()->with('success', 'Hubungan orangtua dan siswa berhasil dihapus.');
    }
}