<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <title>CETAK LAPORAN</title>

    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }
        .header img {
            width: 100px;
        }
        .header h3 {
            margin: 0;
            text-align: center;
        }
        .header .company-info {
            text-align: center;
            font-style: italic;
            margin: 0;
        }
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        .text-center { text-align: center; }
        .mb-3 { margin-bottom: 1rem; }
        hr { border: 2px solid black; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <img src="{{ public_path('image/logo-TAKA.png') }}" style="width: 100px; margin-left: 20px;" alt="Logo">
        </div>
        <div>
            <h3>TAKA</h3>
            <h3 style="margin-top:-5px;">PRINT FOTOCOPY</h3>
        </div>
    </div>
    <p class="text-center">Jl. Adhiyaksa, Sungai Miai, Banjarmasin Utara, Kalimantan Selatan</p>
    <p class="text-center company-info">081520417596 || takaprint.15@gmail.com</p>
    <hr>
    <hr style="border: 1px solid black;">

    <h4 class="text-center mb-3">LAPORAN BULANAN</h4>
    <div class="form-group">
        <table class="table table-bordered" align="center" rules="all" border="1px" style="width: 95%">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Barang Terjual</th>
                    <th>Jumlah Terjual</th>
                    <th>Total Pendapatan</th>
                    <th>Total Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanBulanan->groupBy('tanggal') as $tanggal => $laporanGroup)
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
                                    <td rowspan="{{ count($produk_terjual) }}">{{ \Carbon\Carbon::parse($data->bulan)->format('F Y')}}</td>
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
</body>
</html>