<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\ShiftKaryawan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('user_id', Auth::id())->get();
        return view('karyawan.absensi.absensi', compact('absensi'));
    }

    public function absenMasuk()
    {
        $today = Carbon::today()->format('Y-m-d');
        $shiftKaryawan = ShiftKaryawan::where('karyawan_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        if (!$shiftKaryawan) {
            return redirect()->back()->with('error', 'Anda tidak memiliki shift untuk hari ini.');
        }

        $now = Carbon::now()->format('H:i:s');
        $shift = $shiftKaryawan->shift;


        if ($now < $shift->jam_masuk || $now > $shift->jam_keluar) {
            return redirect()->back()->with('error', 'Jam absensi tidak sesuai dengan jam kerja shift.');
        }

        Absensi::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'tanggal' => $today,
            ],
            [
                'jam_masuk' => $now,
                'shift_karyawan_id' => $shiftKaryawan->id, // Pastikan field ini diisi
            ]
        );

        return redirect()->back()->with('success', 'Anda telah absen masuk.');
    }

    public function absenKeluar()
    {
        $today = Carbon::today()->format('Y-m-d');
        $absen = Absensi::where('user_id', Auth::id())
                        ->where('tanggal', $today)
                        ->first();

        if (!$absen || !$absen->jam_masuk) {
            return redirect()->back()->with('error', 'Anda belum absen masuk.');
        }

        if ($absen->jam_keluar) {
            return redirect()->back()->with('error', 'Anda sudah absen keluar.');
        }

        $shiftKaryawan = ShiftKaryawan::where('karyawan_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        if (!$shiftKaryawan) {
            return redirect()->back()->with('error', 'Anda tidak memiliki shift untuk hari ini.');
        }

        $now = Carbon::now()->format('H:i:s');
        $shift = $shiftKaryawan->shift;

        if ($now < $shift->jam_masuk || $now > $shift->jam_keluar) {
            return redirect()->back()->with('error', 'Jam absensi tidak sesuai dengan jam kerja shift.');
        }

        $absen->update(['jam_keluar' => $now]);

        return redirect()->back()->with('success', 'Anda telah absen keluar.');
    }

    public function riwayat(Request $request)
    {
        $query = Absensi::query();

        if ($request->has('tanggal')) {
            $query->whereDate('tanggal', $request->input('tanggal'));
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        $absensi = $query->with(['user', 'shiftKaryawan.shift'])->get();

        return view('admin.absensi.report.index', compact('absensi'));
    }

    public function cetakAbsensi() 
    {
        $absensi = Absensi::with('user', 'shiftKaryawan.shift')->get();

        return view('admin.absensi.report.cetak', compact('absensi'));
    }
}
