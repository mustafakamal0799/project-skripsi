@extends('template.layout')

@section('title', 'Edit Pendapatan | Karyawan')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="title text-center" style="font-size: 30px;">Edit Pendapatan</h3>
    </div>
    <form action="/pendapatan-update/{{ $pendapatan->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <input type="hidden" name="user_id" value="{{ $pendapatan->user_id }}">
            <div class="form-group mt-2">
                <label for="product_id">Produk</label>
                <select name="product_id" id="product_id" class="form-control">
                        <option value="">Pilih Barang</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-kode="{{ $product->kode_barang }}" {{ $product->id == $pendapatan->product_id ? 'selected' : '' }}>
                            {{ $product->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $pendapatan->tanggal }}">
            </div>
            <div class="form-group mt-2">
                <label for="terjual">Jumlah Terjual</label>
                <input type="number" name="terjual" id="terjual" class="form-control" value="{{ $pendapatan->terjual }}">
            </div>
            <div class="form-group mt-2" id="jenis_penjualan_group">
                <label for="jenis_penjualan">Jenis Penjualan</label>
                <select name="jenis_penjualan" id="jenis_penjualan" class="form-control">
                    <option value="">Pilih Jenis Penjualan</option>
                    <option value="hitam_putih" {{ $pendapatan->jenis_penjualan == 'hitam_putih' ? 'selected' : '' }}>Hitam Putih</option>
                    <option value="warna" {{ $pendapatan->jenis_penjualan == 'warna' ? 'selected' : '' }}>Warna</option>
                    <option value="satuan" {{ $pendapatan->jenis_penjualan == 'satuan' ? 'selected' : '' }}>Satuan</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">update</button>
            <a href="/pendapatan" class="btn btn-outline-danger">Batal</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
        $(document).ready(function() {
            var productsWithJenis = ['KRT001', 'KRT002', 'KRT003']; // Ganti dengan kode barang yang sesuai

            $('#product_id').change(function() {
                var selectedKode = $(this).find(':selected').data('kode');

                if (productsWithJenis.includes(selectedKode)) {
                    $('#jenis_penjualan_group').show();
                } else {
                    $('#jenis_penjualan_group').hide();
                    $('#jenis_penjualan').val(''); // Hapus nilai jenis penjualan jika disembunyikan
                }
            });

            // Trigger perubahan saat halaman dimuat untuk menyembunyikan jika perlu
            $('#product_id').trigger('change');
        });
</script>
@endsection
