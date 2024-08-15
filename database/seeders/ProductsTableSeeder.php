<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'nama_barang' => Str::random(10),
            'kode_barang' => Str::random(10). 'ATK001',
            'stok_barang' => Int::random_int(10),
            'minimal_barang' => Int::random_bytes(10). '10',
            'foto_barang' => 'images/1.png',
            'harga_beli' => '2000',
            'harga_jual' => '500',
        ]);
    }
}
