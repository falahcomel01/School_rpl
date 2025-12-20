<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'kelas_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $value;
    }

       public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
    public function guru()
    {
        return $this->hasOne(Guru::class);
    }
      public function orangtua()
    {
        return $this->hasOne(Orangtua::class);
    }
      public function superadmin()
    {
        return $this->hasOne(Superadmin::class);
    }
      public function tu()
    {
        return $this->hasOne(tu::class);
    }
       public function kepsek()
    {
        return $this->hasOne(Kepsek::class);
    }
    public function presensis()
{
    return $this->hasMany(Presensi::class);
}

public function perizinans()
{
    return $this->hasMany(Perizinan::class);
}
public function waliKelas()
{
    return $this->hasOneThrough(Walikelas::class,Guru::class,'user_id','guru_id','id', 'id');
}

public function pembina()
{
    return $this->hasOne(Pembina::class, 'user_id');
}


}


