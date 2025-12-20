<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugaspengumpulanController;
use App\Http\Controllers\WalikelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UjianSoalController;
use App\Http\Controllers\UjianSiswaController;
use App\Http\Controllers\JawabanSiswaController;
use App\Http\Controllers\JenisUjianController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\CatatanPerkembanganController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\ExtraPesertaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PresensiEkstraController;
use App\Http\Controllers\AturanKelulusanController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\RekomendasiJurusanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

 Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'active.role'])
    ->name('dashboard');

Route::post('/set-role', function (Request $request) {

    abort_unless(
        auth()->user()->hasRole($request->role),
        403
    );

    session([
        'active_role' => $request->role,
        'need_choose_role' => false,
    ]);

    return back();

})->name('set-role');
  Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


    // --- LANDING SETTING ---
    // --- USER MANAGEMENT ---
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UsersController::class);
  Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
Route::get('/siswa/export', [SiswaController::class, 'export'])->name('siswa.export');

Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('orangtua', OrangtuaController::class);

    // --- MASTER DATA ---
    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('walikelas', WalikelasController::class)->parameters(['walikelas' => 'walikelas']);

    // --- JADWAL ---
    Route::get('/jadwal/get-mapel-kelas/{id}', [JadwalController::class, 'getMapelkelas'])
        ->name('getMapelkelas');
    Route::get('/jadwal/get-guru-by-mapel/{mapel_id}', [JadwalController::class, 'getGuruByMapel'])
        ->name('getGuruByMapel');
    Route::resource('jadwal', JadwalController::class);

    // --- PRESENSI ---
    Route::get('/presensi/{jadwal}/detail', [PresensiController::class, 'detail'])->name('presensi.detail');
    Route::get('/presensi/{jadwal_id}/show', [PresensiController::class, 'show'])->name('presensi.show');
    Route::get('/presensi/{jadwal_id}/edit', [PresensiController::class, 'edit'])->name('presensi.edit');
    Route::put('/presensi/{jadwal_id}', [PresensiController::class, 'update'])->name('presensi.update');
// REKAP PRESENSI
Route::get('/presensi/rekap', [PresensiController::class, 'rekap'])
    ->name('presensi.rekap')
    ->middleware('role:superadmin|tus|guru|siswa|orangtua');

    Route::resource('presensi', PresensiController::class);

    // --- PERIZINAN ---
    Route::resource('perizinan', PerizinanController::class)
        ->only(['index', 'create', 'store', 'destroy']);
    Route::post('/perizinan/{id}/validasi', [PerizinanController::class, 'validasi'])
        ->name('perizinan.validasi');
    Route::get('/perizinan/{id}/file', [PerizinanController::class, 'lihatFile'])
        ->name('perizinan.file');


    // ==================== TUGAS ====================
    Route::get('/tugas/mapel/{mapel}', [TugasController::class, 'byMapel'])
        ->name('tugas.by.mapel');
    Route::get('/tugas/{tugas}/download', [TugasController::class, 'downloadFile'])
        ->name('tugas.download');
    Route::get('/tugas/{tugas}/pengumpulan', [TugasController::class, 'pengumpulan'])
        ->name('tugas.pengumpulan');
    Route::resource('tugas', TugasController::class)->parameters(['tugas' => 'tugas']);

    // --- PENGUMPULAN TUGAS SISWA ---
    Route::get('/tugas/{tugas}/create-pengumpulan', [TugaspengumpulanController::class, 'create'])
        ->name('pengumpulan.create.tugas');
    Route::post('/tugas/{tugas}/pengumpulan', [TugaspengumpulanController::class, 'store'])
        ->name('pengumpulan.store.tugas');
    Route::get('/pengumpulan/{pengumpulan}/download', [TugaspengumpulanController::class, 'downloadFile'])
        ->name('pengumpulan.downloadFile');
    Route::put('/pengumpulan/{pengumpulan}/nilai', [TugasPengumpulanController::class, 'updateNilai'])
        ->name('pengumpulan.nilai');
    Route::resource('pengumpulan', TugaspengumpulanController::class)->except(['create', 'store']);

   
    // ==================== SOAL & BAB ====================
