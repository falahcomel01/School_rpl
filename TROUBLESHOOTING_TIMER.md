# Troubleshooting Timer Ujian

## Masalah: Timer Tidak Muncul

Jika timer menampilkan `--:--` atau tidak muncul sama sekali, ikuti langkah berikut:

## Cara Debug

### 1. Buka Browser Console (F12)

Cek log berikut di Console:

```javascript
Timer Debug: {
  waktuMulaiStr: "...",  // Harus ada nilai ISO string
  durasiMenit: 20,       // Harus ada angka > 0
  timerElement: <h3>... // Harus ditemukan
}
```

### 2. Kemungkinan Error & Solusi

#### Error: "Timer element tidak ditemukan!"
**Penyebab:** Element `<h3 id="timer">` tidak ada di halaman

**Solusi:**
- Pastikan ada `<h3 id="timer">` di header
- Cek apakah layout app.blade.php sudah benar

---

#### Error: "Data timer tidak lengkap!"
**Penyebab:** `waktuMulaiStr` atau `durasiMenit` kosong/null

**Cek di Console:**
```javascript
{ 
  waktuMulaiStr: "",     // ❌ Kosong
  durasiMenit: 0         // ❌ Nol
}
```

**Solusi:**

**1. Cek Controller:**
```php
// File: app/Http/Controllers/UjianSiswaController.php
public function kerjakan(UjianSiswa $ujian_siswa)
{
    // Pastikan waktu_mulai ter-set
    if (!$ujianSiswa->waktu_mulai) {
        $ujianSiswa->waktu_mulai = now();
        $ujianSiswa->save();
    }
    
    return view('ujian_siswa.kerjakan', [
        'ujianSiswa' => $ujianSiswa,
        'waktuMulaiIso' => $ujianSiswa->waktu_mulai->toISOString(), // ← Harus ada
    ]);
}
```

**2. Cek Database:**
```sql
-- Lihat waktu_mulai apakah terisi
SELECT id, waktu_mulai, status 
FROM ujian_siswas 
WHERE siswa_id = [id_siswa];
```

**3. Cek Ujian:**
```sql
-- Lihat durasi_menit apakah > 0
SELECT id, jenis_ujian, durasi_menit 
FROM ujians 
WHERE id = [id_ujian];
```

---

#### Timer Showing: "Error: Data tidak lengkap"
**Penyebab:** Variable tidak di-pass dengan benar dari controller

**Solusi:**
```php
// Pastikan di controller
return view('ujian_siswa.kerjakan', [
    'ujianSiswa' => $ujianSiswa,
    'waktuMulaiIso' => $ujianSiswa->waktu_mulai->toISOString(),
    // ☝️ PENTING: waktuMulaiIso harus ada
]);
```

---

#### Timer Showing: "Error: [error message]"
**Penyebab:** JavaScript error saat inisialisasi

**Cek Console untuk error:**
```
Error initializing timer: [error detail]
```

**Solusi:**
- Cek format ISO string benar
- Cek JavaScript tidak ada syntax error

---

## Flow Timer Normal

### 1. Siswa Klik "Mulai Ujian"
```
Route: ujian_siswa.mulai
↓
Controller: mulai()
↓
Set waktu_mulai = now()
Set status = 'sedang_dikerjakan'
↓
Redirect ke ujian_siswa.kerjakan
```

### 2. Halaman Kerjakan Load
```
Route: ujian_siswa.kerjakan
↓
Controller: kerjakan()
↓
Cek waktu_mulai (jika null → set now())
↓
Pass waktuMulaiIso ke view
↓
View: kerjakan.blade.php
```

### 3. JavaScript Timer Berjalan
```javascript
// DOMContentLoaded
↓
Get waktuMulaiStr & durasiMenit
↓
Calculate waktuSelesai = waktuMulai + durasiMenit
↓
Update timer setiap 1 detik
↓
Jika waktu habis → auto submit
```

## Contoh Console Log Normal

