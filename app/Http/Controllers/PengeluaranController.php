<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index() 
    {
        if (auth()->user()->position_id == 1) 
        {
            $pengeluarans = Pengeluaran::all();
            $totalSeluruh = Pengeluaran::sum('total');
            return view('admin.laporan.pengeluaran.index', compact('pengeluarans', 'totalSeluruh'));

        } else if (auth()->user()->position_id == 2) 
        {
            $user = Auth::user();
            $pengeluarans = Pengeluaran::with('user')->where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();
            $totalSeluruh = Pengeluaran::where('user_id', $user->id)->sum('total');

            return view('karyawan.pengeluaran.index', compact('pengeluarans', 'totalSeluruh'));
        } else 
        {

        }
        
    }

    public function create () 
    {
        if (auth()->user()->position_id == 1){
            
            $users = User::where('position_id', 2)->get();
            return view('admin.laporan.pengeluaran.tambah', compact('users'));

        }else{

            return view('karyawan.pengeluaran.tambah');
        }
        return view('karyawan.pengeluaran.tambah');
    }

    public function store(Request $request) 
    {
        $user = Auth::user();

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
            'keterangan' => 'nullable'
        ]);

        Pengeluaran::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total,
            'keterangan' => $request->keterangan
        ]);

        
        return redirect('/pengeluaran-create')->with('success', 'Pengeluaran Berhasil Ditambahkan');
    }

    public function edit($id) 
    {
        if (auth()->user()->position_id == 1){
            $users = User::all();
            $pengeluarans = Pengeluaran::findOrFail($id);
            return view('admin.laporan.pengeluaran.edit', compact('pengeluarans', 'users'));

        }else{
            $pengeluarans = Pengeluaran::findOrFail($id);
            return view('karyawan.pengeluaran.edit', compact('pengeluarans'));
        }
       

    }

    public function update(Request $request, $id) 
    {
        $pengeluarans = Pengeluaran::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
            'keterangan' => 'nullable'
        ]);

        $pengeluarans->update([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);


        return redirect('/pengeluaran')->with('success', 'Pengeluaran Berhasil Diupdate');
    }

    public function destroy ($id) 
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->delete();
    
       
        return redirect('/pengeluaran')->with('success', 'Pengeluaran Berhasil Dihapus');
    }

    public function cetakPengeluaran(Request $request) 
    {
        $pengeluarans = Pengeluaran::all();
        $totalSeluruh = Pengeluaran::sum('total');

        if($request->get('export') == 'pdf') {
            $pdf = Pdf::loadView('admin.laporan.pengeluaran.pdf.cetak-laporan', [
                'pengeluarans' => $pengeluarans,
            ]);
            return $pdf->download('laporan_pengeluaran.pdf');
        }

        return view('admin.laporan.pengeluaran.cetak-laporan', compact('pengeluarans', 'totalSeluruh'));
    }
}
