# Dokumentasi Penilaian Essay Satu Kali

## Fitur: Penilaian Essay Hanya Sekali

Guru **hanya bisa memberikan nilai essay 1 kali saja**. Setelah nilai disimpan, form penilaian akan hilang dan tidak bisa diubah lagi.

## Cara Kerja

### 1. Sebelum Dinilai (is_benar = null)

**Tampilan:**
```
┌─────────────────────────────────────────────────┐
│ Jawaban Siswa:                                  │
│ [Jawaban essay siswa di sini...]               │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ 📝 Beri Nilai                                   │
│                                                 │
│ Nilai (Bobot: 5)  [0-5]  [Simpan Nilai]       │
│                                                 │
│ ⓘ Nilai hanya bisa disimpan 1 kali            │
└─────────────────────────────────────────────────┘
```

### 2. Setelah Dinilai (is_benar = true)

**Tampilan:**
```
┌─────────────────────────────────────────────────┐
│ Jawaban Siswa:                                  │
│ [Jawaban essay siswa di sini...]               │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ ✅ Sudah Dinilai                 [4.5 / 5]     │
│ Nilai yang diberikan sudah tersimpan           │
│ dan tidak dapat diubah.                        │
└─────────────────────────────────────────────────┘
```

## Logika Backend

### Controller: `UjianSiswaController::updateNilai()`

```php
public function updateNilai(Request $request, JawabanSiswa $jawaban)
{
    // Cek apakah sudah pernah dinilai
    if ($jawaban->is_benar !== null) {
        return response()->json([
            'success' => false,
            'message' => 'Nilai sudah pernah disimpan dan tidak dapat diubah!'
        ], 400);
    }

    $request->validate([
        'nilai' => 'required|numeric|min:0'
    ]);

    $jawaban->nilai = $request->nilai;
    $jawaban->is_benar = true; // Menandai sudah dinilai
    $jawaban->save();

    return response()->json([
        'success' => true,
        'message' => 'Nilai berhasil disimpan'
    ]);
}
```

**Penjelasan:**
- `is_benar = null`: Belum dinilai (form muncul)
- `is_benar = true`: Sudah dinilai (form hilang, tampil badge)

### View: `detail_penilaian.blade.php`

```blade
@if($jawaban->is_benar !== null)
    {{-- Sudah dinilai - Tampilkan nilai saja --}}
    <div class="alert alert-success">
        ...badge nilai...
    </div>
@else
    {{-- Belum dinilai - Tampilkan form --}}
    <form class="form-nilai">
        ...form penilaian...
    </form>
@endif
```

## Flow Penilaian

### Step by Step:

1. **Guru membuka halaman detail penilaian**
   - Melihat semua jawaban siswa
   - Essay yang belum dinilai menampilkan form

2. **Guru mengisi nilai (0-5)**
   - Input nilai dengan step 0.5
   - Klik "Simpan Nilai"

3. **Sistem menyimpan nilai**
   - Validasi nilai (0-5)
   - Cek apakah sudah pernah dinilai → Jika ya, tolak
   - Set `nilai` dan `is_benar = true`
   - Save ke database

4. **Halaman reload otomatis**
   - Form penilaian hilang
   - Muncul alert hijau "Sudah Dinilai"
   - Badge menampilkan nilai final

5. **Nilai tidak bisa diubah**
   - Jika guru coba submit lagi → Error 400
   - Form tidak muncul lagi

## Keuntungan

### 1. **Transparansi**
- Siswa yakin nilai yang dilihat = nilai final
- Tidak ada perubahan nilai setelah pengumuman

### 2. **Konsistensi**
- Guru harus berhati-hati saat memberi nilai
- Nilai tidak bisa diubah sembarangan

### 3. **Audit Trail**
- Jelas kapan nilai diberikan (created_at)
- Tidak ada history perubahan nilai

## Contoh Skenario

### Skenario 1: Penilaian Normal
```
1. Guru buka detail penilaian siswa "Andi"
2. Soal Essay 1: Belum dinilai → Form muncul
3. Guru beri nilai: 4.5
4. Klik "Simpan Nilai"
5. Halaman reload
6. Form hilang → Badge "4.5 / 5" muncul
```

### Skenario 2: Guru Coba Ubah Nilai (Gagal)
```
1. Guru sudah beri nilai 4.5
2. Form sudah hilang, hanya ada badge
3. Guru tidak bisa ubah nilai karena form tidak ada
4. Jika guru coba akses endpoint updateNilai via API → Error 400
```

### Skenario 3: Multiple Essay
```
Essay 1: Sudah dinilai → Badge 5 / 5
Essay 2: Belum dinilai → Form muncul
Essay 3: Belum dinilai → Form muncul

Guru hanya perlu nilai Essay 2 & 3
Essay 1 tetap locked
```

## Jika Perlu Ubah Nilai (Manual)

Jika benar-benar perlu mengubah nilai (kasus khusus):

### Via Database Manual:
```sql
-- Reset nilai essay untuk bisa dinilai ulang
UPDATE jawaban_siswas 
SET is_benar = NULL, nilai = 0 
WHERE id = [jawaban_id];
```

### Via Tinker:
```php
$jawaban = JawabanSiswa::find([jawaban_id]);
$jawaban->is_benar = null;
$jawaban->nilai = 0;
$jawaban->save();
```

**⚠️ Catatan:** 
- Hanya lakukan jika benar-benar perlu
- Dokumentasikan alasan perubahan
- Inform siswa jika nilai berubah

## Testing

### Test Case 1: Nilai Pertama Kali
- Akses detail penilaian
- Form harus muncul
- Submit nilai → Berhasil
- Reload → Form hilang

### Test Case 2: Nilai Kedua Kali
- Essay sudah dinilai
- Form harus hilang
- Badge nilai harus muncul
- Coba submit via API → Error 400

### Test Case 3: Multiple Essays
- Beberapa essay sudah dinilai
- Beberapa belum
- Form hanya muncul di yang belum dinilai

## Catatan Penting

1. **Irreversible**: Setelah nilai disimpan, tidak bisa diubah via UI
2. **One-time only**: Guru harus yakin sebelum klik "Simpan Nilai"
3. **Reload required**: Halaman otomatis reload untuk update tampilan
4. **Validation**: Sistem cek di backend untuk mencegah double submit
