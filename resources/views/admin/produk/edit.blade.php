@extends('template.layout')

@section('title', 'Update Produk')

@section('content')

<form action="/product-update/{{$products->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <h3 class="title text-center" style="font-size : 30px; ">Update Produk</h3>
        </div>
        <div class="card-body">
            <div class="input">
                <label for="nama_barang" class="form-label" style="font-size:15px">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{$products->nama_barang}}" required>
            </div>
            <div class="input">
                <label for="kode_barang" class="form-label" style="font-size:15px">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="{{$products->kode_barang}}" required>
            </div>
            <div class="input mt-2">
                <label for="foto_barang" class="form-label" style="font-size:15px">Foto Barang</label>
                <input type="file" name="foto_barang" id="foto_barang" class="form-control">
                @if ($products->foto_barang)
                    <img src="{{ asset('storage/' . $products->foto_barang) }}" alt="Foto Barang" class="img-thumbnail mt-2" style="width: 100px;">
                @endif
            </div>
            <div class="input mt-2">
                <label for="stok_barang" class="form-label" style="font-size:15px">Stok</label>
                <input type="text" name="stok_barang" id="stok_barang" class="form-control" value="{{$products->stok_barang}}" required>
            </div>
            <div class="input mt-2">
                <label for="minimal_barang" class="form-label" style="font-size:15px">Minimal Barang</label>                
                <input type="text" name="minimal_barang" id="minimal_barang" class="form-control" value="{{$products->minimal_barang}}" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="input mt-2">
                        <label for="harga_jual" class="form-label" style="font-size:15px">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{$products->harga_jual}}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input mt-2">
                        <label for="harga_beli" class="form-label" style="font-size:15px">Harga Beli</label>
                        <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="{{$products->harga_beli}}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Update</button>
            <a href="/product" class="btn btn-outline-danger">Batal</a>
        </div>
    </div>
</form>

@endsection