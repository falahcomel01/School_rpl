<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class JawabanSiswa extends Model
{
     use HasFactory;
protected $fillable = [
        'ujian_siswa_id', 
        'ujian_soal_id',
        'opsi_jawaban_id',
        'jawaban_essay',
        'waktu_jawab',
        'nilai',
        'is_benar',
        'status_jawaban',
    ];

    protected $casts = [
        'is_benar' => 'boolean',
        'nilai' => 'float',
        'waktu_jawab' => 'datetime',
    ];

    public function ujianSiswa()
    {
        return $this->belongsTo(UjianSiswa::class, 'ujian_siswa_id');
    }

    public function ujianSoal()
    {
        return $this->belongsTo(UjianSoal::class, 'ujian_soal_id');
    }

    public function opsiJawaban()
    {
        return $this->belongsTo(OpsiJawaban::class, 'opsi_jawaban_id');
    }
}

