@extends('template.layout')

@section('title', 'Jabatan')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('error') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<h3 class="text-center">JABATAN</h3>
<hr>

<div class="card">
    <div class="card-header">
        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#addJabatan">Tambah Data</button>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama Jabatan</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $data)
                    <tr>
                        <td class="col-1 text-center">{{$loop->iteration}}</td>
                        <td class="col-7">{{$data->name}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <button class="btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editJabatan{{$data->id}}">
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i>
                                </button>
                                <button class="btn btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#delete{{$data->id}}">
                                    <i class="bi bi-trash-fill" style="color: red;"> Delete</i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $positions->onEachSide(2)->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

@include('admin.jabatan.include.tambah')
@foreach ($positions as $data)
@include('admin.jabatan.include.edit')
@include('admin.jabatan.include.hapus')
@endforeach


@endsection