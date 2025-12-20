# Migrasi Data Nilai Lama

## Masalah
Data ujian lama memiliki nilai PG = 1 (seharusnya 5)

## Solusi Otomatis dengan Logika

Sistem saat ini **sudah menggunakan logika** untuk menghitung nilai dalam skala 100, sehingga:
- Data lama dengan nilai 1 tetap dihitung dengan benar
- Data baru otomatis menggunakan nilai 5

## Cara Kerja

### Data Lama (Nilai PG = 1)
```php
Soal 1 (PG Benar): nilai = 1
Soal 2 (PG Benar): nilai = 1  
Soal 3 (PG Salah): nilai = 0

Nilai Raw = 1 + 1 + 0 = 2
Nilai Maksimal = 3 × 5 = 15
Nilai Total = (2 / 15) × 100 = 13.33
```

### Data Baru (Nilai PG = 5)
```php
Soal 1 (PG Benar): nilai = 5
Soal 2 (PG Benar): nilai = 5
Soal 3 (PG Salah): nilai = 0

Nilai Raw = 5 + 5 + 0 = 10
Nilai Maksimal = 3 × 5 = 15
Nilai Total = (10 / 15) × 100 = 66.67
```

## Update Manual Data Lama (Opsional)

Jika ingin mengupdate semua data lama secara manual:

### Via SQL (Hati-hati!)
```sql
-- Update semua jawaban benar yang masih bernilai 1 menjadi 5
UPDATE jawaban_siswas 
SET nilai = 5 
WHERE is_benar = 1 AND nilai = 1;
```

### Via Tinker (Lebih Aman)
```bash
php artisan tinker
```

```php
// Update jawaban benar dari 1 ke 5
DB::table('jawaban_siswas')
    ->where('is_benar', true)
    ->where('nilai', 1)
    ->update(['nilai' => 5]);

// Cek hasil
DB::table('jawaban_siswas')
    ->where('is_benar', true)
    ->where('nilai', '<', 5)
    ->count(); // Harusnya 0
```

### Via Migration (Paling Aman)
```bash
php artisan make:migration fix_jawaban_nilai_old_data
```

```php
// database/migrations/xxx_fix_jawaban_nilai_old_data.php
public function up(): void
{
    // Update jawaban PG yang benar dari nilai 1 ke 5
    DB::table('jawaban_siswas')
        ->where('is_benar', true)
        ->where('nilai', 1)
        ->update(['nilai' => 5]);
}

public function down(): void
{
    // Rollback: kembalikan ke 1
    DB::table('jawaban_siswas')
        ->where('is_benar', true)
        ->where('nilai', 5)
        ->update(['nilai' => 1]);
}
```

```bash
php artisan migrate
```

## Rekomendasi

**Tidak perlu update data lama** karena:
1. ✅ Sistem sudah menghitung dengan benar menggunakan skala 100
2. ✅ Nilai raw tetap ditampilkan untuk transparansi
3. ✅ Guru bisa lihat nilai asli (X dari Y)
4. ⚠️ Update manual bisa mengubah nilai siswa secara retroaktif (tidak adil)

## Catatan Penting

Jika melakukan update manual:
- ⚠️ Nilai siswa akan berubah secara otomatis
- ⚠️ Siswa yang sudah lulus dengan nilai lama akan mendapat nilai baru
- ⚠️ Tidak bisa dibedakan antara ujian lama vs baru

**Saran:** Biarkan data lama apa adanya, sistem akan menghitung dengan benar.
