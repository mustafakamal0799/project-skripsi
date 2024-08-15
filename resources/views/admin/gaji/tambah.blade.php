@extends('template.layout')

@section('title', 'Tambah Gaji Karyawan')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="title text-center" style="font-size: 30px;">Tambah Gaji Karyawan</h3>
    </div>
    <form action="/gaji-store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="karyawan_id">Nama Karyawan</label>
                <select name="karyawan_id" class="form-control">
                        <option value="">--Pilih Karyawan--</option>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="position_id">Jabatan</label>
                <select name="position_id" id="position_id" class="form-control">
                        <option value="">--Pilih Jabatan--</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="gaji_pokok">Jumlah Gaji</label>
                <input type="numeric" name="gaji_pokok" id="gaji_pokok" class="form-control">
            </div>            
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
            <a href="/gaji" class="btn btn-outline-danger">Batal</a>
        </div>
    </form>
</div>

@endsection
