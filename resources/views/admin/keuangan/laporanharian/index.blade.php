@extends('template.layout')

@section('title', 'Laporan Harian')

@section('content')

<style>
    .title {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .text-center ul li {
        list-style-type: lower-angka;
    }
    .button {
        margin-left: 5px;
    }

    .search {
        display: flex;
        justify-content: end;
    }

    .btn {
        margin-left: 5px;
    }
</style>
@if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px">Laporan Harian</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <div class="d-flex">
                    <form action="/generate-laporan-harian" class="d-flex">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="date" name="tanggal" id="tanggal" value="{{old('tanggal', $tanggal)}}">
                        </div>                    
                            <button class="btn btn-primary">Tambah
                            </button>
                    </form>
                    <a href="/generate-laporan-seluruh" class="btn btn-success">Refresh
                    </a>                    
                    <a href="/cetak-laporan" target="blank" class="btn btn-dark">Print</a>                    
                    <a href="{{ url('/cetak-laporan?export=pdf') }}" class="btn btn-danger">Export PDF</a>                    
                </div>
            </div>
            <div class="col-4">
                <div class="search">
                    {{-- <form action="/laporan-harian" method="GET" class="d-flex">
                        @csrf
                        <div class="form-group">
                            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $tanggal) }}" class="form-control" required>
                        </div>
                        <div class="button">
                            <button type="submit" class="btn btn-dark">Cari</button>
                        </div>                    
                    </form> --}}
                </div>
            </div>
        </div>    
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Total Pendapatan</th>
                        <th scope="col" class="text-center">Total Pengeluaran</th>
                        <th scope="col" class="text-center">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if ($laporanHarian->count() > 0)                        
                    @foreach ($laporanHarian as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</td>                            
                            <td>Rp. {{ number_format($data->total_pendapatan, 0, ',', '.') }}</td>                            
                            <td>Rp. {{ number_format($data->total_pengeluaran, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="basic example">
                                    <a href="/laporan-detailL/{{$data->id}}" class="btn btn-sm">
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
