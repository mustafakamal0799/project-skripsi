<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'position_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function laporanHarian (){
        return $this->hasMany(laporanHarian::class);
    }

    public function pendapatan() {
        return $this->hasMany(Pendapatan::class);
    }

    public function pengeluaran() {
        return $this->hasMany(Pengeluaran::class);
    }

    public function karyawan () {
        return $this->hasMany(Karyawan::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

}
