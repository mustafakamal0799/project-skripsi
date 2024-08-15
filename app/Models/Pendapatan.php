<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'tanggal',
        'terjual',
        'total',
        'bonus',
        'jenis_penjualan',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'user_id', 'user_id');
    }
}
