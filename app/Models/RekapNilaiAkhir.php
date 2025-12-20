<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapNilaiAkhir extends Model
{
    protected $fillable = [
        'pembobotan_nilai_id',
        'siswa_id',
        'kelas_id',
        'mapel_id',
        'rata_rata_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'semester',
        'tahun_ajaran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function pembobotan()
    {
        return $this->belongsTo(PembobotanNilai::class, 'pembobotan_nilai_id');
    }
}
