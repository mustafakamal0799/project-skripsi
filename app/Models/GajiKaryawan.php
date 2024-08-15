<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'karyawan_id',
        'position_id',
        'gaji_pokok'
    ];

    public function karyawan () 
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function position () 
    {
        return $this->belongsTo(Position::class);
    }
}
