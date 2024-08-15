<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        
        if (auth()->user()->position_id == 1){
            $users = User::all()->first();
            $tanggal = Carbon::now();
            $totalPendapatan = Pendapatan::whereMonth('tanggal', $tanggal)->sum('total');
            $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $tanggal)->sum('total');

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

            return view('admin.dashboard', compact('users', 'totalPendapatan', 'tanggal', 'totalPengeluaran', 'dailyPendapatan', 'dailyPengeluaran'));
        } else {
            $users = User::all()->first();
            return view('karyawan.dashboard', compact('users'));
        }
    }

    public function dashboardkaryawan() {
        
    }
}
