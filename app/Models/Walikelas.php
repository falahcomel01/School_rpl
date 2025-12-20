<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'kelas_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class,'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
}
