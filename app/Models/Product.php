<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillabel = [
        'nama_barang',
        'kode_barang',
        'stok_barang',
        'minimal_barang',
        'foto_barang',
        'harga_beli',
        'harga_jual',
    ];

    public function pendapatan()
    {
        return $this->hasMany(Pendapatan::class);
    }
}
