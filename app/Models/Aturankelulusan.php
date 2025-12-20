<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanKelulusan extends Model
{
    protected $fillable = [
        'nilai_minimal',
        'tahun',
    ];

    public function kelulusans()
    {
        return $this->hasMany(Kelulusan::class);
    }
}
