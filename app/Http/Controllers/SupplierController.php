<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index () 
    {
        $suppliers = Supplier::all();

        return view('admin.produk.supplier.index', compact('suppliers'));
    }

    public function create() 
    {
        return view('admin.produk.supplier.tambah');
    }

    public function store (Request $request) 
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'phone_number' => 'nullable',
            'alamat' => 'required',
            'kota' => 'required',
        ]);

        Supplier::create([
            'nama_perusahaan' => $request->input('nama_perusahaan'),
            'phone_number' => $request->input('phone_number'),
            'alamat' => $request->input('alamat'),
            'kota' => $request->input('kota'),
        ]);

        return redirect('/supplier');
    }

    public function edit($id)
    {
        $suppliers = Supplier::findOrFail($id);
        return view('admin.produk.supplier.edit', compact('suppliers'));
    }

    public function update(Request $request, $id) 
    {
        $suppliers = Supplier::findOrFail($id);
        $suppliers->nama_perusahaan = $request->nama_perusahaan;
        $suppliers->phone_number = $request->phone_number;
        $suppliers->alamat = $request->alamat;
        $suppliers->kota = $request->kota;

        $suppliers->update();

        return redirect('/supplier');
    }

    public function destroy ($id)
    {
        $suppliers = Supplier::findOrFail($id);

        $suppliers->delete();

        return redirect('/supplier');
    }
}
