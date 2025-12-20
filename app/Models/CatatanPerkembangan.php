<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPerkembangan extends Model
{
    use HasFactory;

    protected $table = 'catatan_perkembangans';

    protected $fillable = [
        'siswa_id',
        'walikelas_id',
         'semester',        
        'tahun_ajaran',
        'catatan_akademik',
        'catatan_non_akademik',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function walikelas()
    {
        return $this->belongsTo(Walikelas::class, 'walikelas_id');
    }
}
