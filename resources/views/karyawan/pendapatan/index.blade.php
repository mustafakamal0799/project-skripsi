@extends('template.layout')

@section('title', 'Pendapatan Karyawan')

@section('content')

<style>
    .title {
        font-size: 30px;
        margin-bottom: 20px;
    }
</style>

<div class="title">
    <h1 class="title">Pendapatan</h1>
</div>
<div class="card">
    <div class="card-header">
        <a href="/pendapatan-create" class="btn btn-dark">Tambah Data</a>
        <button class="btn btn-dark">Print</button>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama Barang</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Terjual</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Jenis Penjualan</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($pendapatan->count()>0)
                    @foreach ($pendapatan as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col">{{$data->product->nama_barang}}</td>
                        <td class="col text-center">{{$data->tanggal}}</td>
                        <td class="col text-center">{{$data->terjual}}</td>
                        <td class="col">Rp. {{number_format($data->total, 0, ',', '.')}}</td>
                        <td class="col text-center">{{$data->jenis_penjualan}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/pendapatan-edit/{{$data->id}}" class="btn btn-sm">
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i> 
                                </a>
                                <form action="/pendapatan-delete/ {{$data->id}}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah yakin menghapus data ini')">
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

            <div>
                @if (Auth::check())
                    <h1>Pendapatan Seluruh : Rp. {{number_format($totalSeluruh, 0, ',', '.')}}</h1>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        {{-- {{ $karyawan->onEachSide(2)->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
</div>

@endsection