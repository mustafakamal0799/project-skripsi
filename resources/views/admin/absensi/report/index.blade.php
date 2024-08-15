@extends('template.layout')

@section('title', 'Laporan Absensi')

@section('content')

<div class="container">
    <h2 class="text-center">Riwayat Absensi Karyawan</h2>
    <hr>
    <div class="card">
        <div class="card-header">
            <a href="/cetak-absensi" class="btn btn-success" target="blank">Cetak</a>
        </div>
        <div class="card-body">
            @if($absensi->isEmpty())
                <p>Tidak ada data absensi yang ditemukan.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Shift</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi as $absen)
                        <tr>
                            <td>{{ $absen->id }}</td>
                            <td>{{ $absen->user->name }}</td>
                            <td>{{ $absen->tanggal }}</td>
                            <td>{{ $absen->jam_masuk }}</td>
                            <td>{{ $absen->jam_keluar }}</td>
                            <td>{{ $absen->shiftKaryawan->shift->nama_shift }}</td>
                            <td>
                                @php
                                    $jamMasukShift = Carbon\Carbon::parse($absen->shiftKaryawan->shift->jam_masuk);
                                    $jamMasukAbsen = Carbon\Carbon::parse($absen->jam_masuk);
                                    $differenceInMinutes = $jamMasukShift->diffInMinutes($jamMasukAbsen, false);

                                    if ($differenceInMinutes > 20) {
                                        echo 'Telat';
                                    } else {
                                        echo 'Tepat Waktu';
                                    }
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>    
</div>
@endsection
