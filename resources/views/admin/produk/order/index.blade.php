@extends('template.layout')

@section('title', 'Pemesanan Barang')

@section('content')

<div class="title">
    <h1 class="title">Pemesanan Barang</h1>
</div>
<div class="card">
    <div class="card-header">
        <a href="/order-create" class="btn btn-dark">Tambah Data</a>
        <a href="/order-print" class="btn btn-success" target="blank">Print</a>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama Perusahaan</th>
                        <th scope="col" class="text-center">Nama Barang</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-center">Tanggal Pemesanan</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Total Harga</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $grandTotal = 0;
                @endphp
                @if($orders->count()>0)
                    @foreach ($orders as $data)
                    @php
                        $totalHarga = $data->product->harga_beli * $data->banyak;
                        $grandTotal += $totalHarga;
                    @endphp
                    <tr>
                        <td class="col text-center">{{$loop->iteration}}</td>
                        <td class="col">{{$data->supplier->nama_perusahaan}}</td>
                        <td class="col">{{$data->product->nama_barang}}</td>
                        <td class="col text-center">{{$data->banyak}}</td>
                        <td class="col text-center">{{$data->tanggal_order}}</td>
                        <td class="col text-center">Rp. {{ number_format($data->product->harga_beli, 0, ',', '.') }}</td>
                        <td class="col text-center">Rp. {{ number_format($data->product->harga_beli * $data->banyak, 0, ',', '.') }}</td>
                        <td class="col-3 text-center">
                            <div class="btn-group" role="group" aria-label="basic example">
                                <a href="/order-edit/{{$data->id}}" class="btn btn-sm">
                                    <i class="bi bi-pencil-square" style="color: orange;"> Edit</i> 
                                </a>
                                <form action="/order-delete/ {{$data->id}}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah yakin menghapus data ini')">
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
                    <tr>
                        <td colspan="6" class="text-right"><strong>Total Keseluruhan:</strong></td>
                        <td class="text-center"><strong>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                        <td></td>
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