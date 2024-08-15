@extends('template.layout')

@section('title', 'Tambah Shift')

@section('content')
<form action="/shift-store" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="title text-center" style="font-size : 30px; ">Tambah Shift</h3>
        </div>
        <div class="card-body">
            <div class="input">
                <label for="nama_shift" class="form-label" style="font-size:15px">Nama</label>
                <input type="text" name="nama_shift" id="nama_shift" class="form-control" required>
            </div>
            <div class="input">
                <label for="jam_masuk" class="form-label" style="font-size:15px">Jam Masuk</label>
                <input type="time" name="jam_masuk" id="jam_masuk" class="form-control" required>
            </div>
            <div class="input">
                <label for="jam_keluar" class="form-label" style="font-size:15px">Jam Keluar</label>
                <input type="time" name="jam_keluar" id="jam_keluar" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
            <a href="/shift" class="btn btn-outline-danger">Batal</a>
        </div>
    </div>
</form>

@endsection