Route::resource('jenis-ujian', JenisUjianController::class);

    // Detail soal per jenis ujian
    Route::get('/jenis-ujian/{jenisUjian}/soal', [SoalController::class, 'detail'])
        ->name('soal.detail');
    Route::get('/jenis-ujian/{jenisUjian}/soal/create', [SoalController::class, 'create'])
        ->name('soal.create');
    Route::post('/jenis-ujian/{jenisUjian}/soal', [SoalController::class, 'store'])
        ->name('soal.store');
    
    Route::resource('soal', SoalController::class)
        ->except(['create', 'store', 'show']);
    // ==================== UJIAN (GURU) ====================
    Route::resource('ujian', UjianController::class);
    Route::get('/ujian/{ujian}/atur-soal', [UjianController::class, 'aturSoal'])->name('ujian.atur.soal');
Route::post('/ujian/{ujian}/atur-soal', [UjianController::class, 'storeSoal'])->name('ujian.atur.soal.store');
// --- SELESAI NAMBAH ---
    // Update status ujian (AJAX)
    Route::post('/ujian/{ujian}/status', [UjianController::class, 'updateStatus'])
        ->name('ujian.updateStatus');
    
    // Form pilih BAB
Route::get('/ujian/{ujian}/atur-soal', [UjianController::class, 'aturSoal'])
    ->name('ujian.atur-soal');

// Simpan pilihan BAB
Route::post('/ujian/{ujian}/atur-soal', [UjianController::class, 'storeSoal'])
    ->name('ujian.store-soal');



    // ==================== UJIAN (GURU) ====================
    Route::resource('ujian', UjianController::class);
    Route::get('/ujian/{ujian}/atur-soal', [UjianController::class, 'aturSoal'])->name('ujian.atur.soal');
Route::post('/ujian/{ujian}/atur-soal', [UjianController::class, 'storeSoal'])->name('ujian.atur.soal.store');
// --- SELESAI NAMBAH ---
    // Update status ujian (AJAX)
    Route::post('/ujian/{ujian}/status', [UjianController::class, 'updateStatus'])
        ->name('ujian.updateStatus');
    
    // Form pilih BAB
Route::get('/ujian/{ujian}/atur-soal', [UjianController::class, 'aturSoal'])
    ->name('ujian.atur-soal');

