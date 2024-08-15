@extends('template.layout')

@section('title', 'Edit Gaji Karyawan')

@section('content')

<div class="card">
    <div class="card-header">
        <h1 class="title text-center">Edit Gaji Karyawan</h1>
    </div>
    <form action="/gaji-update/{{$gaji->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="karyawan_id">Nama Karyawan</label>
                <select name="karyawan_id" class="form-control">
                        <option value="">--Pilih Karyawan--</option>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" {{$karyawan->id == $gaji->karyawan_id ? 'selected' : ''}}>{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="position_id">Jabatan</label>
                <select name="position_id" id="position_id" class="form-control">
                        <option value="">--Pilih Jabatan--</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{$position->id == $gaji->position_id ? 'selected' : ''}}>{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="gaji_pokok">Jumlah Gaji</label>
                <input type="numeric" name="gaji_pokok" id="gaji_pokok" class="form-control" value="{{$gaji->gaji_pokok}}">
            </div>            
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-success">Update</button>
            <a href="/gaji" class="btn btn-outline-danger">Batal</a>
        </div>
    </form>
</div>

@endsection
