<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto_profile',
        'agama',
        'mapel_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
public function mapel()
{
    return $this->belongsTo(Mapel::class);
}
  public function tugas()
    {
        return $this->hasMany(Tugas::class, 'guru_id');
    }
    public function walikelas()
    {
        return $this->hasOne(Walikelas::class, 'guru_id');
    }
      public function babs()
    {
        return $this->hasMany(Bab::class);
    }
}
