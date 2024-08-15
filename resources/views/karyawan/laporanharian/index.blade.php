@extends('template.layout')

@section('title', 'Jabatan')

@section('content')

@if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
@endif
<div class="card border-0">
    <div class="card-header">
        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#addLaporan">Tambah Data</button>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Pendapatan</th>
                    <th scope="col">Pengeluaran</th>
                    <th scope="col">Total</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($laporan->count()>0)
                    @foreach ($laporan as $data)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td class="col-3">{{$data->tanggal}}</td>
                            <td>Rp. {{number_format($data->pendapatan, 0, ',', '.')}}</td>
                            <td>Rp. {{number_format($data->pengeluaran, 0 , ',','.',) }}</td>
                            <td>Rp. {{number_format($data->total, 0, ',', '.')}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="basic example">
                                    <a href="" class="btn">
                                        <i class="bi bi-pencil-square" style="color: orange;"></i>
                                    </a>
                                    <form action="" method="POST" onsubmit="return confirm('Apakah yakin menghapus data ini')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn">
                                        <i class="fa fa-trash-alt" style="color: red;"></i>
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
                {{-- @if (Auth::check())
                    @if (count($laporan) > 0)
                        @if (Auth::user()->id != $laporan[0]->user_id)
                            -
                        @else --}}
                            <tr>
                                <th>Total Seluruh</th>
                                <td></td>
                                <td>Rp. {{number_format($totalPendapatan, 0, ',','.')}}</td>
                                <td>Rp. {{number_format($totalPengeluaran, 0, ',','.')}}</td>
                                <td>Rp. {{number_format($totalSemua, 0, ',','.')}}</td>
                                <td></td>
                            </tr>
                        {{-- @endif
                    @endif
                @endif --}}
            </tfoot>
        </table>
    </div>
</div>

@include('karyawan.laporanharian.include.tambah')

@endsection