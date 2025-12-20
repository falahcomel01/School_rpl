<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kelas_id',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto_profile',
        'agama',
    ];

    /**
     * Relasi ke User (akun siswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Relasi ke Ruang (misal: Ruang A, B, C)
     */
    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

public function pengumpulan()
    {
        return $this->hasMany(TugasPengumpulan::class, 'siswa_id');
    }
    public function orangTua()
{
    return $this->hasOne(OrangTua::class);
}
 public function ekstrakurikuler()
    {
        return $this->belongsToMany(
            Ekstrakurikuler::class,
            'extra_pesertas',
            'siswa_id',
            'ekstrakurikuler_id'
        )->withTimestamps();
    }


    public function extraPeserta()
    {
        return $this->hasMany(ExtraPeserta::class);
    }
    public function prestasis()
{
    return $this->hasMany(Prestasi::class);
}
public function kelulusan()
{
    return $this->hasOne(Kelulusan::class);
}

public function nilaiAkhir()
{
    return $this->hasMany(RekapNilaiAkhir::class,'siswa_id');
}
public function rekomendasiJurusan()
{
    return $this->hasOne(RekomendasiJurusan::class, 'siswa_id');
}

}
