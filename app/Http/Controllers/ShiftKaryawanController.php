<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\ShiftKaryawan;

class ShiftKaryawanController extends Controller
{
    public function index()
    {
        $shiftKaryawan = ShiftKaryawan::with(['karyawan', 'shift'])->get();
        return view('admin.absensi.shift-karyawan.index', compact('shiftKaryawan'));
    }

    public function create()
    {
        $karyawan = User::where('position_id', 2)->get();
        $jamKerja = Shift::all();
        return view('admin.absensi.shift-karyawan.tambah', compact('karyawan', 'jamKerja'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:users,id',
            'shift_id' => 'required|exists:shifts,id',
            'tanggal' => 'required|date',
        ]);

        ShiftKaryawan::create($request->all());

        return redirect('/shift-karyawan')->with('success', 'Shift Karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $shiftKaryawan = ShiftKaryawan::findOrFail($id);
        $karyawan = User::where('position_id', 2)->get();
        $jamKerja = Shift::all();
        return view('admin.absensi.shift-karyawan.edit', compact('shiftKaryawan', 'karyawan', 'jamKerja'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:users,id',
            'shift_id' => 'required|exists:shifts,id',
            'tanggal' => 'required|date',
        ]);

        $shiftKaryawan = ShiftKaryawan::findOrFail($id);
        $shiftKaryawan->update($request->all());

        return redirect('/shift-karyawan')->with('success', 'Shift Karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $shiftKaryawan = ShiftKaryawan::findOrFail($id);
        $shiftKaryawan->delete();

        return redirect('/shift-karyawan')->with('success', 'Shift Karyawan berhasil dihapus.');
    }
}
