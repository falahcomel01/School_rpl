<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ExtraPeserta extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ekstrakurikuler_id',
        'siswa_id',

    ];
     public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi pivot ke ekstrakurikuler
    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class);
    }
    public function presensiEkstras()
{
    return $this->hasMany(PresensiEkstra::class);
}
}
