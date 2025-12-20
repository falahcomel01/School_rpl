<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    // 🔥 PASTIKAN NAMA TABEL BENAR
    protected $table = 'kelulusans';

    protected $fillable = [
        'siswa_id',
        'nama_siswa_legacy',
        'jurusan_legacy',
        'aturan_kelulusan_id',
        'nilai_akhir',
        'status',
        'tahun_lulus',
        'is_legacy',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function aturanKelulusan()
    {
        return $this->belongsTo(AturanKelulusan::class);
    }
}
