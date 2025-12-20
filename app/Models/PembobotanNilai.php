<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembobotanNilai extends Model
{
    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'guru_id',
        'bobot_tugas',
        'bobot_uts',
        'bobot_uas',
        'semester',
        'tahun_ajaran',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function rekaps()
    {
        return $this->hasMany(RekapNilaiAkhir::class, 'pembobotan_nilai_id');
    }
}
