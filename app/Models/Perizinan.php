<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;
 protected $fillable = [
        'user_id',
        'tanggal_ajukan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'file_surat',
        'validasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }
    public function presensiEkstras()
{
    return $this->hasMany(PresensiEkstra::class);
}

}