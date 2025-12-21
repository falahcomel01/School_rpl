<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\Kelas;
use App\Models\UjianSoal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UjianController extends Controller
{
    /**
     * ======================
     *   LIST UJIAN
     * ======================
     */
    public function index()
    {
        $user = auth()->user();

        $query = Ujian::with(['kelas', 'guru.user', 'guru.mapel']);

        // 🔒 Guru hanya lihat ujian miliknya
        if ($user->guru) {
            $query->where('guru_id', $user->guru->id);
        }

        $ujians = $query->latest()->get();

        foreach ($ujians as $ujian) {
            $ujian->status_real = $this->hitungStatusReal($ujian);
        }

        return view('ujian.index', compact('ujians'));
    }

    /**
     * ======================
     *   FORM TAMBAH
     * ======================
     */
    public function create()
    {
        $guru = auth()->user()->guru;

        if (!$guru) {
            abort(403, 'Hanya guru yang dapat membuat ujian');
        }

        $kelas = Kelas::whereHas('jadwals', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->get();

        $mapel = $guru->mapel;

        return view('ujian.create', compact('kelas', 'mapel'));
    }

    /**
     * ======================
     *   SIMPAN
     * ======================
     */
    public function store(Request $request)
    {
        $guru = auth()->user()->guru;
        if (!$guru) {
            abort(403);
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

        if ($validated['tipe_paket'] === '1_paket') {
            $validated['jumlah_paket'] = 1;
        }

        $validated['guru_id'] = $guru->id;

        $validated['status'] =
            Carbon::parse($validated['tanggal_mulai'])->lte(now())
                ? 'aktif'
                : 'draft';

        Ujian::create($validated);

        return redirect()->route('ujian.index')
            ->with('success', 'Ujian berhasil dibuat');
    }

    /**
     * ======================
     *   EDIT
     * ======================
     */
    public function edit(Ujian $ujian)
    {
        $this->authorizeGuru($ujian);

        $guru = auth()->user()->guru;

        $kelas = Kelas::whereHas('jadwals', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->get();

        $mapel = $guru->mapel;

        return view('ujian.edit', compact('ujian', 'kelas', 'mapel'));
    }

    /**
     * ======================
     *   UPDATE
     * ======================
     */
    public function update(Request $request, Ujian $ujian)
    {
        $this->authorizeGuru($ujian);

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_ujian' => 'required|string|max:100',
            'tipe_paket' => 'required|in:1_paket,random',
            'jumlah_paket' => 'required_if:tipe_paket,random|nullable|integer|min:2|max:26',
            'jumlah_soal' => 'required|integer|min:1',
            'durasi_menit' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:draft,aktif,nonaktif',
        ]);

        if ($validated['tipe_paket'] === '1_paket') {
            $validated['jumlah_paket'] = 1;
        }

        $validated['guru_id'] = auth()->user()->guru->id;

        $ujian->update($validated);

        return redirect()->route('ujian.index')
            ->with('success', 'Ujian berhasil diperbarui');
    }

    /**
     * ======================
     *   HAPUS
     * ======================
     */
    public function destroy(Ujian $ujian)
    {
        $this->authorizeGuru($ujian);

        $ujian->delete();

        return redirect()->route('ujian.index')
            ->with('success', 'Ujian berhasil dihapus');
    }

    /**
     * ======================
     *   ATUR SOAL
     * ======================
     */
    public function aturSoal(Ujian $ujian)
    {
        $this->authorizeGuru($ujian);

        $jenisUjians = \App\Models\JenisUjian::with('soals')
            ->where('guru_id', auth()->user()->guru->id)
            ->get();

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
     * ======================
     *   SIMPAN SOAL
     * ======================
     */
    public function storeSoal(Request $request, Ujian $ujian)
    {
        $this->authorizeGuru($ujian);

        UjianSoal::where('ujian_id', $ujian->id)->delete();

        $soalIds = \App\Models\Soal::whereIn(
            'jenis_ujian_id',
            $request->jenis_ujian ?? []
        )->pluck('id');

        $data = [];
        foreach ($soalIds as $soalId) {
            $data[] = [
                'ujian_id' => $ujian->id,
                'soal_id' => $soalId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if ($data) {
            UjianSoal::insert($data);
        }

        return redirect()->route('ujian.index')
            ->with('success', 'Soal berhasil diatur');
    }

    /**
     * ======================
     *   HELPER KEAMANAN
     * ======================
     */
    private function authorizeGuru(Ujian $ujian)
    {
        $guru = auth()->user()->guru;

        if ($guru && $ujian->guru_id !== $guru->id) {
            abort(403, 'Anda tidak berhak mengakses ujian ini');
        }
    }

    /**
     * ======================
     *   STATUS REAL
     * ======================
     */
    private function hitungStatusReal($ujian)
    {
        if ($ujian->status === 'nonaktif') {
            return 'nonaktif';
        }

        $now = now();
        $mulai = Carbon::parse($ujian->tanggal_mulai);
        $selesai = Carbon::parse($ujian->tanggal_selesai);

        if ($now->lt($mulai)) {
            return 'menunggu';
        }

        if ($now->gt($selesai)) {
            return 'selesai';
        }

        return 'aktif';
    }
}
