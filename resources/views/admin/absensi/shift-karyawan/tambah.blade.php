@extends('template.layout')

@section('title', 'Tambah Shift Karyawan')

@section('content')

<div class="container">
    <h2>Tambah Shift Karyawan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/shift-karyawan-store" method="POST">
        @csrf
        <div class="form-group">
            <label for="karyawan_id">Nama Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                <option value="" disabled selected>Pilih Karyawan</option>
                @foreach($karyawan as $k)
                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="shift_id">Nama Shift</label>
            <select name="shift_id" id="shift_id" class="form-control" required>
                <option value="" disabled selected>Pilih Shift</option>
                @foreach($jamKerja as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->nama_shift }} ({{ $shift->jam_masuk }} - {{ $shift->jam_keluar }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/shift-karyawan" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
