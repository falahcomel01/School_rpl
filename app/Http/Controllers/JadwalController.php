<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
   public function index()
{
    $user = auth()->user();

    $jadwals = Jadwal::with(['guru.user', 'mapel', 'kelas.jurusan'])
        ->when($user->hasRole('siswa'), function ($q) use ($user) {
    return $q->where('kelas_id', $user->siswa->kelas_id);
})

        ->when($user->hasRole('guru'), function ($q) use ($user) {
            return $q->where('guru_id', $user->guru->id);
        })
        ->when($user->hasRole('orangtua'), function ($q) use ($user) {
    return $q->where('kelas_id', $user->orangtua->siswa->kelas_id);
})

        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get()
        ->groupBy('hari');

    return view('jadwal.index', compact('jadwals'));
}


    /** 
     * 
     */
    public function create()
    {
        $guruList = Guru::with('user')->get();
        $kelasList = Kelas::with(['jurusan'])->get();

        return view('jadwal.create', compact('guruList', 'kelasList'));
    }

    /** 
     * 
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hari'        => 'required',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kelas_id'    => 'required|exists:kelas,id',
            'mapel_id'    => 'required|exists:mapels,id',
            'guru_id'     => 'required|exists:gurus,id',
        ], [
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Ambil input waktu dan validasi durasi
        $jamMulai = substr($request->jam_mulai, 0, 5);
        $jamSelesai = substr($request->jam_selesai, 0, 5);

        list($hMulai, $mMulai) = explode(':', $jamMulai);
        list($hSelesai, $mSelesai) = explode(':', $jamSelesai);

        $durasi = (($hSelesai * 60 + $mSelesai) - ($hMulai * 60 + $mMulai));

        if ($durasi < 30) {
            return back()->withErrors(['jam_selesai' => 'Durasi minimal 30 menit!'])->withInput();
        }

       $cekBentrokKelas = Jadwal::where('hari', $request->hari)
        ->where('kelas_id', $request->kelas_id)
        ->where(function ($q) use ($jamMulai, $jamSelesai) {
            $q->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
              ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
              ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                  $q2->where('jam_mulai', '<=', $jamMulai)
                     ->where('jam_selesai', '>=', $jamSelesai);
              });
        })
        ->exists();

    if ($cekBentrokKelas) {
        return back()->withErrors(['jam_mulai' => 'Jadwal bentrok dengan kelas lain!'])->withInput();
    }

    // CEK BENTROK GURU
    $cekBentrokGuru = Jadwal::where('hari', $request->hari)
        ->where('guru_id', $request->guru_id)
        ->where(function ($q) use ($jamMulai, $jamSelesai) {
            $q->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
              ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
              ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                  $q2->where('jam_mulai', '<=', $jamMulai)
                     ->where('jam_selesai', '>=', $jamSelesai);
              });
        })
        ->exists();

    if ($cekBentrokGuru) {
        return back()->withErrors(['guru_id' => 'Guru sudah mengajar di jam ini!'])->withInput();
    }

    // JIKA LOLOS → SIMPAN
    Jadwal::create([
        'hari' => $request->hari,
        'jam_mulai' => $jamMulai,
        'jam_selesai' => $jamSelesai,
        'kelas_id' => $request->kelas_id,
        'mapel_id' => $request->mapel_id,
        'guru_id' => $request->guru_id,
    ]);

    return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
}
    /** 
     * 
     */
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $guruList = Guru::with('user')->get();
        $kelasList = Kelas::with(['jurusan'])->get();

        return view('jadwal.edit', compact('jadwal', 'guruList', 'kelasList'));
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hari'        => 'required',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kelas_id'    => 'required|exists:kelas,id',
            'mapel_id'    => 'required|exists:mapels,id',
            'guru_id'     => 'required|exists:gurus,id',
        ], [
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $jamMulai = substr($request->jam_mulai, 0, 5);
        $jamSelesai = substr($request->jam_selesai, 0, 5);

        list($hMulai, $mMulai) = explode(':', $jamMulai);
        list($hSelesai, $mSelesai) = explode(':', $jamSelesai);

        $durasi = (($hSelesai * 60 + $mSelesai) - ($hMulai * 60 + $mMulai));

        if ($durasi < 30) {
            return back()->withErrors(['jam_selesai' => 'Durasi minimal 30 menit!'])->withInput();
        }

        $cekBentrokKelas = Jadwal::where('hari', $request->hari)
        ->where('kelas_id', $request->kelas_id)
        ->where('id', '!=', $id)
        ->where(function ($q) use ($jamMulai, $jamSelesai) {
            $q->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
              ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
              ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                    $q2->where('jam_mulai', '<=', $jamMulai)
                       ->where('jam_selesai', '>=', $jamSelesai);
              });
        })
        ->exists();

    if ($cekBentrokKelas) {
        return back()->withErrors([
            'jam_mulai' => 'Jadwal bentrok dengan jadwal lain di kelas ini!'
        ])->withInput();
    }

    //  CEK BENTROK GURU (tidak cek dirinya sendiri)
    $cekBentrokGuru = Jadwal::where('hari', $request->hari)
        ->where('guru_id', $request->guru_id)
        ->where('id', '!=', $id)
        ->where(function ($q) use ($jamMulai, $jamSelesai) {
            $q->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
              ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
              ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                    $q2->where('jam_mulai', '<=', $jamMulai)
                       ->where('jam_selesai', '>=', $jamSelesai);
              });
        })
        ->exists();

    if ($cekBentrokGuru) {
        return back()->withErrors([
            'guru_id' => '⚠️ Guru sudah mengajar di jam ini!'
        ])->withInput();
    }

    //  UPDATE DATA
    $jadwal = Jadwal::findOrFail($id);
    $jadwal->update([
        'hari'        => $request->hari,
        'jam_mulai'   => $jamMulai,
        'jam_selesai' => $jamSelesai,
        'kelas_id'    => $request->kelas_id,
        'mapel_id'    => $request->mapel_id,
        'guru_id'     => $request->guru_id,
    ]);

    return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
}

    /** 
     * 
    */
    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

   
    public function getMapelkelas($id)
    {
        $kelas = Kelas::with('jurusan')->findOrFail($id);

        $mapel = Mapel::where(function ($q) use ($kelas) {
            $q->whereNull('jurusan_id');
            if ($kelas->jurusan_id) { 
                $q->orWhere('jurusan_id', $kelas->jurusan_id);
            }
        })->get(['id', 'nama_mapel']);

        return response()->json(data: $mapel);
    }
    public function getGuruByMapel($mapel_id)
{
    $guru = Guru::with('user')
        ->where('mapel_id', $mapel_id)
        ->get()
        ->map(function ($g) {
            return [
                'id' => $g->id,
                'nama' => $g->user->name,
            ];
        });

    return response()->json($guru);
}


}
