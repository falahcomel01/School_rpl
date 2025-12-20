<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'foto_profile',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function ekstrakurikuler()
    {
        return $this->hasMany(ekstrakurikuler::class, 'pembina_id');
    }
}
