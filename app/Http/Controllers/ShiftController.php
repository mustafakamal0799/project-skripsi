<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index() 
    {
        $shifts = Shift::all();

        return view('admin.absensi.shift.index', compact('shifts'));
    }

    public function create() 
    {
        return view('admin.absensi.shift.tambah');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nama_shift' => 'required',
            'jam_masuk' => 'nullable',
            'jam_keluar' => 'nullable',
        ]);

        Shift::create([
            'nama_shift' => $request->nama_shift,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ]);

        return redirect('/shift');
    }

    public function edit($id) 
    {
        $shift = Shift::findOrFail($id);

        return view('admin.absensi.shift.edit', compact('shift'));
    }

    public function update(Request $request, $id) 
    {
        $shift = Shift::findOrFail($id);

        $request->validate([
            'nama_shift' => 'required',
            'jam_masuk' => 'nullable',
            'jam_keluar' => 'nullable',
        ]);

        $shift->update([
            'nama_shift' => $request->nama_shift,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ]);

        return redirect('/shift');
    }
}
