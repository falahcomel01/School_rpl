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

    /**
     * BOOT METHOD - Validasi Otomatis untuk Mencegah Duplikasi
     * Ini akan bekerja setiap kali create/update data
     */
    protected static function boot()
    {
        parent::boot();

        // Validasi sebelum create (insert baru)
        static::creating(function ($kelulusan) {
            // Hanya validasi jika ada siswa_id (bukan legacy)
            if ($kelulusan->siswa_id && $kelulusan->tahun_lulus) {
                $exists = self::where('siswa_id', $kelulusan->siswa_id)
                    ->where('tahun_lulus', $kelulusan->tahun_lulus)
                    ->exists();
                
                if ($exists) {
                    throw new \Exception('Siswa ini sudah memiliki data kelulusan untuk tahun ' . $kelulusan->tahun_lulus . '. Tidak bisa generate ulang.');
                }
            }
        });

        // Validasi sebelum update (edit data)
        static::updating(function ($kelulusan) {
            // Hanya validasi jika ada siswa_id (bukan legacy)
            if ($kelulusan->siswa_id && $kelulusan->tahun_lulus) {
                $exists = self::where('siswa_id', $kelulusan->siswa_id)
                    ->where('tahun_lulus', $kelulusan->tahun_lulus)
                    ->where('id', '!=', $kelulusan->id) // Exclude diri sendiri
                    ->exists();
                
                if ($exists) {
                    throw new \Exception('Siswa ini sudah memiliki data kelulusan untuk tahun ' . $kelulusan->tahun_lulus);
                }
            }
        });
    }

    /**
     * RELATIONSHIPS
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function aturanKelulusan()
    {
        return $this->belongsTo(AturanKelulusan::class);
    }

    /**
     * SCOPES - Query Helper yang Berguna
     */
    public function scopeLulus($query)
    {
        return $query->where('status', 'lulus');
    }

    public function scopeTidakLulus($query)
    {
        return $query->where('status', 'tidak_lulus');
    }

    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun_lulus', $tahun);
    }

    /**
     * ACCESSORS - Helper untuk mendapatkan data dengan mudah
     */
    public function getNamaSiswaAttribute()
    {
        return $this->is_legacy 
            ? $this->nama_siswa_legacy 
            : ($this->siswa->user->name ?? '-');
    }

    public function getNamaJurusanAttribute()
    {
        return $this->is_legacy 
            ? $this->jurusan_legacy 
            : ($this->siswa->kelas->jurusan->nama_jurusan ?? '-');
    }
}