<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendSmsController;

class PendapatanController extends Controller
{
    public function index() 
    {
        if (auth()->user()->position_id == 1){

            $pendapatan = Pendapatan::with('product', 'user')->get();
            $totalSeluruh = Pendapatan::sum('total');
            return view('admin.laporan.pendapatan.index', compact('pendapatan', 'totalSeluruh'));

        }else{
            
            $user = Auth::user();

            $pendapatan = Pendapatan::with('product')->where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();
            $totalSeluruh = Pendapatan::where('user_id', $user->id)->sum('total');
            return view('karyawan.pendapatan.index', compact('pendapatan','totalSeluruh'));
        }
    }

    public function create() 
    {
        if (auth()->user()->position_id == 1){
            $pendapatan = Pendapatan::with('product')->get();
            $users = User::where('position_id', 2)->get();
            $products = Product::all();
            return view('admin.laporan.pendapatan.tambah', compact('pendapatan', 'products', 'users'));
        }
        else{
            $pendapatan = Pendapatan::with('product')->get();
            $products = Product::all();
            return view('karyawan.pendapatan.tambah', compact('pendapatan', 'products'));
        }
    }

    public function store(Request $request) 
    {
        $user = Auth::user();

        $product = Product::find($request->product_id);        

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'tanggal' => 'required|date',
            'terjual' => 'required|integer',
            'jenis_penjualan' => $product->kode_barang == 'KRT001' || $product->kode_barang == 'KRT002' || $product->kode_barang == 'KRT003' ? 'required|string' : 'nullable|string',
        ]);

        $product = Product::find($request->product_id);
        $harga_awal = $product->harga_jual;

            if ($request->has('jenis_penjualan')) {
                switch ($request->jenis_penjualan) {
                    case 'hitam_putih':
                        $harga = $harga_awal;
                        break;
                    case 'warna':
                        $harga = $harga_awal + 500;
                        break;
                    case 'satuan':
                        $harga = $harga_awal - 250;
                        break;
                    default:
                        $harga = $harga_awal;
                        break;
                }
            } else {
                $harga = $harga_awal;
            }

            $total = $harga * $request->terjual;
            $bonus = $total * 0.05;


            Pendapatan::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'tanggal' => $request->tanggal,
                'terjual' => $request->terjual,
                'total' => $total,
                'jenis_penjualan' => $request->jenis_penjualan,
                'bonus' => $bonus,
            ]);

            $product->stok_barang -= $request->terjual;
            $product->save();

            if ($product->stok_barang <= $product->minimal_barang) {
                $sendMassageController = new SendSmsController();
                $sendMassageController->sendsms($product->nama_barang, $product->stok_barang);
            }

        notify()->success('Laporan Penjualan Berhasil Ditambahkan');
        return redirect('/pendapatan-create');
    }

    public function edit($id)
    {
        if (auth()->user()->position_id == 1)
        {
            $users = User::all();
            $pendapatan = Pendapatan::findOrFail($id);
            $products = Product::all();

            return view('admin.laporan.pendapatan.edit', compact('pendapatan', 'products', 'users'));
        }else{
            
            $pendapatan = Pendapatan::findOrFail($id);
            $products = Product::all();

            return view('karyawan.pendapatan.edit', compact('pendapatan', 'products'));
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        $pendapatan = Pendapatan::findOrFail($id);
        $product = Product::find($request->product_id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'tanggal' => 'required|date',
            'terjual' => 'required|integer',
            'jenis_penjualan' => in_array($product->kode_barang, ['KRT001', 'KRT002', 'KRT003']) ? 'required|string' : 'nullable|string',
        ]);

        $harga_awal = $product->harga_jual;

        if ($request->has('jenis_penjualan')) {
            switch ($request->jenis_penjualan) {
                case 'hitam_putih':
                    $harga = $harga_awal;
                    break;
                case 'warna':
                    $harga = $harga_awal + 500;
                    break;
                case 'satuan':
                    $harga = $harga_awal - 250;
                    break;
                default:
                    $harga = $harga_awal;
                    break;
            }
        } else {
            $harga = $harga_awal;
        }

        $total = $harga * $request->terjual;
        $bonus = $total * 0.05;

        
        $terjual_sebelumnya = $pendapatan->terjual;
        $perbedaan_terjual = $request->terjual - $terjual_sebelumnya;

        $product->stok_barang -= $perbedaan_terjual;
        $product->save();

        $pendapatan->update([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'tanggal' => $request->tanggal,
            'terjual' => $request->terjual,
            'total' => $total,
            'jenis_penjualan' => $request->jenis_penjualan,
            'bonus' => $bonus,
        ]);

        if ($product->stok_barang <= $product->minimal_barang) {
            $sendMassageController = new SendSmsController();
            $sendMassageController->sendsms($product->nama_barang, $product->stok_barang);
        }

        notify()->success('Laporan Penjualan Berhasil Diperbarui');
        return redirect('/pendapatan');
    }

    public function destroy($id)
    {
        $pendapatan = Pendapatan::findOrFail($id);

        // Kembalikan stok barang sebelum menghapus laporan penjualan
        $product = Product::find($pendapatan->product_id);
        $product->stok_barang += $pendapatan->terjual;
        $product->save();

        $pendapatan->delete();

        notify()->success('Laporan Penjualan Berhasil Dihapus');
        return redirect('/pendapatan');
    }

    public function cetakPendapatan(Request $request)
    {
        $pendapatan = Pendapatan::with('product', 'user')->get();
        $totalSeluruh = Pendapatan::sum('total');

        if($request->get('export') == 'pdf') {
            $pdf = Pdf::loadView('admin.laporan.pendapatan.pdf.cetak-laporan', [
                'pendapatan' => $pendapatan,
            ]);
            return $pdf->download('laporan_pendapatan.pdf');
        }

        return view('admin.laporan.pendapatan.cetak-laporan', compact('pendapatan', 'totalSeluruh'));
    }
}

