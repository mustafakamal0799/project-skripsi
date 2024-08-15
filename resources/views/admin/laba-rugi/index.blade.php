@extends('template.layout')

@section('title', 'Laba - Rugi')

@section('content')

<style>
    .btn {
        margin-left: 5px;
    }
</style>

<h1 class="text-center">LABA / RUGI</h1>
<hr>

<!-- Form untuk memilih bulan dan tahun -->


<div class="card">
    <div class="card-header">
        <div class="d-flex">
            <form action="/laba-rugi" method="GET" class="d-flex">
                <select name="month" id="month" class="form-select">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                    @endfor
                </select>
                <select name="year" id="year" class="form-select">
                    @for ($y = Carbon\Carbon::now()->year; $y >= Carbon\Carbon::now()->year - 10; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-success">Tampilkan</button>        
            </form>    
            <a href="{{ route('cetak-laba-rugi', ['month' => $month, 'year' => $year]) }}" target="blank" class="btn btn-primary">Print</a>
            <a href="{{ route('export-laba-rugi', ['month' => $month, 'year' => $year]) }}" class="btn btn-danger">Export PDF</a>
        </div>
    </div>
    <div class="card-body">        
        <table class="table">
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
    </div>
</div>

<!-- Canvas untuk grafik -->
<div class="card">
    <div class="card-body">
        <canvas id="profitLossChart" width="400" height="200"></canvas>
    </div>    
</div>


<script>
    var ctx = document.getElementById('profitLossChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar', // Menggunakan grafik garis
        data: {
            labels: [
                @foreach ($dailyPendapatan as $data)
                    '{{ $data->day }}',
                @endforeach
            ],
            datasets: [
                {
                    label: 'Pendapatan',
                    backgroundColor: 'rgba(75, 192, 192)',
                    borderColor: 'rgb(75, 192, 192)',
                    data: [
                        @foreach ($dailyPendapatan as $data)
                            {{ $data->total }},
                        @endforeach
                    ],
                    fill: false
                },
                {
                    label: 'Pengeluaran',
                    backgroundColor: 'rgba(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        @foreach ($dailyPendapatan as $data)
                            {{ $dailyPengeluaran->firstWhere('day', $data->day)->total ?? 0 }},
                        @endforeach
                    ],
                    fill: false
                },
                {
                    label: 'Laba/Rugi',
                    backgroundColor: 'rgba(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: [
                        @foreach ($dailyPendapatan as $data)
                            {{ $data->total - ($dailyPengeluaran->firstWhere('day', $data->day)->total ?? 0) }},
                        @endforeach
                    ],
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection