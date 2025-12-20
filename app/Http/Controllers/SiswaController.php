<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SiswaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view siswa', only: ['index']),
            new Middleware('permission:edit siswa', only: ['edit', 'update']),
            new Middleware('permission:delete siswa', only: ['destroy']),
        ];
    }

    /**
     * 📋 Menampilkan daftar siswa
     */
 public function index(Request $request)
{
    $user = auth()->user();
    $search = $request->input('search');

    // Default: admin atau guru biasa
    $query = User::role('siswa')
        ->with(['siswa.kelas.jurusan']);

    // Jika user walikelas
    if ($user->hasRole('walikelas')) {

        // Cek apakah dia benar punya tugas wali kelas
        if (!$user->walikelas) {
            return redirect()->back()->with('error', 'Anda belum ditetapkan sebagai wali kelas.');
        }

        $kelasId = $user->walikelas->kelas_id;

        $query->whereHas('siswa', function ($q) use ($kelasId) {
            $q->where('kelas_id', $kelasId);
        });
    }

    // Pencarian
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('username', 'like', "%{$search}%");
        });
    }

    $siswa = $query->latest()->paginate(10);

    return view('siswa.list', compact('siswa', 'search'));
}

/**
 * ➕ Form Tambah Siswa
 */
public function create()
{
    $kelas = Kelas::with(['jurusan'])->get();

    return view('siswa.create', compact('kelas'));
}

/**
 * 💾 Simpan Data Siswa Baru
 */
public function store(Request $request)
{
    $request->validate([
        'name'          => 'required|string|max:255',
        'username'      => 'required|numeric|unique:users,username',
        'email'         => 'nullable|email|unique:users,email',
        'password'      => 'required|string|min:6',
        'kelas_id'      => 'required|exists:kelas,id',
        'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'username' => $request->username,
        'email'    => $request->email,
         'password' => $request->password,
    ]);

    $user->assignRole('siswa');

    Siswa::create([
        'user_id'       => $user->id,
        'kelas_id'      => $request->kelas_id,
        'jenis_kelamin' => $request->jenis_kelamin,
    ]);

    return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
}


    /**
     * ✏️ Form Edit Siswa
     */
    public function edit($id)
    {
        $user = User::with(['siswa.kelas.jurusan'])->findOrFail($id);
        $kelas = Kelas::with(['jurusan'])->get();

        return view('siswa.edit', compact('user', 'kelas'));
    }

    /**
     * 💾 Update data siswa
     */
   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name'          => 'required|string|max:255',
        'username'      => 'required|numeric|unique:users,username,' . $user->id,
        'email'         => 'nullable|email|unique:users,email,' . $user->id,
        'kelas_id'      => 'required|exists:kelas,id',
        'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
    ]);

    $user->update([
        'name'     => $request->name,
        'username' => $request->username,
        'email'    => $request->email,
    ]);

    Siswa::updateOrCreate(
        ['user_id' => $user->id],
        [
            'kelas_id'      => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]
    );

    return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
}
public function export()
{
    return Excel::download(new SiswaExport, 'data_siswa.xlsx');
}
public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    $importer = new SiswaImport();
    Excel::import($importer, $request->file('file'));

    $msg = "Import selesai. Berhasil: {$importer->imported}. Gagal (format/kelas tidak ditemukan): {$importer->failed}. Duplikat: ".count($importer->duplicates).".";

    // you can also pass details of duplicates in session if you want
    return redirect()->back()->with('success', $msg)->with('duplicates', $importer->duplicates);
}
    /**
     * 🗑️ Hapus siswa
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('siswa')) {
            $user->delete();
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
        }

        return redirect()->route('siswa.index')->with('error', 'Hanya data siswa yang dapat dihapus.');
    }
}
