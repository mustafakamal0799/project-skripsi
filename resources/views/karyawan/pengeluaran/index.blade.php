@extends('template.layout')

@section('title', 'Pengeluaran | Karyawan')

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
        <a href="/pengeluaran-create" class="btn btn-dark">Tambah Data</a>
        <button class="btn btn-dark">Print</button>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Keterangan</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($pengeluarans->count()>0)
                    @foreach ($pengeluarans as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col text-center">{{$data->tanggal}}</td>
                        <td class="col">Rp. {{number_format($data->total, 0, ',', '.')}}</td>
                        <td class="col text-center">{{$data->keterangan}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/pengeluaran-edit/{{$data->id}}" class="btn btn-sm">
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i> 
                                </a>
                                <form action="/pengeluaran-delete/ {{$data->id}}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah yakin menghapus data ini')">
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