<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';

    protected $fillable = [
        'jurusan_id',
        'nama_mapel',
         'tingkat', 
    ];

  
  public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
    public function gurus()
{
    return $this->hasOne(Guru::class);
}
 public function tugas()
    {
        return $this->hasMany(Tugas::class, 'mapel_id');
    }
}

