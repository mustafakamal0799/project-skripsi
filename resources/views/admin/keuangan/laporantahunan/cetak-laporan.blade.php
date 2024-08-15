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

    <h4 class="text-center mb-3">LAPORAN TAHUNAN</h4>
    <div class="form-group">
        <table class="table table-bordered" align="center" rules="all" border="1px" style="width: 95%">
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Barang Terjual</th>
                    <th>Jumlah Terjual</th>
                    <th>Total Pendapatan</th>
                    <th>Total Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanTahunan->groupBy('tanggal') as $tanggal => $laporanGroup)
                    @php
                        $firstRow = true;
                    @endphp
                    @foreach ($laporanGroup as $data)
                        @php
                            $produk_terjual = json_decode($data->produk_terjual, true);
                        @endphp
                        @foreach ($produk_terjual as $namaBarang => $jumlahTerjual)
                            <tr>
                                @if($firstRow)
                                    <td rowspan="{{ count($produk_terjual) }}">{{ $data->tahun }}</td>
                                    @php
                                        $firstRow = false;
                                    @endphp
                                @endif
                                <td>{{ $namaBarang }}</td>
                                <td>{{ $jumlahTerjual }}</td>
                                @if($loop->first)
                                    <td rowspan="{{ count($produk_terjual) }}">Rp. {{ number_format($data->total_pendapatan, 0, ',', '.') }}</td>
                                    <td rowspan="{{ count($produk_terjual) }}">Rp. {{ number_format($data->total_pengeluaran, 0, ',', '.') }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>            
            <tfoot>
                <tr class="table">
                    <th colspan="3">Total</th>
                    <th>Rp. {{number_format($totalPendapatan, 0, ',', '.')}}</th>
                    <th>Rp. {{number_format($totalPengeluaran, 0, ',', '.')}}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>