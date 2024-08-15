@extends('template.layout')

@section('title', 'List Pembelian')

@section('content')
<style>
    .table img {
        width: 70px;
        height: 70px;
        display: block;
        border-radius: 10px;
        
    }
</style>

<div class="card">
    <div class="card-header">
        <h1>Daftar Pembelian Barang</h1>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col" class="text-center">Nama Barang</th>
                        <th scope="col" class="text-center">Harga Beli</th>
                    </tr>
                </thead>
                <tbody>
                @if($products->count()>0)
                    @foreach ($products as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col text-center">
                            <img src="{{asset('storage/' . $data->foto_barang)}}" alt="" style="overflow: hidden;">
                        </td>
                        <td class="col text-center">{{$data->nama_barang}}</td>
                        <td class="col text-center">Rp. {{number_format($data->harga_beli, 0, ',', '.')}}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="10">Data Masih Kosong</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        
        <button class="btn btn-dark">Print</button>
        {{-- {{ $karyawan->onEachSide(2)->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
</div>

@endsection