<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use App\Models\Presensi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PerizinanController extends Controller
{
    /**
     * 
     */
   public function index()
{
    $user = Auth::user();

    // SUPERADMIN + TU → lihat semua
    if ($user->hasAnyRole(['superadmin', 'tus'])) {
        $perizinans = Perizinan::with('user')->orderBy('id', 'desc')->get();
        return view('perizinan.index', compact('perizinans'));
    }

    // WALIKELAS → lihat semua siswa di kelasnya
    if ($user->hasRole('walikelas')) {
        $kelasId = $user->walikelas->kelas_id; // asumsi relasi walikelas -> kelas

        $perizinans = Perizinan::with('user')
            ->whereHas('user.siswa', function ($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('perizinan.index', compact('perizinans'));
    }

    // KEPSEK → lihat semua guru
    if ($user->hasRole('kepsek')) {
        $perizinans = Perizinan::with('user')
            ->whereHas('user.roles', fn($q) => $q->where('name', 'guru'))
            ->orderBy('id', 'desc')
            ->get();

        return view('perizinan.index', compact('perizinans'));
    }

    // SISWA / GURU → hanya lihat punya sendiri
    $perizinans = Perizinan::with('user')
        ->where('user_id', $user->id)
        ->orderBy('id', 'desc')
        ->get();

    return view('perizinan.index', compact('perizinans'));
}


    /**
     * 
     */
    public function create()
    {
        return view('perizinan.create');
    }

    /**
     * 
     */
   public function store(Request $request)
{
    $request->validate([
        'tanggal_mulai'   => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'status'          => 'required|in:izin,sakit',
        'file_surat'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('file_surat')) {
        $file = $request->file('file_surat');
        $filename = Auth::id() . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('surat_izin', $filename, 'public');
    }

    Perizinan::create([
        'user_id'         => Auth::id(),
        'tanggal_mulai'   => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'status'          => $request->status,
        'file_surat'      => $path,
        'validasi'        => 'pending',
    ]);

    return redirect()
        ->route('perizinan.index')
        ->with('success', 'Izin berhasil diajukan.');
}

public function validasi(Request $request, $id)
{
    $izin = Perizinan::findOrFail($id);
    $izin->validasi = $request->validasi;
    $izin->save();

    // Jika disetujui → buat presensi otomatis
    if ($request->validasi === 'disetujui') {
        $this->buatPresensiDariIzin($izin);
    }

    return back()->with('success', 'Perizinan berhasil divalidasi.');
}

private function buatPresensiDariIzin($izin)
{
    $periode = \Carbon\CarbonPeriod::create($izin->tanggal_mulai, $izin->tanggal_selesai);

    foreach ($periode as $tanggal) {

        $sudahAda = Presensi::where('user_id', $izin->user_id)
            ->whereDate('tanggal', $tanggal->format('Y-m-d'))
            ->exists();

        if (!$sudahAda) {
            Presensi::create([
                'user_id'   => $izin->user_id,
                'tanggal'   => $tanggal->format('Y-m-d'),
                'status'    => $izin->status,
                'keterangan'=> 'Dibuat otomatis dari perizinan',
            ]);
        }
    }
}


    /**
     * 
     */
    public function lihatFile($id)
    {
        $izin = Perizinan::findOrFail($id);

        // Cek apakah ada file
        if (!$izin->file_surat || !Storage::disk('public')->exists($izin->file_surat)) {
            abort(404, 'File tidak ditemukan');
        }

        $path = Storage::disk('public')->path($izin->file_surat);
        $mimeType = Storage::disk('public')->mimeType($izin->file_surat);

        return response()->file($path, [
            'Content-Type' => $mimeType,
        ]);
    }

    /**
     * 
     */
    public function destroy($id)
    {
        $izin = Perizinan::findOrFail($id);

        if ($izin->user_id !== Auth::id() && !Auth::user()->hasAnyRole(['tus', 'superadmin'])) {
            abort(403, 'Kamu tidak punya izin untuk menghapus data ini.');
        }

        // 🧹 Hapus file jika ada
        if ($izin->file_surat && Storage::disk('public')->exists($izin->file_surat)) {
            Storage::disk('public')->delete($izin->file_surat);
        }
       
        $izin->delete();

        return redirect()
            ->route('perizinan.index')
            ->with('success', 'Data perizinan berhasil dihapus.');
    }
}