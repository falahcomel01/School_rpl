<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\ujian_soal;
use App\Models\UjianSoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UjianSoalController extends Controller
{
    // Tampilkan soal yg sudah dimasukkan ke ujian
    public function index(Ujian $ujian)
    {
        $ujian->load('ujianSoals.soal.opsiJawaban');
        return view('ujian.soals.index', compact('ujian'));
    }

    // Form untuk menambahkan soal (menampilkan pool soal)
    public function add(Ujian $ujian)
    {
        // Tampilkan soal dari bab/kelas sesuai kebijakan — contoh: semua soal
        $soals = Soal::with('opsiJawaban')->get();
        return view('ujian.soals.add', compact('ujian','soals'));
    }

    // Store selected soal OR generate random jika tipe paket = random
    public function store(Request $request, Ujian $ujian)
    {
        $request->validate([
            'soal_ids' => 'nullable|array',
            'soal_ids.*' => 'exists:soals,id'
        ]);

        DB::transaction(function() use($request,$ujian) {
            // jika paket random → generate random sesuai jumlah_soal
            if ($ujian->tipe_paket === 'random') {
                // ambil soal pool (bisa disesuaikan: kelas, mapel, bab, dsb)
                $pool = Soal::inRandomOrder()->limit($ujian->jumlah_soal)->pluck('id')->toArray();
                // hapus existing
                $ujian->ujianSoals()->delete();
                foreach ($pool as $sid) {
                    UjianSoal::create(['ujian_id'=>$ujian->id, 'soal_id'=>$sid]);
                }
            } else {
                // fixed: gunakan soal_ids yang dipilih
                if (!empty($request->soal_ids)) {
                    // hindari duplikat
                    $ids = array_unique($request->soal_ids);
                    foreach ($ids as $sid) {
                        // buat jika belum ada
                        UjianSoal::firstOrCreate([
                            'ujian_id' => $ujian->id,
                            'soal_id' => $sid
                        ]);
                    }
                }
            }
        });

        return redirect()->route('ujian.soals.index', $ujian->id)->with('success','Soal ujian diperbarui.');
    }
    
    public function destroy(Ujian $ujian, UjianSoal $ujianSoal)
    {
        $ujianSoal->delete();
        return back()->with('success','Soal dihapus dari ujian.');
    }
}
