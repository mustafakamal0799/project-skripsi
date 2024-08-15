@extends('template.layout')

@section('title', 'Tambah Supplier')

@section('content')
<form action="/supplier-store" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="title text-center" style="font-size : 30px; ">Tambah Supplier</h3>
        </div>
        <div class="card-body">
            <div class="input">
                <label for="nama_perusahaan" class="form-label" style="font-size:15px">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required>
            </div>
            <div class="input">
                <label for="phone_number" class="form-label" style="font-size:15px">Nomor Perusahaan</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control">
            </div>
            <div class="input mt-2">
                <label for="alamat" class="form-label" style="font-size:15px">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control">
            </div>
            <div class="input mt-2">
                <label for="kota" class="form-label" style="font-size:15px">Kota</label>
                <input type="text" name="kota" id="kota" class="form-control" required>
            </div>            
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
            <a href="/product" class="btn btn-outline-danger">Batal</a>
        </div>
    </div>
</form>

@endsection