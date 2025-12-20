<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiEkstra extends Model
{
    use HasFactory;
        protected $fillable = [
        'extra_peserta_id',
        'perizinan_id',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function extraPeserta()
    {
        return $this->belongsTo(ExtraPeserta::class);
    }

    
    public function perizinan()
    {
        return $this->belongsTo(Perizinan::class);
    }

}
