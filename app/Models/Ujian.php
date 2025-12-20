<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model // <-- Huruf besar
{
    protected $table = 'ujians';

    protected $fillable = [
        'kelas_id',
        'guru_id',
        'jenis_ujian',
        'tipe_paket',
        'jumlah_paket',
        'jumlah_soal',
        'durasi_menit',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

     public function ujianSoals() // Dari 'ujiansoal' menjadi 'ujianSoals'
    {
        return $this->hasMany(UjianSoal::class);
    }
    public function ujianSiswas() // <-- Lebih standar
{
    return $this->hasMany(UjianSiswa::class);
}
}
