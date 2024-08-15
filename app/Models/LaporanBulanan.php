<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'bulan',
        'total_pendapatan',
        'total_pengeluaran',
        'nama_barang',
        'produk_terjual',
        'keterangan'
    ];

    public function pendapatan () 
    {
        return $this->hasMany(Pendapatan::class);
    }

    public function pengeluaran () 
    {
        return $this->hasMany(Pengeluaran::class);
    }
    
}
