<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        return view('jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan'
    ]);

    Jurusan::create([
        'nama_jurusan' => $request->nama_jurusan
    ]);

    return redirect()->route('jurusan.index')
        ->with('success', 'Jurusan berhasil ditambahkan.');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Jurusan $jurusan)
{
    $request->validate([
        'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan,' . $jurusan->id
    ]);

    $jurusan->update([
        'nama_jurusan' => $request->nama_jurusan
    ]);

    return redirect()->route('jurusan.index')
        ->with('success', 'Jurusan berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}
