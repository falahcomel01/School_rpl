<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superadmin extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'foto_profile',
         'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto_profile',
        'agama',
    ];

public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
