<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';

    protected $fillable = [
        'nama_jurusan',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'jurusan_id');
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }
    public function rekomendasiJurusan()
{
    return $this->hasMany(RekomendasiJurusan::class, 'jurusan_id');
}

}
