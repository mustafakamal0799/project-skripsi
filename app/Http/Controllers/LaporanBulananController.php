<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\LaporanBulanan;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanBulananController extends Controller
{
    public function index(Request $request) 
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $laporanBulanan = LaporanBulanan::all();
        $totalPendapatan = LaporanBulanan::sum('total_pendapatan');
        $totalPengeluaran = LaporanBulanan::sum('total_pengeluaran');

        return view('admin.keuangan.laporanbulanan.index', compact('laporanBulanan', 'bulan', 'totalPendapatan', 'totalPengeluaran'));
    }
    
    
    public function generateLaporanBulanan(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));

        $totalPendapatan = Pendapatan::whereMonth('tanggal', Carbon::parse($bulan)->month)
            ->whereYear('tanggal', Carbon::parse($bulan)->year)
            ->sum('total');
        
        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', Carbon::parse($bulan)->month)
            ->whereYear('tanggal', Carbon::parse($bulan)->year)
            ->sum('total');

        if ($totalPendapatan == 0 && $totalPengeluaran == 0) {
            return redirect('/laporan-bulanan')->with('message', 'Data Kosong');
        }

        $produkTerjual = Pendapatan::whereMonth('tanggal', Carbon::parse($bulan)->month)
            ->whereYear('tanggal', Carbon::parse($bulan)->year)
            ->select('product_id', DB::raw('SUM(terjual) as total_terjual'))
            ->groupBy('product_id')->get();

        $produkTerjualData = [];
        foreach ($produkTerjual as $produk) {
            $product = Product::find($produk->product_id);
            $produkTerjualData[$product->nama_barang] = $produk->total_terjual;
        }

        $keterangan = Pengeluaran::whereMonth('tanggal', Carbon::parse($bulan)->month)
            ->whereYear('tanggal', Carbon::parse($bulan)->year)
            ->pluck('keterangan')
            ->toArray();

        $namaBarang = Pendapatan::with('product')
            ->whereMonth('tanggal', Carbon::parse($bulan)->month)
            ->whereYear('tanggal', Carbon::parse($bulan)->year)
            ->get()
            ->pluck('product.nama_barang')
            ->toArray();

        $laporanBulanan = LaporanBulanan::updateOrCreate(
            ['bulan' => $bulan],
            [
                'total_pendapatan' => $totalPendapatan,
                'total_pengeluaran' => $totalPengeluaran,
                'nama_barang' => json_encode($namaBarang),
                'produk_terjual' => json_encode($produkTerjualData),
                'keterangan' => json_encode($keterangan),
            ]
        );

        notify()->success('Laporan Bulanan Berhasil Diperbarui');
        return redirect('/laporan-bulanan');
    }

    public function refresh() {
        
        LaporanBulanan::truncate();

        $bulanPendapatan = Pendapatan::select(DB::raw('DATE_FORMAT(tanggal, "%Y-%m") as bulan'))->distinct()->get();

        foreach ($bulanPendapatan as $date) {
            $bulan = $date->bulan;

            $totalPendapatan = Pendapatan::whereMonth('tanggal', Carbon::parse($bulan)->month)
                ->whereYear('tanggal', Carbon::parse($bulan)->year)
                ->sum('total');
            $totalPengeluaran = Pengeluaran::whereMonth('tanggal', Carbon::parse($bulan)->month)
                ->whereYear('tanggal', Carbon::parse($bulan)->year)
                ->sum('total');

            if ($totalPendapatan == 0 && $totalPengeluaran == 0) {
                continue;
            }

            $produkTerjual = Pendapatan::whereMonth('tanggal', Carbon::parse($bulan)->month)
                ->whereYear('tanggal', Carbon::parse($bulan)->year)
                ->select('product_id', DB::raw('SUM(terjual) as total_terjual'))
                ->groupBy('product_id')->get();

            $produkTerjualData = [];
            foreach ($produkTerjual as $produk) {
                $product = Product::find($produk->product_id);
                if ($product) {
                    $produkTerjualData[$product->nama_barang] = $produk->total_terjual;
                }
            }

            $keterangan = Pengeluaran::whereMonth('tanggal', Carbon::parse($bulan)->month)
                ->whereYear('tanggal', Carbon::parse($bulan)->year)
                ->pluck('keterangan')
                ->toArray();

            $namaBarang = Pendapatan::with('product')
                ->whereMonth('tanggal', Carbon::parse($bulan)->month)
                ->whereYear('tanggal', Carbon::parse($bulan)->year)
                ->get()
                ->pluck('product.nama_barang')
                ->toArray();

            LaporanBulanan::updateOrCreate(
                ['bulan' => $bulan],
                [
                    'total_pendapatan' => $totalPendapatan,
                    'total_pengeluaran' => $totalPengeluaran,
                    'nama_barang' => json_encode($namaBarang),
                    'produk_terjual' => json_encode($produkTerjualData),
                    'keterangan' => json_encode($keterangan),
                ]
            );
        }

        notify()->success('Laporan Bulanan Berhasil Diperbarui');
        return redirect('/laporan-bulanan');
    }

    public function detail($id)
    {
        $laporanBulanan = LaporanBulanan::findOrFail($id);
        $totalPendapatan = LaporanBulanan::sum('total_pendapatan');
        $totalPengeluaran = LaporanBulanan::sum('total_pengeluaran');

        return view('admin.keuangan.laporanbulanan.detail', compact('laporanBulanan', 'totalPendapatan', 'totalPengeluaran'));
    }

    public function cetakLaporanBulanan (Request $request) 
    {
        $laporanBulanan = LaporanBulanan::all();
        $totalPendapatan = LaporanBulanan::sum('total_pendapatan');
        $totalPengeluaran = LaporanBulanan::sum('total_pengeluaran');

        if($request->get('export') == 'pdf') {
            $pdf = Pdf::loadView('admin.keuangan.laporanbulanan.pdf.cetak-laporan', [
                'laporanBulanan' => $laporanBulanan, 
                'totalPendapatan' => $totalPendapatan,
                'totalPengeluaran' => $totalPengeluaran,
            ]);
            return $pdf->download('laporan_bulanan.pdf');
        }

        return view('admin.keuangan.laporanbulanan.cetak-laporan', compact('laporanBulanan', 'totalPendapatan', 'totalPengeluaran'));
    }
}
