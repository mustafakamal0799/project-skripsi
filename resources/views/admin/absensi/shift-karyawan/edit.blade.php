@extends('template.layout')

@section('title', 'Edit Shift Karyawan')

@section('content')

<div class="container">
    <h2>Edit Shift Karyawan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/shift-karyawan.update/{{$shiftKaryawan->id}}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="karyawan_id">Nama Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                <option value="" disabled>Pilih Karyawan</option>
                @foreach($karyawan as $k)
                    <option value="{{ $k->id }}" {{ $shiftKaryawan->karyawan_id == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="shift_id">Nama Shift</label>
            <select name="shift_id" id="shift_id" class="form-control" required>
                <option value="" disabled>Pilih Shift</option>
                @foreach($jamKerja as $shift)
                    <option value="{{ $shift->id }}" {{ $shiftKaryawan->shift_id == $shift->id ? 'selected' : '' }}>{{ $shift->nama_shift }} ({{ $shift->jam_masuk }} - {{ $shift->jam_keluar }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $shiftKaryawan->tanggal }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/shift-karyawan" class="btn btn-secondary">Batal</a>
    </form>
</div>

@endsection
