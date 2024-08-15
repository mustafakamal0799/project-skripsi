<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() 
    {
        $orders = Order::all();
        $suppliers = Supplier::all();
        $products = Product::all();

        
        
        return view('admin.produk.order.index', compact('suppliers', 'products', 'orders'));
    }
    
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        
        return view('admin.produk.order.tambah', compact('suppliers', 'products'));
    }
    
    public function store(Request $request) 
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'banyak' => 'required|integer|min:1',
            'tanggal_order' => 'required|date',
        ]);

        Order::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'banyak' => $request->banyak,
            'tanggal_order' => $request->tanggal_order,
        ]);

        return redirect('/order');
    }

    public function edit($id)
    {
    $order = Order::findOrFail($id);
    $suppliers = Supplier::all();
    $products = Product::all();

    return view('admin.produk.order.edit', compact('order', 'suppliers', 'products'));
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'banyak' => 'required|integer|min:1',
            'tanggal_order' => 'required|date',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'banyak' => $request->banyak,
            'tanggal_order' => $request->tanggal_order,
        ]);

        return redirect('/order')->with('success', 'Pemesanan berhasil diperbarui');
    }

    public function destroy($id) 
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect('/order')->with('success', 'Pemesanan berhasil dihapus');
    }

    public function print()
    {
        $orders = Order::all();
        return view('admin.produk.order.cetak', compact('orders'));
    }
}
