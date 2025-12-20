<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tugaspengumpulan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_pengumpulan',
        'catatan',
        'nilai',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}

