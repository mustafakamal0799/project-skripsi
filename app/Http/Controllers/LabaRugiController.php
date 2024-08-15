<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LabaRugiController extends Controller
{
    public function labaRugi(Request $request) {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Mengambil data pendapatan per hari
        $dailyPendapatan = Pendapatan::selectRaw('DAY(tanggal) as day, SUM(total) as total')
                                ->whereYear('tanggal', $year)
                                ->whereMonth('tanggal', $month)
                                ->groupBy('day')
                                ->orderBy('day')
                                ->get();

        // Mengambil data pengeluaran per hari
        $dailyPengeluaran = Pengeluaran::selectRaw('DAY(tanggal) as day, SUM(total) as total')
                                ->whereYear('tanggal', $year)
                                ->whereMonth('tanggal', $month)
                                ->groupBy('day')
                                ->orderBy('day')
                                ->get();
        
        return view('admin.laba-rugi.index', compact('month', 'year', 'dailyPendapatan', 'dailyPengeluaran'));
    }

    public function exportPdf(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Mengambil data pendapatan per hari
        $dailyPendapatan = Pendapatan::selectRaw('DAY(tanggal) as day, SUM(total) as total')
                                ->whereYear('tanggal', $year)
                                ->whereMonth('tanggal', $month)
                                ->groupBy('day')
                                ->orderBy('day')
                                ->get();

        // Mengambil data pengeluaran per hari
        $dailyPengeluaran = Pengeluaran::selectRaw('DAY(tanggal) as day, SUM(total) as total')
                                ->whereYear('tanggal', $year)
                                ->whereMonth('tanggal', $month)
                                ->groupBy('day')
                                ->orderBy('day')
                                ->get();

        $pdf = PDF::loadView('admin.laba-rugi.pdf.cetak', compact('month', 'year', 'dailyPendapatan', 'dailyPengeluaran'));
        return $pdf->download('laporan-laba-rugi.pdf');
    }

    public function cetakLabaRugi(Request $request) {
        
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Mengambil data pendapatan per hari
        $dailyPendapatan = Pendapatan::selectRaw('DAY(tanggal) as day, SUM(total) as total')
                                ->whereYear('tanggal', $year)
                                ->whereMonth('tanggal', $month)
                                ->groupBy('day')
                                ->orderBy('day')
                                ->get();

        // Mengambil data pengeluaran per hari
        $dailyPengeluaran = Pengeluaran::selectRaw('DAY(tanggal) as day, SUM(total) as total')
                                ->whereYear('tanggal', $year)
                                ->whereMonth('tanggal', $month)
                                ->groupBy('day')
                                ->orderBy('day')
                                ->get();
        
        return view('admin.laba-rugi.cetak', compact('month', 'year', 'dailyPendapatan', 'dailyPengeluaran'));
    }

}

