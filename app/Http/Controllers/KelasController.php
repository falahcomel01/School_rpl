<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('jurusan')->latest()->get();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('kelas.create', compact('jurusan'));
    }

    public function store(Request $request)
{
   
    $validator = Validator::make($request->all(), [
        'nama_kelas' => ['required', 'string', 'max:255'],
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $nama = $request->nama_kelas;
    $jurusanRequired = false;

    
    if (preg_match('/11|12/', $nama)) {
        // Jika mengandung 11 atau 12 → jurusan wajib
        $jurusanRequired = true;
    }

   
    $rules = [
        'nama_kelas' => [
            'required',
            Rule::unique('kelas')->where(function ($q) use ($request) {
                return $q->where('jurusan_id', $request->jurusan_id);
            }),
        ],
    ];

    if ($jurusanRequired) {
        $rules['jurusan_id'] = 'required|exists:jurusans,id';
    } else {
        $rules['jurusan_id'] = 'nullable|exists:jurusans,id';
    }

    // Validasi lengkap
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Simpan data
    Kelas::create([
        'jurusan_id' => $request->jurusan_id,
        'nama_kelas' => $request->nama_kelas,
    ]);

    return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
}


    public function edit(Kelas $kelas)
    {
        $jurusan = Jurusan::all();
        return view('kelas.edit', compact('kelas', 'jurusan'));
    }

   public function update(Request $request, Kelas $kelas)
{
    // Validasi nama kelas dulu
    $validator = Validator::make($request->all(), [
        'nama_kelas' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $nama = $request->nama_kelas;
    $jurusanRequired = false;

    // Aturan kelas
    if (preg_match('/11|12/', $nama)) {
        // Jika mengandung 11 atau 12 → jurusan wajib
        $jurusanRequired = true;
    }

    // Aturan validasi lanjutan
    $rules = [
        'nama_kelas' => [
            'required',
            Rule::unique('kelas')->where(function ($q) use ($request) {
                return $q->where('jurusan_id', $request->jurusan_id);
            })->ignore($kelas->id),
        ],
    ];

    if ($jurusanRequired) {
        $rules['jurusan_id'] = 'required|exists:jurusans,id';
    } else {
        $rules['jurusan_id'] = 'nullable|exists:jurusans,id';
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Update
    $kelas->update([
        'jurusan_id' => $request->jurusan_id,
        'nama_kelas' => $request->nama_kelas,
    ]);

    return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
}


    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
