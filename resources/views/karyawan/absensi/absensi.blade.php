@extends('template.layout')

@section('title', 'Absensi')

@section('content')

<div class="container">
    <h2>Absensi Karyawan</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="/absen-masuk" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Absen Masuk</button>
    </form>

    <form action="/absen-keluar" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning mt-3">Absen Keluar</button>
    </form>

    <h3 class="mt-5">Riwayat Absensi</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $item)
            <tr>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_keluar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
