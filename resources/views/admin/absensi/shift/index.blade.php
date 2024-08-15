@extends('template.layout')

@section('title', 'Shift Kerja')

@section('content')

<h3 class="text-center">SHIFT KERJA</h3>
<hr>

<div class="card">
    <div class="card-header">
        <a href="/shift-create" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Keluar</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shifts as $data)
                    <tr>
                        <td class="col-1 text-center">{{$loop->iteration}}</td>
                        <td>{{$data->nama_shift}}</td>
                        <td>{{$data->jam_masuk}}</td>
                        <td>{{$data->jam_keluar}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/shift-edit/{{$data->id}}" class="btn btn-sm"> 
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i>
                                </a>
                                <a href="/shift-delete/{{$data->id}}" class="btn btn-sm"> 
                                    <i class="bi bi-trash-fill" style="color: red;"> Delete</i>
                                </a>                                    
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection