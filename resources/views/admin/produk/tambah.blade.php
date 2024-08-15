@extends('template.layout')

@section('title', 'Tambah Produk')

@section('content')
<form action="/product-store" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="title text-center" style="font-size : 30px; ">Tambah Produk</h3>
        </div>
        <div class="card-body">
            <div class="input">
                <label for="nama_barang" class="form-label" style="font-size:15px">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
            </div>
            <div class="input">
                <label for="kode_barang" class="form-label" style="font-size:15px">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" required>
            </div>
            <div class="input mt-2">
                <label for="foto_barang" class="form-label" style="font-size:15px">Foto Barang</label>
                <input type="file" name="foto_barang" id="foto_barang" class="form-control">
            </div>
            <div class="input mt-2">
                <label for="isi" class="form-label" style="font-size:15px">Isi</label>
                <input type="text" name="isi" id="isi" class="form-control" required>
            </div>
            <div class="input mt-2">
                <label for="stok" class="form-label" style="font-size:15px">Stok</label>
                <input type="text" name="stok" id="stok" class="form-control" required>
            </div>
            <div class="input mt-2">
                <label for="minimal_barang" class="form-label" style="font-size:15px">Minimal Barang</label>                
                <input type="text" name="minimal_barang" id="minimal_barang" class="form-control" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="input mt-2">
                        <label for="harga_jual" class="form-label" style="font-size:15px">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input mt-2">
                        <label for="harga_beli" class="form-label" style="font-size:15px">Harga Beli</label>
                        <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
            <a href="/product" class="btn btn-outline-danger">Batal</a>
        </div>
    </div>
</form>

@endsection