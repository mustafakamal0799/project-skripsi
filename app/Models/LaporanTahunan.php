<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTahunan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'tahun',
        'total_pendapatan',
        'total_pengeluaran',
        'nama_barang',
        'keterangan',
        'produk_terjual'
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
