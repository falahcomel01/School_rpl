# Preview Tampilan Paket di Halaman Ujian Siswa

## Daftar Ujian Siswa (Index)

Berikut adalah preview tampilan informasi paket di halaman daftar ujian siswa:

### Contoh Tabel dengan Informasi Paket

```
┌────┬─────────────────┬──────────┬────────────────────────┬──────────────┬─────────────────────────┬─────────────────┐
│ No │  Jenis Ujian    │  Durasi  │  Waktu Pelaksanaan     │ Status Ujian │     Status Anda         │      Aksi       │
├────┼─────────────────┼──────────┼────────────────────────┼──────────────┼─────────────────────────┼─────────────────┤
│ 1  │ UTS             │ 20 Menit │ 📅 Mulai: 01 Dec 2025  │   [Aktif]    │ [Sedang Dikerjakan]     │  [Lanjutkan]    │
│    │ 🔀 2 Paket      │          │ ✅ Selesai: 04 Dec     │              │                         │                 │
│    │                 │          │                        │              │  📄 Paket A             │                 │
├────┼─────────────────┼──────────┼────────────────────────┼──────────────┼─────────────────────────┼─────────────────┤
│ 2  │ UTS             │ 20 Menit │ 📅 Mulai: 01 Dec 2025  │   [Aktif]    │    [Selesai]            │  [Lihat Hasil]  │
│    │ 🔀 3 Paket      │          │ ✅ Selesai: 02 Dec     │              │                         │                 │
│    │                 │          │                        │              │  📄 Paket B             │                 │
├────┼─────────────────┼──────────┼────────────────────────┼──────────────┼─────────────────────────┼─────────────────┤
│ 3  │ UTS             │ 20 Menit │ 📅 Mulai: 01 Dec 2025  │   [Draft]    │  [Belum Mulai]          │ Belum Dimulai   │
│    │ 📄 1 Paket      │          │ ✅ Selesai: 02 Dec     │              │                         │                 │
│    │                 │          │                        │              │  (belum ada paket)      │                 │
├────┼─────────────────┼──────────┼────────────────────────┼──────────────┼─────────────────────────┼─────────────────┤
│ 4  │ UTS             │ 20 Menit │ 📅 Mulai: 30 Nov 2025  │   [Aktif]    │  [Belum Mulai]          │  [Mulai Ujian]  │
│    │ 🔀 2 Paket      │          │ ✅ Selesai: 02 Dec     │              │                         │                 │
│    │                 │          │                        │              │  (belum ada paket)      │                 │
└────┴─────────────────┴──────────┴────────────────────────┴──────────────┴─────────────────────────┴─────────────────┘
```

## Penjelasan Informasi

### 1. Kolom "Jenis Ujian"
Menampilkan:
- **Nama Ujian** (UTS, UAS, PAS, dll)
- **Ikon & Info Paket**:
  - 🔀 X Paket → Untuk tipe Random dengan jumlah X paket
  - 📄 1 Paket → Untuk tipe 1 Paket (semua siswa sama)

### 2. Kolom "Status Anda"
Menampilkan:
- **Status Pengerjaan** (Badge berwarna):
  - 🔵 Belum Mulai → Badge Info (biru)
  - ⚠️ Sedang Dikerjakan → Badge Warning (kuning)
  - ✅ Selesai → Badge Success (hijau)
  
- **Paket yang Didapat** (Badge hitam, muncul jika sudah mulai):
  - 📄 Paket A/B/C/... → Badge Dark (hitam)

## Kondisi Tampilan Paket

### Kapan Info Paket Muncul?

1. **Info Tipe Paket (di kolom Jenis Ujian)**
   - ✅ Selalu muncul untuk semua ujian
   - Memberitahu siswa apakah ujian menggunakan sistem paket atau tidak

2. **Info Paket yang Didapat (di kolom Status Anda)**
   - ✅ Muncul hanya jika siswa **sudah pernah memulai ujian**
   - ❌ Tidak muncul jika status "Belum Mulai"
   - Menunjukkan paket spesifik yang diterima siswa (A, B, C, dst)

## Contoh Skenario

### Skenario 1: Siswa Belum Mulai Ujian Random 2 Paket
```
Jenis Ujian: UTS
             🔀 2 Paket

Status Anda: [Belum Mulai]
             (tidak ada info paket)

Aksi:        [Mulai Ujian] ← Saat diklik, sistem otomatis assign paket
```

### Skenario 2: Siswa Sedang Mengerjakan Ujian Random 2 Paket
```
Jenis Ujian: UTS
             🔀 2 Paket

Status Anda: [Sedang Dikerjakan]
             📄 Paket A ← Paket yang didapat

Aksi:        [Lanjutkan]
```

### Skenario 3: Siswa Selesai Ujian 1 Paket
```
Jenis Ujian: UTS
             📄 1 Paket

Status Anda: [Selesai]
             📄 Paket A ← Semua siswa dapat Paket A

Aksi:        [Lihat Hasil]
```

## CSS/Styling

Badge yang digunakan:
- **Tipe Paket**: `text-muted` dengan ikon `fa-shuffle` atau `fa-file`
- **Paket Siswa**: `badge bg-dark` dengan ikon `fa-file-lines`

## Lokasi Tampilan Lainnya

Informasi paket juga ditampilkan di:

1. **Halaman Kerjakan Ujian** (`ujian_siswa/kerjakan.blade.php`)
   - Di header: badge `bg-info` - "Paket X"

2. **Halaman Hasil Ujian** (`ujian_siswa/hasil.blade.php`)
   - Di header card: badge `bg-light text-dark` - "Paket X"

3. **Halaman Daftar Ujian** (`ujian_siswa/index.blade.php`) ← BARU!
   - Di kolom Jenis Ujian: info tipe paket
   - Di kolom Status Anda: paket yang didapat siswa
