<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_karyawan_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shiftKaryawan()
    {
        return $this->belongsTo(ShiftKaryawan::class, 'shift_karyawan_id');
    }
}
