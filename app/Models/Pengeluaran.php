<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'total',
        'keterangan'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function laporanHarian () 
    {
        return $this->belongsTo(LaporanHarian::class);
    }

    public function laporanBulanan () 
    {
        return $this->belongsTo(LaporanBulanan::class);
    }

    public function laporanTahunan () 
    {
        return $this->belongsTo(LaporanTahunan::class);
    }
}
