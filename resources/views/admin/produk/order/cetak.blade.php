<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <title>CETAK ORDER</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .text-center {
            text-align: center;
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
        <h4 class="text-center mb-3">LAPORAN PEMESANAN</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders->groupBy(['supplier_id']) as $laporanGroup)
                    @php
                        $firstRow = true;
                        $grandTotal = 0;
                    @endphp
                    @foreach ($laporanGroup as $data)
                    @php
                        $totalHarga = $data->product->harga_beli * $data->banyak;
                        $grandTotal += $totalHarga;
                    @endphp
                    <tr>
                        @if ($firstRow)
                            <td class="text-center" rowspan="{{ count($laporanGroup) }}">{{ $loop->iteration }}</td>                            
                            <td rowspan="{{ count($laporanGroup) }}">{{ $data->supplier->nama_perusahaan }}</td>
                            @php
                            $firstRow = false;
                            @endphp
                        @endif
                        <td>{{ $data->product->nama_barang }}</td>
                        <td class="text-center">{{ $data->banyak }}</td>
                        <td class="text-center">{{ $data->tanggal_order }}</td>
                        <td class="text-center">Rp. {{ number_format($data->product->harga_beli, 0, ',', '.') }}</td>
                        <td class="text-center">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-right"><strong>Total Keseluruhan:</strong></td>
                    <td class="text-center"><strong>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
    {{-- <script type="text/javascript">
        window.print();
    </script> --}}
</body>
</html>
