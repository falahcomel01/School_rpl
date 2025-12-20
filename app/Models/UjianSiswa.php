<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSiswa extends Model
{
        use HasFactory;
         protected $fillable = [
        'ujian_id',
        'siswa_id',
        'paket',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jawabanSiswas()
    {
        return $this->hasMany(JawabanSiswa::class, 'ujian_siswa_id', 'id');
    }

    public function getNilaiTotalAttribute()
    {
        $totalNilai = $this->jawabanSiswas()->sum('nilai');
        $totalSoal = $this->jawabanSiswas()->count();
        
        if ($totalSoal == 0) return 0;
        
        // Konversi ke skala 100
        // Total nilai maksimal = totalSoal * 5
        $nilaiMaksimal = $totalSoal * 5;
        
        return round(($totalNilai / $nilaiMaksimal) * 100, 2);
    }
    
    public function getNilaiRawAttribute()
    {
        return $this->jawabanSiswas()->sum('nilai');
    }
}
