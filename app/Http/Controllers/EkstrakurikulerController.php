<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Pembina;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EkstrakurikulerController extends Controller
{
 public function index()
{
    $user = auth()->user();

    $query = Ekstrakurikuler::with('pembina.user')
        ->withCount('peserta');

    // 🔒 JIKA PEMBINA → HANYA LIHAT EKSTRA SENDIRI
    if ($user->hasRole('pembina')) {

        if (!$user->pembina) {
            abort(403, 'Data pembina tidak ditemukan');
        }

        $query->where('pembina_id', $user->pembina->id);
    }

    // ADMIN → otomatis lihat semua
    $ekstrakurikulers = $query->paginate(10);

    return view('ekstrakurikulers.index', compact('ekstrakurikulers'));
}


    public function create()
    {
        $pembinas = Pembina::with('user')->get();
        return view('ekstrakurikulers.create', compact('pembinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_extra' => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'tempat'     => 'required|string|max:255',
            'kuota'      => 'required|integer|min:1',
            'pembina_id' => 'required|exists:pembinas,id',

            'hari'       => 'required|string',
            'jam_mulai'  => 'required',
            'jam_selesai'=> 'required',

            'pendaftaran_mulai'   => 'required|date',
            'pendaftaran_selesai' => 'required|date|after:pendaftaran_mulai',
        ]);

        $jadwal = "{$request->hari}, {$request->jam_mulai} - {$request->jam_selesai}";

        Ekstrakurikuler::create([
            'nama_extra' => $request->nama_extra,
            'deskripsi'  => $request->deskripsi,
            'tempat'     => $request->tempat,
            'kuota'      => $request->kuota,
            'pembina_id' => $request->pembina_id,
            'jadwal'     => $jadwal,
            'pendaftaran_mulai'   => $request->pendaftaran_mulai,
            'pendaftaran_selesai' => $request->pendaftaran_selesai,
        ]);

        return redirect()->route('ekstrakurikulers.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

     public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        $pembinas = Pembina::with('user')->get();
        $ekstrakurikuler->loadCount('peserta'); // Load jumlah peserta
        
        return view('ekstrakurikulers.edit', compact('ekstrakurikuler', 'pembinas'));
    }

    /**
     * UPDATE EKSTRAKURIKULER
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama_extra' => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'tempat'     => 'required|string|max:255',
            'kuota'      => 'required|integer|min:1',
            'pembina_id' => 'required|exists:pembinas,id',

            'hari'       => 'required|string',
            'jam_mulai'  => 'required',
            'jam_selesai'=> 'required',

            'pendaftaran_mulai'   => 'required|date',
            'pendaftaran_selesai' => 'required|date|after:pendaftaran_mulai',
        ]);

        // Format jadwal dari input terpisah
        $jadwal = "{$request->hari}, {$request->jam_mulai} - {$request->jam_selesai}";

        $ekstrakurikuler->update([
            'nama_extra' => $request->nama_extra,
            'deskripsi'  => $request->deskripsi,
            'tempat'     => $request->tempat,
            'kuota'      => $request->kuota,
            'pembina_id' => $request->pembina_id,
            'jadwal'     => $jadwal,
            'pendaftaran_mulai'   => $request->pendaftaran_mulai,
            'pendaftaran_selesai' => $request->pendaftaran_selesai,
        ]);

        return redirect()->route('ekstrakurikulers.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }
    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->loadCount('peserta');

        $siswa = auth()->user()->siswa ?? null;

        $sudahDaftar = $siswa
            ? $ekstrakurikuler->peserta()->where('siswa_id', $siswa->id)->exists()
            : false;

        $hariIni = Carbon::today();

        $pendaftaranBuka =
            $hariIni->between(
                $ekstrakurikuler->pendaftaran_mulai,
                $ekstrakurikuler->pendaftaran_selesai
            );

        $kuotaPenuh = $ekstrakurikuler->peserta_count >= $ekstrakurikuler->kuota;

        return view('ekstrakurikulers.show', compact(
            'ekstrakurikuler',
            'sudahDaftar',
            'pendaftaranBuka',
            'kuotaPenuh'
        ));
    }
    /* ================= SISWA ================= */

    public function indexSiswa()
    {
        $hariIni = Carbon::today();

        $ekstrakurikulers = Ekstrakurikuler::withCount('peserta')
            ->whereDate('pendaftaran_mulai', '<=', $hariIni)
            ->whereDate('pendaftaran_selesai', '>=', $hariIni)
            ->get();

        return view('ekstrakurikulers.index_siswa', compact('ekstrakurikulers'));
    }

public function peserta(Ekstrakurikuler $ekstrakurikuler)
{
    $ekstrakurikuler->load(['peserta.user', 'peserta.kelas']);

    return view(
        'ekstrakurikulers.peserta',
        compact('ekstrakurikuler')
    );
}
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikulers.index')
                         ->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
