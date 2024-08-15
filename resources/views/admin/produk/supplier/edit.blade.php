@extends('template.layout')

@section('title', 'Tambah Supplier')

@section('content')
<form action="/supplier-update/{{$suppliers->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <h3 class="title text-center" style="font-size : 30px; ">Tambah Supplier</h3>
        </div>
        <div class="card-body">
            <div class="input">
                <label for="nama_perusahaan" class="form-label" style="font-size:15px">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required value="{{$suppliers->nama_perusahaan}}">
            </div>
            <div class="input">
                <label for="phone_number" class="form-label" style="font-size:15px">Nomor Perusahaan</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required value="{{$suppliers->phone_number}}">
            </div>
            <div class="input mt-2">
                <label for="alamat" class="form-label" style="font-size:15px">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{$suppliers->alamat}}">
            </div>
            <div class="input mt-2">
                <label for="kota" class="form-label" style="font-size:15px">Kota</label>
                <input type="text" name="kota" id="kota" class="form-control" required value="{{$suppliers->kota}}">
            </div>            
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Update</button>
            <a href="/product" class="btn btn-outline-danger">Batal</a>
        </div>
    </div>
</form>

@endsection