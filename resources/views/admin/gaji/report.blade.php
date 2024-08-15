@extends('template.layout')

@section('title', 'Laporan Gaji Karyawan')

@section('content')

<div class="title">
    <h1 class="title">Laporan Gaji Karyawan</h1>
</div>
<div class="card">
    <div class="card-header">
        <a href="/cetak-gaji" class="btn btn-primary" target="blank">Print</a>
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
                        <th scope="col" class="text-center">Bonus</th>
                        <th scope="col" class="text-center">Total Gaji</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($karyawan->count()>0)
                    @foreach ($karyawan as $data)
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col">{{$data->user->name}}</td>
                        <td class="col">{{$data->position->name ?? 'N/A'}}</td>
                        <td class="col">Rp. {{number_format($data->gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                        <td class="col">Rp. {{number_format($data->pendapatan->sum('bonus'), 0, ',', '.')}}</td>
                        <td class="col">Rp. {{number_format($data->totalGaji, 0, ',', '.')}}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/report-gaji-detail/{{$data->id}}" class="btn btn-sm">
                                    <i class="bi bi-info-square-fill" style="color: rgb(0, 204, 255)"> Detail</i>
                                </a>
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