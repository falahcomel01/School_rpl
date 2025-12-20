<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\Kelas;
use App\Models\UjianSiswa;
use App\Models\UjianSoal;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::with(['kelas', 'guru.user', 'guru.mapel'])->latest()->get();

        foreach ($ujians as $ujian) {
            $ujian->status_real = $this->hitungStatusReal($ujian);
        }

        return view('ujian.index', compact('ujians'));
    }

    public function create()
    {
        $guru = auth()->user()->guru;

        if (!$guru) {
            return redirect()->route('ujian.index')
                ->with('error', 'Hanya guru yang dapat membuat ujian.');
        }

        $kelas = Kelas::whereHas('jadwals', function($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();

        $mapel = $guru->mapel;

        return view('ujian.create', compact('kelas', 'mapel'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->guru) {
            return redirect()->route('ujian.index')
                ->with('error', 'Hanya guru yang dapat membuat ujian.');
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_ujian' => 'required|string|max:100',
            'tipe_paket' => 'required|in:1_paket,random',
            'jumlah_paket' => 'required_if:tipe_paket,random|nullable|integer|min:2|max:26',
            'jumlah_soal' => 'required|integer|min:1',
            'durasi_menit' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $validated['guru_id'] = auth()->user()->guru->id;

        if ($validated['tipe_paket'] === '1_paket') {
            $validated['jumlah_paket'] = 1;
        }

        $tanggalMulai = \Carbon\Carbon::parse($validated['tanggal_mulai']);
        $now = now();

        $validated['status'] = $tanggalMulai->lte($now) ? 'aktif' : 'draft';

        Ujian::create($validated);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dibuat!');
    }

    public function edit(Ujian $ujian)
    {
        $guru = auth()->user()->guru;

        if (!$guru) {
            return redirect()->route('ujian.index')
                ->with('error', 'Hanya guru yang dapat mengedit ujian.');
        }

        $kelas = Kelas::whereHas('jadwals', function($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();

        $mapel = $guru->mapel;

        return view('ujian.edit', compact('ujian', 'kelas', 'mapel'));
    }

    public function update(Request $request, Ujian $ujian)
    {
        if (!auth()->user()->guru) {
            return redirect()->route('ujian.index')
                ->with('error', 'Hanya guru yang dapat mengupdate ujian.');
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_ujian' => 'required|string|max:100',
            'tipe_paket' => 'required|in:1_paket,random',
            'jumlah_paket' => 'required_if:tipe_paket,random|nullable|integer|min:2|max:26',
            'jumlah_soal' => 'required|integer|min:1',
            'durasi_menit' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:draft,aktif,nonaktif'
        ]);

        $validated['guru_id'] = auth()->user()->guru->id;

        if ($validated['tipe_paket'] === '1_paket') {
            $validated['jumlah_paket'] = 1;
        }

        $ujian->update($validated);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil diupdate!');
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dihapus!');
    }

    /**
     * ------------------------------
     *         ATUR SOAL
     * ------------------------------
     */
public function aturSoal(Ujian $ujian)
{
    $jenisUjians = \App\Models\JenisUjian::with('soals')->get();

    $jenisDipilih = UjianSoal::where('ujian_id', $ujian->id)
        ->join('soals', 'ujian_soals.soal_id', '=', 'soals.id')
        ->pluck('soals.jenis_ujian_id')
        ->unique()
        ->toArray();

    return view('ujian.atur-soal', compact(
        'ujian',
        'jenisUjians',
        'jenisDipilih'
    ));
}



    /**
     * ------------------------------
     *      SIMPAN ATUR SOAL
     * ------------------------------
     */
    public function storeSoal(Request $request, Ujian $ujian)
    {
        UjianSoal::where('ujian_id', $ujian->id)->delete();

        // Ambil semua soal berdasarkan jenis_ujian_id
        $soalIds = \App\Models\Soal::whereIn('jenis_ujian_id', $request->jenis_ujian)->pluck('id');

        $dataToInsert = [];
        foreach ($soalIds as $soalId) {
            $dataToInsert[] = [
                'ujian_id' => $ujian->id,
                'soal_id' => $soalId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($dataToInsert)) {
            UjianSoal::insert($dataToInsert);
        }

        return redirect()->route('ujian.index')->with('success', 'Pemilihan soal berhasil disimpan!');
    }


    private function hitungStatusReal($ujian)
    {
        if ($ujian->status === 'nonaktif') {
            return 'nonaktif';
        }

        $now = now();
        $mulai = \Carbon\Carbon::parse($ujian->tanggal_mulai);
        $selesai = \Carbon\Carbon::parse($ujian->tanggal_selesai);

        if ($now->lt($mulai)) {
            return 'menunggu';
        }

        if ($now->gt($selesai)) {
            return 'selesai';
        }

        return 'aktif';
    }
}
