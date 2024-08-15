@extends('template.layout')

@section('title', 'Form Pemesanan Barang')

@section('content')

<div class="container">
    <h2>Form Pemesanan Barang</h2>
    
    <form action="/order-store" method="POST">
        @csrf

        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <select class="form-select" id="supplier" name="supplier_id" required>
                <option value="" disabled selected>Pilih Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product" class="form-label">Produk</label>
            <select class="form-select" id="product" name="product_id" required>
                <option value="" disabled selected>Pilih Produk</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="banyak" class="form-label">Jumlah Pesanan/Pack</label>
            <input type="number" class="form-control" id="banyak" name="banyak" min="1" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_order" class="form-label">Tanggal Pemesanan</label>
            <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
    </form>
</div>

@endsection
