<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index () 
    {
        $products = Product::all();
        return view('admin.produk.index', compact('products'));
    }

    public function create() 
    {
        return view('admin.produk.tambah');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama_barang' => 'required|string',
        //     'kode_barang' => 'required|string',
        //     'stok_barang' => 'required|integer',
        //     'minimal_barang' => 'nullable|integer',
        //     'harga_jual' => 'required|numeric',
        //     'harga_beli' => 'required|numeric',
        //     'foto_barang' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $stok_barang = $request->input('isi') * $request->input('stok');

        $products = new Product();
        $products->nama_barang = $request->nama_barang;
        $products->kode_barang = $request->kode_barang;
        $products->stok_barang = $stok_barang;
        $products->minimal_barang = $request->minimal_barang;
        $products->harga_jual = $request->harga_jual;
        $products->harga_beli = $request->harga_beli;

        if ($request->hasFile('foto_barang')) {
            $image = $request->file('foto_barang');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public', $filename);

            $products->foto_barang = $path;
        }

        $products->save();

        notify()->success('Produk Berhasil Ditambahkan');
        return redirect('/product-create');
    }

    public function edit($id) 
    {
        $products = Product::findOrFail($id);

        return view('admin.produk.edit', compact('products'));
    }

    public function update(Request $request, $id) 
    {
        $products = Product::findOrFail($id);
        $products->nama_barang = $request->nama_barang;
        $products->stok_barang = $request->stok_barang;
        $products->minimal_barang = $request->minimal_barang;
        $products->harga_jual = $request->harga_jual;
        $products->harga_beli = $request->harga_beli;

        if ($request->hasFile('foto_barang')) {
            if ($products->foto_barang && Storage::exists($products->foto_barang)) {
                Storage::delete($products->foto_barang);
            }
            $products->foto_barang = $request->file('foto_barang')->store('public');
        }

        $products->update();

        app(SendSmsController::class)->sendsms();

        notify()->success('Produk berhasil diupdate');
        return redirect('/product');
    }

    public function destroy($id) 
    {
            $products = Product::findOrFail($id);
    
            if ($products->foto_barang && Storage::exists($products->foto_barang)) {
                Storage::delete($products->foto_barang);
            }
    
            $products->delete();
            
            notify()->success('Data berhasil dihapus ⚡️', 'My custom title');
            return redirect('/product');
        }

    public function listPembelian () {

        $products = Product::whereColumn('stok_barang', '<=', 'minimal_barang')->get();
        return view('admin.produk.listbeli', compact('products'));
    }

    public function cetakProduct() 
    {
        $products = Product::all();
        return view('admin.produk.cetak', compact('products'));
    }
}
