<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = 
    [
        'nama', 
        'user_id', 
        'position_id', 
        'jenis_kelamin', 
        'tanggal_lahir', 
        'alamat', 
        'hp', 
        'email', 
        'foto'
    ];

    public function position() 
    {
        return $this->belongsTo(Position::class);
    }

    public function gaji() 
    {
        return $this->hasOne(GajiKaryawan::class, 'karyawan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pendapatan () 
    {
        return $this->hasMany(Pendapatan::class, 'user_id', 'user_id');
    }
}
