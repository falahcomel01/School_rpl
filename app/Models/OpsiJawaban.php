<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class OpsiJawaban extends Model
{
       use HasFactory;
protected $fillable = [
        'soal_id',
        'opsi_text',
        'urutan',
        'is_benar',
    ];

    public function soal()
{
    return $this->belongsTo(Soal::class, 'soal_id');
}
    public function jawabanSiswas() // <--- UBAH INI JUGA
    {
        return $this->hasMany(JawabanSiswa::class, 'opsi_jawaban_id');
    }
}

