@extends('template.layout')

@section('title', 'Dashboard')

@section('content')

<style>
    .bi{
        font-size: 100px;
        margin-right: 20px;
    }
</style>

<div class="row">
    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill border-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="p-3 m-1">
                            <h2 class="mb-2">
                                Pendapatan
                            </h2>
                            <h6 class="mb-2">
                                Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </h6>
                            <div class="mb-0">
                                <span class="badge text-success me-2">
                                    {{ \Carbon\Carbon::parse($tanggal)->format('F Y')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 align-self-end text-end">
                        <i class="bi bi-arrow-up-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill border-1">
            <div class="card-body">
                <div class="row g-0 w-100">
                    <div class="col-6">
                        <div class="p-3 m-1">
                            <h2 class="mb-2">
                                Pengeluaran
                            </h2>
                            <h6 class="mb-2">
                                Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}
                            </h6>
                            <div class="mb-0">
                                <span class="badge text-success me-2">
                                    {{ \Carbon\Carbon::parse($tanggal)->format('F Y')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 align-self-end text-end">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <canvas id="profitLossChart" width="400" height="200"></canvas>
            </div>    
        </div>
    </div>
    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                
            </div>    
        </div>
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