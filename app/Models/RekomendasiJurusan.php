<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiJurusan extends Model
{
    use HasFactory;

    // ⬇️ TAMBAHKAN INI (INI KUNCI UTAMA)
    protected $table = 'rekomendasi_jurusans';

    protected $fillable = [
        'siswa_id',
        'jurusan_id',
        'jurusan_rekomendasi_id',
        'validasi',
        'catatan_wali_kelas',
    ];

    protected $casts = [
        'validated_at' => 'datetime',
    ];

    // ================= RELATIONS =================

   public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // RekomendasiJurusan -> milik satu Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
    public function jurusanRekomendasi()
{
    return $this->belongsTo(Jurusan::class, 'jurusan_rekomendasi_id');
}

}
