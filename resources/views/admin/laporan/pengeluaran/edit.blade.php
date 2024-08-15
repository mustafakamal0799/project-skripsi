@extends('template.layout')

@section('title', 'Edit Pengeluaran | Admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="title text-center" style="font-size: 30px;">Edit Pengeluaran</h3>
    </div>
    <form action="/pengeluaran-update/{{$pengeluarans->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mt-2">
                <label for="user_id">Nama Karyawan</label>
                <select name="user_id" class="form-control">
                        <option value="">Pilih Karyawan</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{$user->id == $pengeluarans->user_id ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$pengeluarans->tanggal}}">
            </div>
            <div class="form-group mt-2">
                <label for="total">Total</label>
                <input type="number" name="total" id="total" class="form-control" value="{{$pengeluarans->total}}">
            </div>
            <div class="form-group mt-2">
                <label for="keterangan">Keteranagan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{$pengeluarans->keterangan}}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-success">Update</button>
            <a href="/pendapatan" class="btn btn-outline-danger">Batal</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection
