@extends('template.layout')

@section('title', 'Gaji Karyawan')

@section('content')

<div class="title">
    <h1 class="title">Gaji Karyawan</h1>
</div>
<div class="card">
    <div class="card-header">
        <a href="/gaji-create" class="btn btn-dark">Tambah Data</a>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama Karyawan</th>
                        <th scope="col" class="text-center">Jabatan</th>
                        <th scope="col" class="text-center">Gaji Pokok</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($gaji->count()>0)
                    @foreach ($gaji as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col">{{$data->karyawan->nama}}</td>
                        <td class="col">{{$data->position->name}}</td>
                        <td class="col">Rp. {{number_format($data->gaji_pokok, 0, ',', '.')}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/gaji-edit/{{$data->id}}" class="btn btn-sm">
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
        </div>
    </div>
    <div class="card-footer">
        {{-- {{ $karyawan->onEachSide(2)->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
</div>



@endsection