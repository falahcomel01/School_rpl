<?php

namespace App\Http\Controllers;
use App\Models\Mapel;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::with('jurusan')->paginate(10); // 10 per halaman
return view('mapel.index', compact('mapels'));

    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('mapel.create', compact('jurusan'));
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'nama_mapel' => [
            'required',
            Rule::unique('mapels')->where(function ($q) use ($request) {
                return $q->where('jurusan_id', $request->jurusan_id);
            }),
        ],
        'jurusan_id' => 'nullable|exists:jurusans,id',
    ]);

    Mapel::create($validated);

    return redirect()->route('mapel.index')->with('success', 'Mapel berhasil ditambahkan');
}

    public function edit(Mapel $mapel)
    {
        $jurusan = Jurusan::all();
        return view('mapel.edit', compact('mapel', 'jurusan'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $validator = Validator::make($request->all(), [

            'jurusan_id' => 'nullable|exists:jurusans,id',

            'nama_mapel' => [
                'required',
                Rule::unique('mapels')
                    ->where(fn($q) =>
                        $q->where('jurusan_id', $request->jurusan_id)
                    )
                    ->ignore($mapel->id),
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $mapel->update([
            'jurusan_id' => $request->jurusan_id,
            'nama_mapel' => $request->nama_mapel,
        ]);

        return redirect()->route('mapel.index')
            ->with('success', 'Mapel berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('mapel.index')
            ->with('success', 'Mapel berhasil dihapus.');
    }
}
