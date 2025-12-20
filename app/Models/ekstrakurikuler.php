<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekstrakurikuler extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_extra',
        'pembina_id',
        'deskripsi',
        'jadwal',
        'tempat',
        'kuota',
         'pendaftaran_mulai',
    'pendaftaran_selesai',
    ];

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id');
    }
    public function peserta()
    {
        return $this->belongsToMany(
            Siswa::class,
            'extra_pesertas',   // 🔥 HARUS SAMA
            'ekstrakurikuler_id',
            'siswa_id'
        )->withTimestamps();
    }
    public function extraPeserta()
    {
        return $this->hasMany(ExtraPeserta::class);
    }

}
