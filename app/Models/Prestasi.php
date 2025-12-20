<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    /**
     * 
     */
    protected $fillable = [
        'siswa_id',
        'nama_prestasi',
        'jenis',
        'tingkat',
        'peringkat',
        'tanggal',
        'file_bukti',
        'keterangan',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * RELASI
     * Prestasi dimiliki oleh satu siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
