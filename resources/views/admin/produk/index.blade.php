@extends('template.layout')

@section('title', 'Produk')

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
        <a href="/product-create" class="btn btn-dark">Tambah Data</a>
        <a href="/cetak-product" class="btn btn-primary" target="blank">Print</a>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col" class="text-center">Nama Barang</th>
                        <th scope="col" class="text-center">Kode Barang</th>
                        <th scope="col" class="text-center">Stok Barang</th>
                        <th scope="col" class="text-center">Harga Beli</th>
                        <th scope="col" class="text-center">Harga Jual</th>
                        <th scope="col" class="text-center">Action</th>
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
                        <td class="col">{{$data->nama_barang}}</td>
                        <td class="col text-center">{{$data->kode_barang}}</td>
                        <td class="col text-center">{{$data->stok_barang}}</td>
                        <td class="col">Rp. {{number_format($data->harga_beli, 0, ',', '.')}}</td>
                        <td class="col">Rp. {{number_format($data->harga_jual, 0, ',', '.')}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/product-edit/{{$data->id}}" class="btn btn-sm">
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i> 
                                </a>
                                <form action="/product-delete/ {{$data->id}}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah yakin menghapus data ini')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="bi bi-trash-fill" style="color: red"> Delete</i>
                                    </button>
                                </form>
                            </div>
                        </td>
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
        {{-- {{ $karyawan->onEachSide(2)->links('vendor.pagination.bootstrap-5') }} --}}
        <a href="/list-pembelian" class="btn btn-dark">List Pembelian Barang</a>
    </div>
</div>

@endsection