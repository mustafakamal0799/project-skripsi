@extends('template.layout')

@section('title', 'Laporan Tahunan')

@section('content')

<style>
    .btn {
        margin-left: 5px;
    }
</style>

@if(session('message'))
    <div class="alert alert-danger">{{ session('message') }}</div>
@endif
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px">Laporan Tahunan</li>
    </ol>
</nav>



<div class="card">
    <div class="card-header">
        <div class="d-flex">
            <form action="/laporan-tahunan-generate" method="GET" class="d-flex">
                <div class="form-group">
                    <input type="number" name="tahun" id="tahun" class="form-control" value="{{ request('tahun', \Carbon\Carbon::now()->format('Y')) }}">
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
            <a href="/laporan-tahunan-refresh" class="btn btn-success">Refresh</a>              
            <a href="/cetak-laporan-tahunan" target="blank" class="btn btn-dark">Print</a>
            <a href="{{ url('/cetak-laporan-tahunan?export=pdf') }}" class="btn btn-danger">Export PDF</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Tahun</th>
                        <th scope="col" class="text-center">Total Pendapatan</th>
                        <th scope="col" class="text-center">Total Pengeluaran</th>
                        <th scope="col" class="text-center">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if ($laporanTahunan->count() > 0)                        
                    @foreach ($laporanTahunan as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$data->tahun}}</td>                            
                            <td>Rp. {{ number_format($data->total_pendapatan, 0, ',', '.') }}</td>                            
                            <td>Rp. {{ number_format($data->total_pengeluaran, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="basic example">
                                    <a href="/laporan-tahunan-detail/{{$data->id}}" class="btn btn-sm">
                                        <i class="bi bi-info-square-fill" style="color: rgb(0, 204, 255)"> Detail</i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach                        
                    @else
                        <tr>
                            <td class="text-center" colspan="5">Data Masih Kosong</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr class="table-success">
                        <th colspan="2">Total</th>
                        <th>Rp. {{number_format($totalPendapatan, 0, ',', '.')}}</th>
                        <th>Rp. {{number_format($totalPengeluaran, 0, ',', '.')}}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
