<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index () {
        $positions = Position::Paginate(5);

        return view('admin.jabatan.index', compact('positions'));
    }

    public function store (Request $request) {

        $simpan = new Position();
        $simpan->name = $request->input('name');
        $simpan->save();

        return redirect('/jabatan')->with('success', 'Data Berhasil Disimpan');
        
    }

    public function edit(String $id) {
        $positions = Position::findOrFail($id);

        return view('/jabatan-edit', compact('positions'));
    }

    public function update(Request $request,String $id) {
        $update = Position::findOrFail($id);
        
        $update->name = $request->input('name');

        $update->update();

        return redirect('/jabatan')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy (String $id) {
        $hapus = Position::findOrFail($id);

        $hapus->delete();
        
        return redirect('/jabatan')->with('error', 'Data berhasil dihapus');
    }
}
