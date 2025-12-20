<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soals';

    protected $fillable = [
        'jenis_ujian_id',
        'soal_text',
        'tipe_soal'
    ];

    public function jenisUjian()
    {
        return $this->belongsTo(JenisUjian::class);
    }

    public function opsiJawaban()
    {
        return $this->hasMany(OpsiJawaban::class);
    }

    public function ujianSoals()
    {
        return $this->hasMany(UjianSoal::class);
    }

    public function guru()
    {
        return $this->hasOneThrough(
            Guru::class,
            JenisUjian::class,
            'id',               // JenisUjian.id
            'id',               // Guru.id
            'jenis_ujian_id',   // Soal.jenis_ujian_id
            'guru_id'           // JenisUjian.guru_id
        );
    }
}