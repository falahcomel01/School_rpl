<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CEK DATA UNTUK TIMER ===\n\n";

// Cek ujian siswa terakhir
$ujianSiswa = \App\Models\UjianSiswa::with('ujian')->orderBy('id', 'desc')->first();

if (!$ujianSiswa) {
    echo "Tidak ada ujian siswa\n";
    exit;
}

echo "Ujian Siswa ID: {$ujianSiswa->id}\n";
echo "Status: {$ujianSiswa->status}\n";
echo "waktu_mulai: " . ($ujianSiswa->waktu_mulai ?? 'NULL') . "\n";
echo "waktu_selesai: " . ($ujianSiswa->waktu_selesai ?? 'NULL') . "\n\n";

echo "=== DATA UJIAN ===\n";
echo "Ujian ID: {$ujianSiswa->ujian->id}\n";
echo "Jenis Ujian: {$ujianSiswa->ujian->jenis_ujian}\n";
echo "durasi_menit: " . ($ujianSiswa->ujian->durasi_menit ?? 'NULL') . "\n\n";

if ($ujianSiswa->waktu_mulai && $ujianSiswa->ujian->durasi_menit) {
    $waktuMulai = $ujianSiswa->waktu_mulai;
    $durasiMenit = $ujianSiswa->ujian->durasi_menit;
    $waktuSelesai = $waktuMulai->copy()->addMinutes($durasiMenit);
    
    echo "=== PERHITUNGAN TIMER ===\n";
    echo "Waktu Mulai: {$waktuMulai}\n";
    echo "Durasi: {$durasiMenit} menit\n";
    echo "Waktu Selesai: {$waktuSelesai}\n";
    echo "Waktu Sekarang: " . now() . "\n";
    
    $sisaDetik = now()->diffInSeconds($waktuSelesai, false);
    $sisaMenit = floor($sisaDetik / 60);
    $detik = $sisaDetik % 60;
    
    echo "Sisa Waktu: {$sisaMenit} menit {$detik} detik\n";
    
    if ($sisaDetik <= 0) {
        echo "⚠️ WAKTU SUDAH HABIS!\n";
    }
} else {
    echo "❌ TIMER TIDAK BISA DITAMPILKAN:\n";
    if (!$ujianSiswa->waktu_mulai) {
        echo "  - waktu_mulai: NULL\n";
    }
    if (!$ujianSiswa->ujian->durasi_menit) {
        echo "  - durasi_menit: NULL\n";
    }
}
