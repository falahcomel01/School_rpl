# Langkah-Langkah Cek Timer

## PENTING: Ikuti Step by Step!

### Step 1: Cek Alert Debug di Halaman

Saat halaman ujian terbuka, akan muncul **alert kuning** di atas dengan info:

```
DEBUG:
- Waktu Mulai: 2025-12-01T12:53:00.000000Z
- Durasi: 20 menit
- Status: sedang_dikerjakan
```

**❓ Apa yang harus dicek:**

✅ **Jika "Waktu Mulai" ada tanggal ISO:**
- Bagus! Data sudah di-pass dari controller

❌ **Jika "Waktu Mulai: TIDAK ADA":**
- Problem di controller
- Cek file: `app/Http/Controllers/UjianSiswaController.php` method `kerjakan()`
- Variable `$waktuMulaiIso` tidak di-pass

❌ **Jika "Durasi: TIDAK ADA":**
- Problem di database
- Cek table `ujians` kolom `durasi_menit`

---

### Step 2: Buka Browser Console (TEKAN F12)

**Cara buka:**
- Chrome/Edge: Tekan `F12` atau `Ctrl+Shift+I`
- Pilih tab **Console**

**Cek log yang muncul:**

#### ✅ Log Normal (Timer Jalan):
```
=== SCRIPT LOADED ===
=== DOM LOADED ===
=== MULAI INISIALISASI TIMER ===
Timer Debug: {
  waktuMulaiStr: "2025-12-01T12:53:00.000000Z",
  durasiMenit: 20,
  timerElement: <h3 id="timer">,
  timerElementFound: true
}
Timer initialized: {
  waktuMulai: "01/12/2025, 19:53:00",
  waktuSelesai: "01/12/2025, 20:13:00",
  durasiMenit: 20
}
Timer started successfully
```

#### ❌ Log Error:
Jika ada yang salah, akan muncul error di console.

---

### Step 3: Cek Alert Popup

Setelah halaman load, akan muncul **alert popup** jika ada error:

❌ **Alert: "ERROR: Timer element tidak ditemukan!"**
- Element `<h3 id="timer">` tidak ada di halaman
- Cek file: `resources/views/ujian_siswa/kerjakan.blade.php`
- Pastikan ada `<h3 id="timer">` di header

❌ **Alert: "ERROR: waktuMulaiStr kosong!"**
- Variable `$waktuMulaiIso` tidak di-pass dari controller
- Cek controller method `kerjakan()`

❌ **Alert: "ERROR: durasiMenit = 0"**
- Durasi ujian = 0 di database
- Update database: `UPDATE ujians SET durasi_menit = 20 WHERE id = ...`

---

### Step 4: Cek Timer Display

Lihat di kanan atas halaman, seharusnya ada:

```
Sisa Waktu
  19:45  ← HIJAU (normal)
```

atau

```
Sisa Waktu  
  04:30  ← MERAH (< 5 menit)
```

❌ **Jika tetap: "--:--"**
- Timer tidak berjalan
- Cek console untuk error
- Cek alert yang muncul

---

## Troubleshooting Berdasarkan Masalah

### Masalah A: Alert "waktuMulaiStr kosong"

**Penyebab:** Data tidak di-pass dari controller

**Solusi:**

1. Buka file: `app/Http/Controllers/UjianSiswaController.php`

2. Cari method `kerjakan()`

3. Pastikan ada kode ini di bagian akhir:
```php
return view('ujian_siswa.kerjakan', [
    'ujianSiswa' => $ujianSiswa,
    'waktuMulaiIso' => $waktuMulai->toISOString(), // ← HARUS ADA!
]);
```

4. Jika tidak ada, tambahkan line `'waktuMulaiIso' => $waktuMulai->toISOString(),`

5. Save file dan refresh halaman

---

### Masalah B: Alert "durasiMenit = 0"

**Penyebab:** Durasi ujian tidak diisi di database

**Solusi:**

1. Buka phpMyAdmin atau database tool

