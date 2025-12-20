<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
       'jurusan_id',
        'nama_kelas',
    
    ];

    /**
     * Relasi: 1 kelas memiliki banyak ruang
     */
     public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
       public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function walikelas()
    {
        return $this->hasOne(Walikelas::class, 'kelas_id');
    }
  public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kelas_id');
    }
}
