<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = [
        'mapel_id',
        'guru_id',
        'kelas_id',
        'judul_tugas',
        'deskripsi',
        'file_tugas',
        'deadline'
    ];

    /**
     * Relations
     */

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function pengumpulan()
    {
        return $this->hasMany(TugasPengumpulan::class, 'tugas_id');
    }
}


