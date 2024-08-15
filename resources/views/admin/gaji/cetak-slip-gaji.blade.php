<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SLIP GAJI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
        }
        h1, h2, h3, p {
            margin: 0;
            padding: 5px 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #eef;
            border: 1px solid #cce;
        }
        .info h3 {
            margin-bottom: 10px;
        }
        .salary-details {
            width: 100%;
            border-collapse: collapse;
        }
        .salary-details th, .salary-details td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .tanggal {
            text-align: right;
            margin-top: 20px;
        }
        .signature {
            margin-top: 70px;
            text-align: right;
        }

    </style>
</head>
<body>
    <div class="header">
        <h1>Slip Gaji</h1>
        <hr>
    </div>

    <div class="content">
        <div class="info">
            <h3>Informasi Karyawan</h3>
            <p><strong>Nama:</strong> {{$karyawan->user->name}}</p>
            <p><strong>Posisi:</strong> {{$karyawan->position->name}}</p>            
        </div>
        

        <table class="salary-details">
            <tr>
                <th>Gaji Pokok</th>
                <td>Rp. {{ number_format($karyawan->gaji->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Bonus</th>
                <td>Rp. {{ number_format($karyawan->pendapatan->sum('bonus'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Gaji</th>
                <td>Rp. {{ number_format($totalGaji, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="tanggal">
            <p>Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </div>

        <div class="signature">            
            <div class="line">
                <strong>{{ $penandatangan }}</strong>
            </div>
        </div>
    </div>
</body>
</html>
