@extends('template.layout')

@section('title', 'Detail Gaji Karyawan')

@section('content')

<div class="title">
    <h1 class="title">Detail Gaji Karyawan</h1>
</div>
<div class="card">
    <div class="card-header">        
        <a href="/cetak-slip-gaji/{{$karyawan->id}}" target="blank" class="btn btn-success">Print Slip Gaji</a>
    </div>
    <div class="card-body">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nama Karyawan</th>
                        <th scope="col" class="text-center">Jabatan</th>
                        <th scope="col" class="text-center">Gaji Pokok</th>
                        <th scope="col" class="text-center">Total Bonus</th>
                        <th scope="col" class="text-center">Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col">{{$karyawan->user->name}}</td>
                        <td class="col">{{$karyawan->position->name ?? 'N/A'}}</td>
                        <td class="col">Rp. {{ number_format($karyawan->gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                        <td class="col">Rp. {{ number_format($totalBonus, 0, ',', '.') }}</td>
                        <td class="col">Rp. {{ number_format($totalGaji, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>            
        </div>
    </div>
    <div class="card-footer">
        <a href="/report-gaji" class="btn btn-primary">Kembali</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h3>Detail Penjualan</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Produk</th>
                        <th scope="col" class="text-center">Jumlah Terjual</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Bonus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawan->pendapatan as $pendapatan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration}}</td>
                        <td>{{ \Carbon\Carbon::parse($pendapatan->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $pendapatan->product->nama_barang }}</td>
                        <td class="text-center">{{ $pendapatan->terjual }}</td>
                        <td class="text-center">Rp. {{ number_format($pendapatan->total, 0, ',', '.') }}</td>
                        <td class="text-center">Rp. {{ number_format($pendapatan->bonus, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="6">Tidak ada data penjualan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
</div>
@endsection
