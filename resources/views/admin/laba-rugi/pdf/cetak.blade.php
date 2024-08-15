<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba Rugi</title>
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
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        .text-center { text-align: center; }
        .mb-3 { margin-bottom: 1rem; }
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

    <h1>Laporan Laba Rugi</h1>

    <p>Bulan: {{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}</p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pendapatan</th>
                <th>Pengeluaran</th>
                <th>Laba/Rugi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dailyPendapatan as $data)
                <tr>
                    <td>{{ $data->day }}</td>
                    <td>Rp. {{ number_format($data->total, 0, ',', '.' ) }}</td>
                    <td>Rp. {{ number_format($dailyPengeluaran->firstWhere('day', $data->day)->total ?? 0, 0, ',', '.' ) }}</td>
                    <td>Rp. {{ number_format($data->total - ($dailyPengeluaran->firstWhere('day', $data->day)->total ?? 0), 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
