<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisUjian extends Model
{
    protected $table = 'jenis_ujians';
    
    protected $fillable = ['guru_id', 'nama_jenis_ujian', 'deskripsi'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function soals()
    {
        return $this->hasMany(Soal::class, 'jenis_ujian_id');
    }
}