```javascript
Timer Debug: {
  waktuMulaiStr: "2025-12-01T12:53:00.000000Z",
  durasiMenit: 20,
  timerElement: <h3 id="timer" class="fw-bold mb-0">
}

Timer initialized: {
  waktuMulai: "01/12/2025, 19:53:00",  // Waktu lokal
  waktuSelesai: "01/12/2025, 20:13:00",
  durasiMenit: 20
}

Timer started successfully
```

## Contoh Timer Display

### Normal (Hijau):
```
Sisa Waktu
  15:30
```

### Hampir Habis < 5 menit (Merah):
```
Sisa Waktu
  04:45
```

### Error:
```
Sisa Waktu
  Error: Data tidak lengkap
```

## Checklist Debugging

- [ ] Buka Browser Console (F12)
- [ ] Lihat log "Timer Debug"
- [ ] Cek `waktuMulaiStr` tidak kosong
- [ ] Cek `durasiMenit` > 0
- [ ] Cek `timerElement` ditemukan
- [ ] Lihat log "Timer initialized"
- [ ] Lihat log "Timer started successfully"
- [ ] Timer mulai countdown

## Fix Manual Database

Jika `waktu_mulai` NULL di database:

```sql
-- Update waktu_mulai untuk ujian yang sedang dikerjakan
UPDATE ujian_siswas 
SET waktu_mulai = NOW() 
WHERE id = [ujian_siswa_id] 
AND waktu_mulai IS NULL;
```

## Kode Lengkap Timer

```javascript
// === TIMER ===
const timerElement = document.getElementById('timer');
const waktuMulaiStr = "{{ $waktuMulaiIso ?? '' }}";
const durasiMenit = {{ $ujianSiswa->ujian->durasi_menit ?? 0 }};

console.log('Timer Debug:', { 
    waktuMulaiStr, 
    durasiMenit,
    timerElement 
});

if (!timerElement) {
    console.error('Timer element tidak ditemukan!');
} else if (!waktuMulaiStr || !durasiMenit) {
    console.error('Data timer tidak lengkap!');
    timerElement.innerHTML = '<span class="text-warning">Error: Data tidak lengkap</span>';
} else {
    try {
        const waktuMulai = new Date(waktuMulaiStr);
        const waktuSelesai = new Date(waktuMulai.getTime() + durasiMenit * 60000);
        
        console.log('Timer initialized:', {
            waktuMulai: waktuMulai.toLocaleString(),
            waktuSelesai: waktuSelesai.toLocaleString(),
            durasiMenit
        });

        function updateTimer() {
            const now = new Date();
            const selisih = Math.floor((waktuSelesai - now) / 1000);
            
            if (selisih <= 0) {
                clearInterval(timerInterval);
                alert('⏰ Waktu habis! Ujian dikumpulkan otomatis.');
                btnSelesai.click();
                return;
            }
            
            const menit = Math.floor(selisih / 60);
            const detik = selisih % 60;
            const timeString = `${String(menit).padStart(2, '0')}:${String(detik).padStart(2, '0')}`;
            const warna = selisih < 300 ? 'text-danger' : 'text-success';
            timerElement.innerHTML = `<span class="${warna}">${timeString}</span>`;
        }

        updateTimer(); // Jalankan segera
        const timerInterval = setInterval(updateTimer, 1000);
        console.log('Timer started successfully');
    } catch (error) {
        console.error('Error initializing timer:', error);
        timerElement.innerHTML = '<span class="text-danger">Error: ' + error.message + '</span>';
    }
}
```

## Test Timer

### Manual Test:

1. **Login sebagai siswa**
2. **Pilih ujian aktif**
3. **Klik "Mulai Ujian"**
4. **Buka Console (F12)**
5. **Cek log:**
   - ✅ "Timer Debug" muncul
   - ✅ waktuMulaiStr terisi
   - ✅ durasiMenit > 0
   - ✅ "Timer initialized" muncul
   - ✅ "Timer started successfully" muncul
6. **Lihat timer countdown** (misalnya: 19:59, 19:58, ...)

### Test Waktu Habis:

1. Buat ujian dengan durasi 1 menit
2. Mulai ujian
3. Tunggu 1 menit
4. Harus muncul alert "Waktu habis!"
5. Ujian auto-submit
