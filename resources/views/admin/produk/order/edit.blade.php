@extends('template.layout')

@section('title', 'Edit Pemesanan Barang')

@section('content')

<div class="title">
    <h1 class="title">Edit Pemesanan Barang</h1>
</div>
<div class="card">
    <div class="card-body">
        <form action="/order-update/{{$order->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="supplier_id">Nama Perusahaan</label>
                <select name="supplier_id" id="supplier_id" class="form-control">
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $order->supplier_id ? 'selected' : '' }}>
                            {{ $supplier->nama_perusahaan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="product_id">Nama Barang</label>
                <select name="product_id" id="product_id" class="form-control">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $order->product_id ? 'selected' : '' }}>
                            {{ $product->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="banyak">Jumlah</label>
                <input type="number" name="banyak" id="banyak" class="form-control" value="{{ $order->banyak }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_order">Tanggal Pemesanan</label>
                <input type="date" name="tanggal_order" id="tanggal_order" class="form-control" value="{{ $order->tanggal_order }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="/order" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
</div>

@endsection