// Simpan pilihan BAB
Route::post('/ujian/{ujian}/atur-soal', [UjianController::class, 'storeSoal'])
    ->name('ujian.store-soal');


    // ==================== UJIAN SISWA ====================
    // Daftar ujian untuk siswa
    Route::get('/ujian-siswa', [UjianSiswaController::class, 'index'])
        ->name('ujian_siswa.index');
    
    // Mulai ujian (POST)
    Route::post('/ujian-siswa/{ujian}/mulai', [UjianSiswaController::class, 'mulai'])
        ->name('ujian_siswa.mulai');
    
    // Kerjakan ujian
    Route::get('/ujian-siswa/{ujian_siswa}/kerjakan', [UjianSiswaController::class, 'kerjakan'])
        ->name('ujian_siswa.kerjakan');
    
    // Simpan jawaban (AJAX)
    Route::post('/ujian-siswa/{ujian_siswa}/jawaban', [UjianSiswaController::class, 'simpanJawaban'])
        ->name('ujian_siswa.simpan');
    
    // AJAX untuk update jawaban (PG / Essay / Benar-Salah)
    Route::post('/ujian_siswa/{ujianSiswa}/jawaban/{jawabanSiswa}', [UjianSiswaController::class, 'updateJawaban'])
        ->name('ujian_siswa.update_jawaban');

    // Selesai ujian
    Route::post('/ujian-siswa/{ujian_siswa}/selesai', [UjianSiswaController::class, 'selesai'])
        ->name('ujian_siswa.selesai');
    
    // Lihat hasil ujian (untuk siswa)
    Route::get('/ujian-siswa/{ujian_siswa}/hasil', [UjianSiswaController::class, 'hasil'])
        ->name('ujian_siswa.hasil');

    // UNTUK GURU: Daftar peserta ujian
    Route::get('/ujian/{ujian}/peserta', [UjianSiswaController::class, 'daftarSiswa'])
        ->name('ujian_siswa.daftar_peserta');

    // UNTUK GURU: Detail hasil & penilaian
    Route::get('/ujian-siswa/{ujian_siswa}/penilaian', [UjianSiswaController::class, 'detailHasilSiswa'])
        ->name('ujian_siswa.detail_penilaian');

    // UNTUK GURU: Update nilai (AJAX)
    Route::post('/ujian-siswa/nilai/{jawaban}', [UjianSiswaController::class, 'updateNilai'])
        ->name('ujian_siswa.update_nilai');

    // ==================== REKAP NILAI ====================
    // Untuk Guru: Kelola Pembobotan & Generate Rekap
    Route::get('/rekap-nilai', [\App\Http\Controllers\RekapNilaiController::class, 'index'])
        ->name('rekap_nilai.index');
    Route::get('/rekap-nilai/create', [\App\Http\Controllers\RekapNilaiController::class, 'create'])
        ->name('rekap_nilai.create');
    Route::post('/rekap-nilai', [\App\Http\Controllers\RekapNilaiController::class, 'store'])
        ->name('rekap_nilai.store');
    Route::get('/rekap-nilai/{pembobotan}/edit', [\App\Http\Controllers\RekapNilaiController::class, 'edit'])
        ->name('rekap_nilai.edit');
    Route::put('/rekap-nilai/{pembobotan}', [\App\Http\Controllers\RekapNilaiController::class, 'update'])
        ->name('rekap_nilai.update');
    Route::delete('/rekap-nilai/{pembobotan}', [\App\Http\Controllers\RekapNilaiController::class, 'destroy'])
        ->name('rekap_nilai.destroy');
    
    // Generate/Re-generate rekap
    Route::get('/rekap-nilai/{pembobotan}/generate', [\App\Http\Controllers\RekapNilaiController::class, 'generate'])
        ->name('rekap_nilai.generate');
    
    // Lihat rekap kelas (untuk guru)
    Route::get('/rekap-nilai/{pembobotan}/show', [\App\Http\Controllers\RekapNilaiController::class, 'show'])
        ->name('rekap_nilai.show');
    
    // Untuk Siswa: Lihat rekap nilai sendiri
    Route::get('/rekap-nilai-saya', [\App\Http\Controllers\RekapNilaiController::class, 'rekapSiswa'])
        ->name('rekap_nilai.siswa');

    // ==================== RAPOR (VIRTUAL - DARI REKAP NILAI) ====================
    // Untuk Wali Kelas/Admin: Lihat daftar rapor
    Route::get('/rapor', [RaporController::class, 'index'])
        ->name('rapor.index');

    // Detail rapor per siswa (untuk admin/wali kelas)
    Route::get('/rapor/{siswa_id}/{semester}/{tahun_ajaran}', 
        [RaporController::class, 'show'])
        ->name('rapor.show');

    // Siswa lihat daftar rapor miliknya
    Route::get('/rapor-saya', [RaporController::class, 'raporSiswa'])
        ->name('rapor.siswa');

    // Siswa lihat detail rapor per semester
    Route::get('/rapor-saya/{semester}/{tahun_ajaran}', 
        [RaporController::class, 'detailRaporSiswa'])
        ->name('rapor.detail_siswa');

    // Cetak PDF rapor (untuk admin/wali kelas)
    Route::get('/rapor/{siswa_id}/{semester}/{tahun_ajaran}/cetak', 
        [RaporController::class, 'cetakPdf'])
        ->name('rapor.cetak');

    // Cetak PDF rapor (untuk siswa)
    Route::get('/rapor-saya/{semester}/{tahun_ajaran}/cetak', 
        [RaporController::class, 'cetakPdfSiswa'])
        ->name('rapor.cetak_siswa');

    // ==================== CATATAN PERKEMBANGAN ====================
    Route::resource('catatan_perkembangan', CatatanPerkembanganController::class);
    Route::resource('pembina', PembinaController::class);
    Route::resource('ekstrakurikulers', EkstrakurikulerController::class);

    // 🔥 PENDAFTARAN SISWA
    Route::post(
        'ekstrakurikulers/{ekstrakurikuler}/daftar',
        [ExtraPesertaController::class, 'daftar']
    )->name('ekstrakurikulers.daftar');

    Route::delete(
        'ekstrakurikulers/{ekstrakurikuler}/batal',
        [ExtraPesertaController::class, 'batal']
    )->name('ekstrakurikulers.batal');
    Route::get('/siswa/ekstrakurikuler', [EkstrakurikulerController::class, 'indexSiswa'])
    ->name('siswa.ekstrakurikuler');
    Route::get(
    '/ekstrakurikulers/{ekstrakurikuler}/peserta',
    [EkstrakurikulerController::class, 'peserta']
)->middleware('role:superadmin')
 ->name('ekstrakurikulers.peserta');

  Route::resource('prestasi', PrestasiController::class);
    Route::get('prestasi/{prestasi}/download', [PrestasiController::class, 'downloadBukti'])->name('prestasi.download');
    Route::get('prestasi-statistik', [PrestasiController::class, 'statistik'])->name('prestasi.statistik');


