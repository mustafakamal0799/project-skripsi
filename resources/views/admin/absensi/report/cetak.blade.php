<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <title>CETAK ABSENSI</title>

    <style>
        table {
            position: relative;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="row">
            <div class="col">
                <img src="/image/logo-TAKA.png" style="width: 100px; margin-left: 20px;">
            </div>
            <div class="col">
                <h3 class="text-center">TAKA</h3>
                <h3 style="margin-top:-5px;"><center>PRINT FOTOCOPY</center></h3>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <p class="text-center" style="margin-top: -10px;">Jl. Adhiyaksa, Sungai Miai, Banjarmasin Utara, Kalimantan Selatan</p>
    <p class="text-center" style="font-style: italic; margin-top: -15px;">081520417596 || takaprint.15@gmail.com</p>
    <hr style="border: 2px solid black;">
    <hr style="border: 1px solid black; margin-top : -15px;">

    <h4 class="text-center mb-3">LAPORAN ABSENSI</h4>
    <div class="form-group">
        <table class="table table-bordered" align="center" rules="all" border="1px" style="width: 95%">
        <thead>
            <tr>
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
</body>
</html>