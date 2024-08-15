@extends('template.layout')

@section('title','Karyawan')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h3 class="text-center">DATA KARYAWAN</h3>
<hr>

<div class="card">
    <div class="card-header">
        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#addKaryawan">Tambah Data</button>
        <a href="/cetak-karyawan" target="blank" class="btn btn-dark">PRINT</a>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Jabatan</th>
                        {{-- <th scope="col">Tanggal Lahir</th> --}}
                        <th scope="col" class="text-center">Jenis Kelamin</th>
                        <th scope="col" class="text-center">Email</th>
                        {{-- <th scope="col">Foto</th> --}}
                        {{-- <th scope="col">Alamat</th> --}}
                        <th scope="col" class="text-center">Nomor Handphone</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                {{-- @if($karyawan->count()>0) --}}
                    @foreach ($karyawan as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col">{{$data->nama}}</td>
                        <td class="col text-center">{{$data->position->name}}</td>
                        <td class="col text-center">
                            @if ($data->jenis_kelamin == 'L')
                                Laki - Laki
                            @else
                                Perempuan
                            @endif
                        </td>
                        <td class="col text-center">{{$data->email}}</td>
                        <td class="col text-center">{{$data->hp}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <button class="btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editKaryawan{{$data->id}}">
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i> 
                                </button>
                                    <a href="/karyawan-detail/{{$data->id}}" class="btn btn-sm">
                                        <i class="bi bi-info-square-fill" style="color: rgb(0, 204, 255)"> Detail</i>
                                    </a>
                                <button class="btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#deleteKaryawan{{$data->id}}">
                                    <i class="bi bi-trash-fill" style="color: red"> Delete</i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                {{-- @else
                    <tr>
                        <td class="text-center" colspan="10">Data Masih Kosong</td>
                    </tr>
                @endif --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $karyawan->onEachSide(2)->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

@include('admin.karyawan.include.tambah')

@foreach ($karyawan as $data)
    @include('admin.karyawan.include.edit')
    @include('admin.karyawan.include.hapus')
@endforeach

@endsection