// Ganti semua ini:
Route::get('/presensi_ekstra/{ekstrakurikuler_id}/detail', [PresensiEkstraController::class, 'detail'])
    ->name('presensi_ekstra.detail');

Route::get('/presensi_ekstra/{ekstrakurikuler_id}/edit', [PresensiEkstraController::class, 'edit'])->name('presensi_ekstra.edit');

Route::put('/presensi_ekstra/{ekstrakurikuler_id}/update_presensi', [PresensiEkstraController::class, 'update'])
    ->name('presensi_ekstra.update');

// Resource route
Route::resource('presensi_ekstra', PresensiEkstraController::class, [
    'except' => ['edit', 'update']
])->names([
    'index' => 'presensi_ekstra.index',
    'create' => 'presensi_ekstra.create',
    'store' => 'presensi_ekstra.store',
    'show' => 'presensi_ekstra.show',
]);
Route::resource('aturan-kelulusan', AturanKelulusanController::class);
Route::get('/kelulusan/dashboard/statistik', 
    [KelulusanController::class, 'dashboard']
)->name('kelulusan.dashboard');
Route::resource('kelulusan', KelulusanController::class);
Route::post('/kelulusan/auto-generate', 
    [KelulusanController::class, 'autoGenerate']
)->name('kelulusan.auto-generate');

Route::get('/rekomendasi-jurusan', 
    [RekomendasiJurusanController::class, 'index']
)->name('rekomendasi.index');

Route::post('/rekomendasi-jurusan', 
    [RekomendasiJurusanController::class, 'store']
)->name('rekomendasi.store');

    Route::get('/rekomendasi-jurusan/daftar', 
        [RekomendasiJurusanController::class, 'daftarRekomendasi']
    )->name('rekomendasi.daftar');

    Route::get('/rekomendasi-jurusan/{id}/validasi', 
        [RekomendasiJurusanController::class, 'validasi']
    )->name('rekomendasi.validasi');

    Route::post('/rekomendasi-jurusan/{id}/validasi', 
        [RekomendasiJurusanController::class, 'prosesValidasi']
    )->name('rekomendasi.prosesValidasi');

    Route::delete('/rekomendasi-jurusan/{id}/batal', 
        [RekomendasiJurusanController::class, 'batalRekomendasi']
    )->name('rekomendasi.batal');
    Route::get('/hasil-jurusan', [RekomendasiJurusanController::class, 'hasil'])
    ->name('rekomendasi.hasil');

});
require __DIR__ . '/auth.php';