2. Jalankan query:
```sql
SELECT id, jenis_ujian, durasi_menit 
FROM ujians 
WHERE id = [ID_UJIAN_YANG_DIKERJAKAN];
```

3. Jika `durasi_menit` = 0 atau NULL, update:
```sql
UPDATE ujians 
SET durasi_menit = 20 
WHERE id = [ID_UJIAN];
```

4. Refresh halaman ujian

---

### Masalah C: Timer element tidak ditemukan

**Penyebab:** HTML `<h3 id="timer">` tidak ada

**Solusi:**

1. Buka file: `resources/views/ujian_siswa/kerjakan.blade.php`

2. Cari bagian header (sekitar line 15-20)

3. Pastikan ada:
```blade
<div class="text-center">
    <small class="text-muted d-block">Sisa Waktu</small>
    <h3 id="timer" class="fw-bold mb-0">
        <span class="text-success">--:--</span>
    </h3>
</div>
```

4. Jika tidak ada, tambahkan di `<x-slot name="header">`

---

### Masalah D: Script tidak running

**Cek Console:**
- ❌ Tidak ada log "=== SCRIPT LOADED ==="
- ❌ Tidak ada log "=== DOM LOADED ==="

**Penyebab:** JavaScript tidak diload

**Solusi:**

1. Cek file: `resources/views/layouts/app.blade.php`

2. Pastikan ada di bagian bawah (sebelum `</body>`):
```blade
@stack('scripts')
</body>
```

3. Jika tidak ada, tambahkan `@stack('scripts')`

---

## Test Manual

### Test 1: Buat Ujian Baru

1. Login sebagai guru/admin
2. Buat ujian baru:
   - Durasi: **1 menit** (untuk test cepat)
   - Status: **Aktif**
3. Atur soal (minimal 1 soal)

### Test 2: Login sebagai Siswa

1. Login dengan akun siswa
2. Pilih ujian yang baru dibuat
3. Klik "Mulai Ujian"

### Test 3: Cek Timer

1. Halaman terbuka
2. **CEK ALERT KUNING:** Apakah ada data?
3. **TEKAN F12:** Lihat console
4. **CEK LOG:** Apakah ada "Timer started successfully"?
5. **LIHAT TIMER:** Apakah countdown dari 01:00 → 00:59 → ...?

### Test 4: Tunggu Waktu Habis

1. Tunggu sampai timer 00:00
2. Harus muncul alert: "Waktu habis!"
3. Ujian auto-submit

---

## Quick Fix: Jika Tetap Tidak Jalan

### Option 1: Clear Cache Browser

1. Tekan `Ctrl+Shift+Delete`
2. Pilih "Cached images and files"
3. Clear
4. Reload halaman (`Ctrl+F5`)

### Option 2: Cek di Browser Lain

1. Coba buka di browser berbeda (Chrome → Edge, dll)
2. Jika jalan → Problem di cache browser pertama
3. Jika tetap tidak jalan → Problem di kode

### Option 3: Hard Refresh

1. Tekan `Ctrl+F5` (hard reload)
2. Atau `Ctrl+Shift+R`

---

## Jika Masih Belum Jalan

**Kirim screenshot:**

1. Screenshot alert debug (kotak kuning)
2. Screenshot console (F12)
3. Screenshot timer display

**Info yang dibutuhkan:**
- Apa isi alert debug?
- Apa yang muncul di console?
- Apakah ada alert popup error?
- Browser apa yang digunakan?

---

## Checklist

- [ ] Alert debug muncul dengan data lengkap
- [ ] Console menampilkan "SCRIPT LOADED"
- [ ] Console menampilkan "DOM LOADED"
- [ ] Console menampilkan "Timer started successfully"
- [ ] Timer countdown terlihat (contoh: 19:45)
- [ ] Timer berubah setiap detik
- [ ] Timer berubah merah saat < 5 menit
- [ ] Alert "Waktu habis" muncul saat timer 00:00
- [ ] Ujian auto-submit saat waktu habis

Jika semua checklist ✅ → **Timer berjalan sempurna!** 🎉
