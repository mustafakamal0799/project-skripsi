<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanHarianController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', Carbon::today()->format('Y-m-d'));
        $laporanHarian = LaporanHarian::all();
        $totalPendapatan = LaporanHarian::sum('total_pendapatan');
        $totalPengeluaran = LaporanHarian::sum('total_pengeluaran');

        return view('admin.keuangan.laporanharian.index', compact('laporanHarian', 'tanggal', 'totalPendapatan', 'totalPengeluaran'));
    }

    public function generateLaporanHarian(Request $request) 
    {
        $tanggal = $request->input('tanggal', Carbon::today()->format('Y-m-d'));

        $totalPendapatan = Pendapatan::whereDate('tanggal', $tanggal)->sum('total');
        $totalPengeluaran = Pengeluaran::whereDate('tanggal', $tanggal)->sum('total');

        if ($totalPendapatan == 0 && $totalPengeluaran == 0) {
            return redirect('/laporan-harian')->with('message', 'Data Kosong');
        }

        $produkTerjual = Pendapatan::whereDate('tanggal', $tanggal)
        ->select('product_id', DB::raw('SUM(terjual) as total_terjual'))
        ->groupBy('product_id')->get();

        $produkTerjualData = [];
        foreach ($produkTerjual as $produk) {
            $product = Product::find($produk->product_id);
            $produkTerjualData[$product->nama_barang] = $produk->total_terjual;
        }


        $namaBarang = Pendapatan::with('product')
        ->whereDate('tanggal', $tanggal)
        ->get()
        ->pluck('product.nama_barang')
        ->toArray();

        $keterangan = Pengeluaran::whereDate('tanggal', $tanggal)
            ->pluck('keterangan')
            ->toArray();

        $laporanHarian = LaporanHarian::updateOrCreate(
            ['tanggal' => $tanggal],
            [
            'total_pendapatan' => $totalPendapatan,
            'total_pengeluaran' => $totalPengeluaran,
            'nama_barang' => json_encode($namaBarang),
            'keterangan' => json_encode($keterangan),
            'produk_terjual' => json_encode($produkTerjualData),
            ]
        );

        notify()->success('Laporan Harian Berhasil Diperbarui');
        return redirect('/laporan-harian');
    }

    public function generateSeluruh() 
    {
    LaporanHarian::truncate();
    
    $tanggalPendapatan = Pendapatan::select('tanggal')->distinct()->get();
    
    foreach ($tanggalPendapatan as $date) {
        $tanggal = $date->tanggal;

        $totalPendapatan = Pendapatan::whereDate('tanggal', $tanggal)->sum('total');
        $totalPengeluaran = Pengeluaran::whereDate('tanggal', $tanggal)->sum('total');

        if ($totalPendapatan == 0 && $totalPengeluaran == 0) {
            continue;
        }

        $produkTerjual = Pendapatan::whereDate('tanggal', $tanggal)
            ->select('product_id', DB::raw('SUM(terjual) as total_terjual'))
            ->groupBy('product_id')->get();

        $produkTerjualData = [];
        foreach ($produkTerjual as $produk) {
            $product = Product::find($produk->product_id);
            if ($product) {
                $produkTerjualData[$product->nama_barang] = $produk->total_terjual;
            }
        }

        $keterangan = Pengeluaran::whereDate('tanggal', $tanggal)
            ->pluck('keterangan')
            ->toArray();

        $namaBarang = Pendapatan::with('product')
            ->whereDate('tanggal', $tanggal)
            ->get()
            ->pluck('product.nama_barang')
            ->toArray();

        LaporanHarian::updateOrCreate(
            ['tanggal' => $tanggal],
            [
                'total_pendapatan' => $totalPendapatan,
                'total_pengeluaran' => $totalPengeluaran,
                'nama_barang' => json_encode($namaBarang),
                'produk_terjual' => json_encode($produkTerjualData),
                'keterangan' => json_encode($keterangan),
            ]
        ); 
    }

    notify()->success('Laporan Harian Berhasil Diperbarui');
    return redirect('/laporan-harian');
    }
    
    public function detailL($id) 
    {
        $laporanHarian = LaporanHarian::findOrFail($id);
        $totalPendapatan = LaporanHarian::where('id', $id)->sum('total_pendapatan');
        $totalPengeluaran = LaporanHarian::where('id', $id)->sum('total_pengeluaran');

        return view('admin.keuangan.laporanharian.detail', compact('laporanHarian', 'totalPendapatan', 'totalPengeluaran'));
    }

    public function cetakLaporanHarian (Request $request) 
    {
        $laporanHarian = LaporanHarian::all();
        $totalPendapatan = LaporanHarian::sum('total_pendapatan');
        $totalPengeluaran = LaporanHarian::sum('total_pengeluaran');        

        if($request->get('export') == 'pdf') {
            $pdf = Pdf::loadView('admin.keuangan.laporanharian.pdf.cetak-laporan', [
                'laporanHarian' => $laporanHarian, 
                'totalPendapatan' => $totalPendapatan,
                'totalPengeluaran' => $totalPengeluaran,
            ]);
            return $pdf->download('laporan_harian.pdf');
        }

        return view('admin.keuangan.laporanharian.cetak-laporan', compact('laporanHarian', 'totalPendapatan', 'totalPengeluaran'));
    }
}
