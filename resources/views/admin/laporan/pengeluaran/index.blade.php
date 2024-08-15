@extends('template.layout')

@section('title', 'Pengeluaran | Admin')

@section('content')

<h3 class="text-center">PENGELUARAN</h3>
<hr>

<div class="card">
    <div class="card-header">
        <a href="/pengeluaran-create" class="btn btn-dark">Tambah Data</a>
        <a href="/cetak-pengeluaran" target="blank" class="btn btn-primary">Print Data</a>
        <a href="{{ url('/cetak-pengeluaran?export=pdf') }}" class="btn btn-danger">Export PDF</a> 
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama Karyawan</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Keterangan</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($pengeluarans->count()>0)
                    @foreach ($pengeluarans as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col">{{$data->user->name}}</td>
                        <td class="col text-center">{{$data->tanggal}}</td>
                        <td class="col text-center">{{$data->keterangan}}</td>
                        <td class="col">Rp. {{number_format($data->total, 0, ',', '.')}}</td>
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
                <tfoot>
                    <tr class="table">
                        <th colspan="4">Total Keseluruhan</th>
                        <th>Rp. {{number_format($totalSeluruh, 0, ',', '.')}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{-- {{ $karyawan->onEachSide(2)->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
</div>

@endsection