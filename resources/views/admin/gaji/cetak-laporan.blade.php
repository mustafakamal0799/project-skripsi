<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <title>CETAK LAPORAN</title>

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

    <h4 class="text-center mb-3">LAPORAN GAJI</h4>
    <div class="form-group">
        <table class="table table-bordered" align="center" rules="all" border="1px" style="width: 95%">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama Karyawan</th>
                    <th scope="col" class="text-center">Jabatan</th>
                    <th scope="col" class="text-center">Gaji Pokok</th>
                    <th scope="col" class="text-center">Bonus</th>
                    <th scope="col" class="text-center">Total Gaji</th>
                </tr>
            </thead>
            <tbody>
            @if($karyawan->count()>0)
                @foreach ($karyawan as $data)
                <tr>
                    <td class="col text-center">{{$loop->iteration}}</td>
                    <td class="col">{{$data->user->name}}</td>
                    <td class="col">{{$data->position->name ?? 'N/A'}}</td>
                    <td class="col">Rp. {{number_format($data->gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                    <td class="col">Rp. {{number_format($data->pendapatan->sum('bonus'), 0, ',', '.')}}</td>
                    <td class="col">Rp. {{number_format($data->totalGaji, 0, ',', '.')}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="10">Data Masih Kosong</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
