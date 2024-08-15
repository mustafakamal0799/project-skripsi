@extends('template.layout')

@section('title', 'Supplier')

@section('content')

<div class="title">
    <h1 class="title">Supplier</h1>
</div>
<div class="card">
    <div class="card-header">
        <a href="/supplier-create" class="btn btn-dark">Tambah Data</a>
        <button class="btn btn-dark">Print</button>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama Perusahaan</th>
                        <th scope="col" class="text-center">Nomor</th>
                        <th scope="col" class="text-center">Alamat</th>
                        <th scope="col" class="text-center">Kota</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($suppliers->count()>0)
                    @foreach ($suppliers as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col">{{$data->nama_perusahaan}}</td>
                        <td class="col">{{$data->phone_number}}</td>
                        <td class="col text-center">{{$data->alamat}}</td>
                        <td class="col text-center">{{$data->kota}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/supplier-edit/{{$data->id}}" class="btn btn-sm">
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i> 
                                </a>
                                <form action="/supplier-delete/ {{$data->id}}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah yakin menghapus data ini')">
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
    </div>
</div>

@endsection