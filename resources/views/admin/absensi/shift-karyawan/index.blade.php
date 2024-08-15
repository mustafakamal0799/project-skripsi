@extends('template.layout')

@section('title', 'Shift Karyawan')

@section('content')

<h3 class="text-center">JAM KERJA</h3>
<hr>

<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="/shift-karyawan-create" class="btn btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>Nama Shift</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shiftKaryawan as $shift)
                    <tr>
                        <td>{{ $shift->karyawan->name }}</td>
                        <td>{{ $shift->shift->nama_shift }}</td>
                        <td>{{ $shift->tanggal }}</td>
                        <td>
                            <a href="/shift-karyawan-edit/{{$shift->id}}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="/shift-karyawan-delete/{{$shift->id}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
</div>

@endsection