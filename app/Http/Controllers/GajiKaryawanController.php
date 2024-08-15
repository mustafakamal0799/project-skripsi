<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Position;
use App\Models\Pendapatan;
use App\Models\GajiKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GajiKaryawanController extends Controller
{
    public function index () 
    {
        $gaji = GajiKaryawan::with('karyawan', 'position')->get();
        return view('admin.gaji.index', compact('gaji'));
    }

    public function create () 
    {
        $karyawans = Karyawan::where('position_id', 2)->get();
        $positions = Position::all();
        $gaji = GajiKaryawan::with('karyawan', 'position')->get();
        return view('admin.gaji.tambah', compact('karyawans', 'positions', 'gaji'));
    }

    
    public function store (Request $request) 
    {
        $request->validate([
            'karyawan_id' => 'required',
            'position_id' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        GajiKaryawan::create([
            'karyawan_id' => $request->karyawan_id,
            'position_id' => $request->position_id,
            'gaji_pokok' => $request->gaji_pokok,
        ]);

        return redirect('/gaji')->with('success', 'Gaji Berhasil Ditambahkan');
    }

    public function edit($id) 
    {
        $gaji = GajiKaryawan::findOrFail($id);
        $karyawans = Karyawan::all();
        $positions = Position::all();
        return view('admin.gaji.edit', compact('gaji', 'karyawans', 'positions'));
    }

    public function update(Request $request, $id) 
    {
        $gaji = GajiKaryawan::findOrFail($id);
        
        $request->validate([
            'karyawan_id' => 'required',
            'position_id' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        $gaji->update([
            'karyawan_id' => $request->karyawan_id,
            'position_id' => $request->position_id,
            'gaji_pokok' => $request->gaji_pokok,
        ]);
        
        
        Session::flash('success','Item created successfully.');
        return redirect('/gaji');

        
    }

    public function reportGaji () 
    {
        $karyawan = Karyawan::whereHas('gaji', function($query) {
            $query->where('position_id', 2);
        })->with('user', 'gaji', 'pendapatan', 'position')->get();

        foreach ($karyawan as $data) {
            $totalBonus = $data->pendapatan->sum('bonus');
            $gajiPokok = $data->gaji->gaji_pokok;

            // Pastikan $gajiPokok adalah nilai numerik sebelum perkalian
            $data->totalGaji = $gajiPokok !== null ? $totalBonus + $gajiPokok : 0;
        }

        
        return view('admin.gaji.report', compact('karyawan'));
    }

    public function showDetail($id)
    {
        $user = Auth::user();
        $karyawan = Karyawan::with('user', 'gaji', 'pendapatan', 'position')
            ->where('id', $id)
            ->firstOrFail();

        // Menghitung total bonus
        $totalBonus = $karyawan->pendapatan->sum('bonus');
        // Gaji pokok untuk karyawan
        $gajiPokok = $karyawan->gaji->gaji_pokok;
        $totalGaji = $gajiPokok !== null ? $totalBonus + $gajiPokok : 0;

        return view('admin.gaji.showreport', compact('karyawan', 'totalBonus', 'totalGaji'));
    }

    public function cetakSlipGaji($id) 
    {
        $karyawan = Karyawan::with('user', 'gaji', 'pendapatan', 'position')
            ->where('id', $id)
            ->firstOrFail();

        // Menghitung total bonus
        $totalBonus = $karyawan->pendapatan->sum('bonus');
        // Gaji pokok untuk karyawan
        $gajiPokok = $karyawan->gaji->gaji_pokok;
        $totalGaji = $gajiPokok !== null ? $totalBonus + $gajiPokok : 0;

        $userWithPositionId3 = User::where('position_id', 3)->first();
        $penandatangan = $userWithPositionId3 ? $userWithPositionId3->name : 'Nama Tidak Ditemukan';

        return view('admin.gaji.cetak-slip-gaji', compact('karyawan', 'totalBonus', 'totalGaji', 'penandatangan'));
    }

    public function cetakGaji ()
    {
        $karyawan = Karyawan::whereHas('gaji', function($query) {
            $query->where('position_id', 2);
        })->with('user', 'gaji', 'pendapatan', 'position')->get();

        foreach ($karyawan as $data) {
            $totalBonus = $data->pendapatan->sum('bonus');
            $gajiPokok = $data->gaji->gaji_pokok;

            // Pastikan $gajiPokok adalah nilai numerik sebelum perkalian
            $data->totalGaji = $gajiPokok !== null ? $totalBonus + $gajiPokok : 0;
        }

        
        return view('admin.gaji.cetak-laporan', compact('karyawan'));
    }
}
