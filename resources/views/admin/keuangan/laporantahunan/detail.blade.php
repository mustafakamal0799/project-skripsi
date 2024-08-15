@extends('template.layout')

@section('title', 'Detail Laporan Tahunan')

@section('content')

<style>
    .title {
        font-size: 20px;
        margin-bottom: 10px;
    }
    .card-header {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .card-body {
        margin-bottom: 20px;
    }
</style>

<div class="title">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="font-size: 20px"><a href="/laporan-tahunan">Laporan Tahunan</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px">Detail Laporan</li>
        </ol>
    </nav>


@if($laporanTahunan->count() > 0)
        <div class="card mb-3">
            <div class="card-header">
                <h3>Tahun : {{$laporanTahunan->tahun}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <strong>Nama Barang Terjual:</strong>
                            <ul>
                                @foreach(json_decode($laporanTahunan->produk_terjual, true) as $namaBarang => $jumlahTerjual)
                                    <li>{{ $namaBarang }} : {{ $jumlahTerjual}}</li>
                                @endforeach                                
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                            <strong>Keterangan Pengeluaran:</strong>
                            <ul>
                                @foreach(json_decode($laporanTahunan->keterangan, true) as $keterangan)
                                    <li>{{ $keterangan }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            
                <div class="mb-2">
                    <strong>Total Pendapatan:</strong>
                    <p>Rp. {{ number_format($laporanTahunan->total_pendapatan, 0, ',', '.') }}</p>
                </div>
                
                <div>
                    <strong>Total Pengeluaran:</strong>
                    <p>Rp. {{ number_format($laporanTahunan->total_pengeluaran, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
@else
    <div class="alert alert-warning" role="alert">
        Data Masih Kosong
    </div>
@endif
@endsection
