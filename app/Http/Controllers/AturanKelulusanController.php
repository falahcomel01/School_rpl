<?php

namespace App\Http\Controllers;

use App\Models\AturanKelulusan;
use Illuminate\Http\Request;

class AturanKelulusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aturan = AturanKelulusan::orderBy('tahun', 'desc')->get();
        return view('aturan-kelulusan.index', compact('aturan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aturan-kelulusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nilai_minimal' => 'required|integer|min:0|max:100',
            'tahun'         => 'required|digits:4|unique:aturan_kelulusans,tahun',
        ]);

        AturanKelulusan::create([
            'nilai_minimal' => $request->nilai_minimal,
            'tahun'         => $request->tahun,
        ]);

        return redirect()
            ->route('aturan-kelulusan.index')
            ->with('success', 'Aturan kelulusan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(AturanKelulusan $aturanKelulusan)
    {
        return view('aturan-kelulusan.show', compact('aturanKelulusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AturanKelulusan $aturanKelulusan)
    {
        return view('aturan-kelulusan.edit', compact('aturanKelulusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AturanKelulusan $aturanKelulusan)
    {
        $request->validate([
            'nilai_minimal' => 'required|integer|min:0|max:100',
            'tahun'         => 'required|digits:4|unique:aturan_kelulusans,tahun,' . $aturanKelulusan->id,
        ]);

        $aturanKelulusan->update([
            'nilai_minimal' => $request->nilai_minimal,
            'tahun'         => $request->tahun,
        ]);

        return redirect()
            ->route('aturan-kelulusan.index')
            ->with('success', 'Aturan kelulusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AturanKelulusan $aturanKelulusan)
    {
        $aturanKelulusan->delete();

        return redirect()
            ->route('aturan-kelulusan.index')
            ->with('success', 'Aturan kelulusan berhasil dihapus');
    }
}
