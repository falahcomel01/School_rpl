<?php

namespace App\Http\Controllers;

use App\Models\JenisUjian;
use App\Models\OpsiJawaban;
use App\Models\Soal;
use App\Models\opsi_jawaban;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    // =========================
    // 1. INDEX JENIS UJIAN
    // =========================
    public function index()
    {
        $user = auth()->user();

        // Superadmin / TU → lihat semua Jenis Ujian
        if ($user->hasRole(['superadmin', 'tu'])) {
            $jenisUjians = JenisUjian::with(['guru.user', 'guru.mapel', 'soals'])->get();
        }
        // Guru → lihat jenis ujian miliknya
        else {
            $guru = $user->guru;

            if (!$guru) {
                abort(403, "Akses ditolak. Anda bukan guru.");
            }

            $jenisUjians = JenisUjian::with(['guru.user', 'guru.mapel', 'soals'])
                        ->where('guru_id', $guru->id)
                        ->get();
        }

        return view('soal.index', compact('jenisUjians'));
    }

    // =========================
    // 2. DETAIL JENIS UJIAN
    // =========================
    public function detail(JenisUjian $jenisUjian)
    {
        $jenisUjian->load(['guru.user', 'guru.mapel', 'soals.opsiJawaban']);

        return view('soal.detail', compact('jenisUjian'));
    }


    // =========================
    // 3. FORM CREATE SOAL
    // =========================
    public function create(JenisUjian $jenisUjian)
    {
        return view('soal.create', compact('jenisUjian'));
    }


    // =========================
    // 4. STORE SOAL
    // =========================
   public function store(Request $request, JenisUjian $jenisUjian)
{
    $request->validate([
        'soal_text' => 'required',
        'tipe_soal' => 'required',
        'opsi' => 'required_if:tipe_soal,pg|array|min:4',
        'jawaban_benar' => 'required_if:tipe_soal,pg',
    ]);

    // --- CEK DUPLIKAT SOAL TEXT DALAM JENIS UJIAN ---
    $duplicateSoal = Soal::where('jenis_ujian_id', $jenisUjian->id)
        ->where('soal_text', trim($request->soal_text))
        ->exists();

    if ($duplicateSoal) {
        return back()->withErrors(['soal_text' => 'Soal ini sudah ada dalam Jenis Ujian yang sama!'])
                     ->withInput();
    }

    // --- CEK DUPLIKAT OPSI ---
    if ($request->tipe_soal === 'pg') {
        $opsi = array_map('trim', $request->opsi);
        $unique = array_unique($opsi);

        if (count($unique) < count($opsi)) {
            return back()->withErrors(['opsi' => 'Opsi jawaban tidak boleh duplikat!'])
                         ->withInput();
        }
    }

    $soal = Soal::create([
        'jenis_ujian_id' => $jenisUjian->id,
        'soal_text' => $request->soal_text,
        'tipe_soal' => $request->tipe_soal,
    ]);

    if ($request->tipe_soal === 'pg') {
        $opsi = array_values($request->opsi);

        foreach ($opsi as $i => $opsiText) {
            if (!$opsiText) continue;

            OpsiJawaban::create([
                'soal_id' => $soal->id,
                'opsi_text' => $opsiText,
                'urutan' => chr(65 + $i),
                'is_benar' => ($request->jawaban_benar == $i),
            ]);
        }
    }

    return redirect()
        ->route('soal.detail', $jenisUjian->id)
        ->with('success', 'Soal berhasil ditambahkan!');
}


    // =========================
    // 5. FORM EDIT SOAL
    // =========================
    public function edit($id)
    {
        $soal = Soal::with('opsiJawaban')->findOrFail($id);
        return view('soal.edit', compact('soal'));
    }


    // =========================
    // 6. UPDATE SOAL
    // =========================
 public function update(Request $request, $id)
{
    $request->validate([
        'soal_text' => 'required|string',
        'tipe_soal' => 'required|in:pg,essay',
        'opsi' => 'required_if:tipe_soal,pg|array|min:4',
        'jawaban_benar' => 'required_if:tipe_soal,pg|integer|between:0,3',
    ]);

    $soal = Soal::with('opsiJawaban')->findOrFail($id);

    // --- CEK DUPLIKAT SOAL DALAM JENIS UJIAN (KECUALI DIRINYA SENDIRI) ---
    $duplicateSoal = Soal::where('jenis_ujian_id', $soal->jenis_ujian_id)
        ->where('id', '!=', $soal->id)
        ->where('soal_text', trim($request->soal_text))
        ->exists();

    if ($duplicateSoal) {
        return back()->withErrors(['soal_text' => 'Soal ini sudah ada dalam Jenis Ujian yang sama!'])
                     ->withInput();
    }

    // --- CEK DUPLIKAT OPSI ---
    if ($request->tipe_soal === 'pg') {
        $opsi = array_map('trim', $request->opsi);
        $unique = array_unique($opsi);

        if (count($unique) < count($opsi)) {
            return back()->withErrors(['opsi' => 'Opsi jawaban tidak boleh duplikat!'])
                         ->withInput();
        }
    }

    // UPDATE DATA SOAL
    $soal->update([
        'soal_text' => $request->soal_text,
        'tipe_soal' => $request->tipe_soal,
    ]);

    // UPDATE OPSI UNTUK PG
    if ($request->tipe_soal === 'pg') {
        $soal->opsiJawaban()->delete();

        $opsi = array_values($request->opsi);

        foreach ($opsi as $i => $opsiText) {
            if (trim($opsiText) === '') continue;

            OpsiJawaban::create([
                'soal_id' => $soal->id,
                'opsi_text' => $opsiText,
                'urutan' => chr(65 + $i),
                'is_benar' => ($request->jawaban_benar == $i),
            ]);
        }
    } 
    else {
        // Jika berubah dari PG → Essay → hapus opsi lama
        $soal->opsiJawaban()->delete();
    }

    return redirect()
        ->route('soal.detail', $soal->jenis_ujian_id)
        ->with('success', 'Soal berhasil diperbarui!');
}

    // =========================
    // 7. HAPUS SOAL
    // =========================
    public function destroy($id)
{
    $soal = Soal::with('ujianSoals')->findOrFail($id);

    // Hapus dulu semua relasi di ujian_soals
    $soal->ujianSoals()->delete();

    // Baru hapus soal
    $soal->delete();

    return back()->with('success', 'Soal berhasil dihapus!');
}
}