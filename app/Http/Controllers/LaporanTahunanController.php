<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\LaporanTahunan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanTahunanController extends Controller
{
    public function index (Request $request) {
        
        $tahun = $request->input('tahun', Carbon::now()->format('Y'));
        $laporanTahunan = LaporanTahunan::all();
        $totalPendapatan = $laporanTahunan->sum('total_pendapatan');
        $totalPengeluaran = $laporanTahunan->sum('total_pengeluaran');

        return view('admin.keuangan.laporantahunan.index', compact('laporanTahunan', 'totalPendapatan', 'tahun', 'totalPengeluaran'));

    }

    public function generateLaporanTahunan (Request $request) {

        $tahun = $request->input('tahun', Carbon::now()->format('Y'));

        $pendapatanTahun = Pendapatan::whereYear('tanggal', $tahun)->get();
        $pengeluaranTahun = Pengeluaran::whereYear('tanggal', $tahun)->get();

        if ($pendapatanTahun->isEmpty() && $pengeluaranTahun->isEmpty()) {
            return redirect('/laporan-tahunan')->with('message', 'Data Kosong');
        }

        $totalPendapatan = $pendapatanTahun->sum('total');
        $totalPengeluaran = $pengeluaranTahun->sum('total');

        $produkTerjual = Pendapatan::whereYear('tanggal', $tahun)
            ->select('product_id', DB::raw('SUM(terjual) as total_terjual'))
            ->groupBy('product_id')->get();

        $produkTerjualData = [];
        foreach ($produkTerjual as $produk) {
            $product = Product::find($produk->product_id);
            if ($product) {
                $produkTerjualData[$product->nama_barang] = $produk->total_terjual;
            }
        }

        $keterangan = Pengeluaran::whereYear('tanggal', $tahun)
            ->pluck('keterangan')
            ->toArray();

        $namaBarang = Pendapatan::with('product')
            ->whereYear('tanggal', $tahun)
            ->get()
            ->pluck('product.nama_barang')
            ->toArray();

        LaporanTahunan::updateOrCreate(
            ['tahun' => $tahun],
            [
                'total_pendapatan' => $totalPendapatan,
                'total_pengeluaran' => $totalPengeluaran,
                'nama_barang' => json_encode($namaBarang),
                'produk_terjual' => json_encode($produkTerjualData),
                'keterangan' => json_encode($keterangan),
            ]
        );

        notify()->success('Laporan Tahunan Berhasil Diperbarui');
        return redirect('/laporan-tahunan');
    }

    public function refresh() {

    LaporanTahunan::truncate();

    $tahunPendapatan = Pendapatan::select(DB::raw('YEAR(tanggal) as tahun'))->distinct()->get();

    foreach ($tahunPendapatan as $date) {
        $tahun = $date->tahun;

        $totalPendapatan = Pendapatan::whereYear('tanggal', $tahun)->sum('total');
        $totalPengeluaran = Pengeluaran::whereYear('tanggal', $tahun)->sum('total');

        if ($totalPendapatan == 0 && $totalPengeluaran == 0) {
            continue;
        }

        $produkTerjual = Pendapatan::whereYear('tanggal', $tahun)
            ->select('product_id', DB::raw('SUM(terjual) as total_terjual'))
            ->groupBy('product_id')->get();

        $produkTerjualData = [];
        foreach ($produkTerjual as $produk) {
            $product = Product::find($produk->product_id);
            if ($product) {
                $produkTerjualData[$product->nama_barang] = $produk->total_terjual;
            }
        }

        $keterangan = Pengeluaran::whereYear('tanggal', $tahun)
            ->pluck('keterangan')
            ->toArray();

        $namaBarang = Pendapatan::with('product')
            ->whereYear('tanggal', $tahun)
            ->get()
            ->pluck('product.nama_barang')
            ->toArray();

        LaporanTahunan::updateOrCreate(
            ['tahun' => $tahun],
            [
                'total_pendapatan' => $totalPendapatan,
                'total_pengeluaran' => $totalPengeluaran,
                'nama_barang' => json_encode($namaBarang),
                'produk_terjual' => json_encode($produkTerjualData),
                'keterangan' => json_encode($keterangan),
            ]
        );
    }

    notify()->success('Laporan Tahunan Berhasil Diperbarui');
    return redirect('/laporan-tahunan');

    }

    public function detail($id) {

        $laporanTahunan = LaporanTahunan::findOrFail($id);
        $totalPendapatan = $laporanTahunan->sum('total_pendapatan');
        $totalPengeluaran = $laporanTahunan->sum('total_pengeluaran');

        return view('admin.keuangan.laporantahunan.detail', compact('laporanTahunan', 'totalPendapatan', 'totalPengeluaran'));
    }

    public function cetakLaporanTahunan(Request $request) {

        $laporanTahunan = LaporanTahunan::all();
        $totalPendapatan = $laporanTahunan->sum('total_pendapatan');
        $totalPengeluaran = $laporanTahunan->sum('total_pengeluaran');

        if($request->get('export') == 'pdf') {
            $pdf = Pdf::loadView('admin.keuangan.laporantahunan.pdf.cetak-laporan', [
                'laporanTahunan' => $laporanTahunan, 
                'totalPendapatan' => $totalPendapatan,
                'totalPengeluaran' => $totalPengeluaran,
            ]);
            return $pdf->download('laporan_tahunan.pdf');
        }

        return view('admin.keuangan.laporantahunan.cetak-laporan', compact('laporanTahunan', 'totalPendapatan', 'totalPengeluaran'));
    }
}
