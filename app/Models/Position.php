<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function karyawan() 
    {
        return $this->hasMany(Karyawan::class, 'position_id', 'id');
    }

    public function gajiKaryawan() 
    {
        return $this->hasMany(GajiKaryawan::class);
    }
}
