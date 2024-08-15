@extends('template.layout')

@section('title', 'Tambah Pengeluaran Karyawan')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="title text-center" style="font-size: 30px;">Tambah Pengeluaran</h3>
    </div>
    <form action="/pengeluaran-store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <div class="form-group mt-2">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="total">Total</label>
                <input type="number" name="total" id="total" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="keterangan">Keteranagan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
            <a href="/pengeluaran" class="btn btn-outline-danger">Batal</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection
