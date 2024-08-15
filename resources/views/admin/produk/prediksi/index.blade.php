@extends('template.layout')

@section('title', 'Prediksi Kebutuhan Stok')

@section('content')

<div class="container">
    <h2 class="text-center">Prediksi Kebutuhan Stok</h2>
    <hr>
    
    <div class="card">
        <div class="card-header">
            <a href="/generatePredectiont" class="btn btn-primary">Generate</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Prediksi Stok (7 Hari Ke Depan)</th>
                        <th>Tanggal Prediksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($predictions as $prediction)
                    <tr>
                        <td>{{ $prediction->product->nama_barang }}</td>
                        <td>{{ $prediction->predicted_stock }}</td>
                        <td>{{ \Carbon\Carbon::parse($prediction->prediction_date)->format('d-m-Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
</div>

@endsection
