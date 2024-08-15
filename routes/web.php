<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\ShiftKaryawanController;
use App\Http\Controllers\LaporanBulananController;
use App\Http\Controllers\LaporanTahunanController;
use App\Http\Controllers\StockPredictionController;
use App\Http\Controllers\GeneratePredectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'authentication']);
Route::get('/dashboard', [DashboardController::class, 'dashboard']);


// Position
Route::get('/jabatan', [PositionController::class, 'index']);
Route::post('/jabatan-add', [PositionController::class, 'store']);
Route::put('/jabatan-edit/{id}', [PositionController::class, 'edit']);
Route::put('/jabatan/{id}', [PositionController::class, 'update']);
Route::delete('/jabatan-delete/{id}', [PositionController::class, 'destroy']);

// Karyawan
Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/karyawan-detail/{id}', [KaryawanController::class, 'detail']);
Route::post('/karyawan-add', [KaryawanController::class,'store']);
Route::delete('/karyawan-delete/{id}', [KaryawanController::class, 'destroy']);
Route::put('/karyawan-edit/{id}', [KaryawanController::class, 'update']);
Route::get('/cetak-karyawan', [KaryawanController::class, 'cetakKaryawan']);

//Gaji
Route::get('/gaji', [GajiKaryawanController::class, 'index']);
Route::get('/gaji-create', [GajiKaryawanController::class, 'create']);
Route::post('/gaji-store', [GajiKaryawanController::class, 'store']);
Route::get('/gaji-edit/{id}', [GajiKaryawanController::class, 'edit']);
Route::put('/gaji-update/{id}', [GajiKaryawanController::class, 'update']);
Route::get('report-gaji', [GajiKaryawanController::class, 'reportGaji']);
Route::get('report-gaji-detail/{id}', [GajiKaryawanController::class, 'showDetail']);
Route::get('/cetak-slip-gaji/{id}', [GajiKaryawanController::class, 'cetakSlipGaji']);
Route::get('/cetak-gaji', [GajiKaryawanController::class, 'cetakGaji']);


//Produk
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product-create', [ProductController::class, 'create']);
Route::get('/product-edit/{id}', [ProductController::class, 'edit']);
Route::post('/product-store', [ProductController::class, 'store']);
Route::put('/product-update/{id}', [ProductController::class, 'update']);
Route::delete('/product-delete/{id}', [ProductController::class, 'destroy']);
Route::get('/list-pembelian', [ProductController::class, 'listPembelian']);
Route::get('/cetak-product', [ProductController::class, 'cetakProduct']);


//Pendapatan
Route::get('/pendapatan', [PendapatanController::class, 'index']);
Route::get('/pendapatan-create', [PendapatanController::class, 'create']);
Route::post('/pendapatan-store', [PendapatanController::class, 'store']);
Route::get('/pendapatan-edit/{id}', [PendapatanController::class, 'edit']);
Route::put('/pendapatan-update/{id}', [PendapatanController::class, 'update']);
Route::delete('/pendapatan-delete/{id}', [PendapatanController::class, 'destroy']);
Route::get('/cetak-pendapatan', [PendapatanController::class, 'cetakPendapatan']);

//Pengeluaran
Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
Route::get('/pengeluaran-create', [PengeluaranController::class, 'create']);
Route::get('/pengeluaran-edit/{id}', [PengeluaranController::class, 'edit']);
Route::put('/pengeluaran-update/{id}', [PengeluaranController::class, 'update']);
Route::post('/pengeluaran-store', [PengeluaranController::class, 'store']);
Route::delete('/pengeluaran-delete/{id}', [PengeluaranController::class, 'destroy']);
Route::get('/cetak-pengeluaran', [PengeluaranController::class, 'cetakPengeluaran']);

//Laporan Harian
Route::get('/laporan-harian', [LaporanHarianController::class, 'index']);
Route::get('/generate-laporan-harian', [LaporanHarianController::class, 'generateLaporanHarian']);
Route::get('/generate-laporan-seluruh', [LaporanHarianController::class, 'generateSeluruh']);
Route::get('/laporan-detailL/{id}', [LaporanHarianController::class, 'detailL']);
Route::get('/cetak-laporan', [LaporanHarianController::class,'cetakLaporanHarian']);

//Laporan Bulanan
Route::get('/laporan-bulanan', [LaporanBulananController::class, 'index']);
Route::get('/laporan-bulanan-detail/{id}', [LaporanBulananController::class, 'detail']);
Route::get('/laporan-bulanan-generate', [LaporanBulananController::class, 'generateLaporanBulanan']);
Route::get('/laporan-bulanan-refresh', [LaporanBulananController::class, 'refresh']);
Route::get('/cetak-laporan-bulanan', [LaporanBulananController::class,'cetakLaporanBulanan']);

//Laporan Tahunan
Route::get('/laporan-tahunan', [LaporanTahunanController::class, 'index']);
Route::get('/laporan-tahunan-detail/{id}', [LaporanTahunanController::class, 'detail']);
Route::get('/laporan-tahunan-generate', [LaporanTahunanController::class, 'generateLaporanTahunan']);
Route::get('/laporan-tahunan-refresh', [LaporanTahunanController::class, 'refresh']);
Route::get('/cetak-laporan-tahunan', [LaporanTahunanController::class, 'cetakLaporanTahunan']);

//Laba - Rugi
Route::get('/laba-rugi', [LabaRugiController::class, 'labaRugi']);
Route::get('/cetak-laba-rugi', [LabaRugiController::class, 'cetakLabaRugi'])->name('cetak-laba-rugi');
Route::get('/export-laba-rugi', [LabaRugiController::class, 'exportPdf'])->name('export-laba-rugi');



//Supplier 
Route::get('/supplier', [SupplierController::class, 'index']);
Route::get('/supplier-create', [SupplierController::class, 'create']);
Route::post('/supplier-store', [SupplierController::class, 'store']);
Route::get('/supplier-edit/{id}', [SupplierController::class, 'edit']);
Route::put('/supplier-update/{id}', [SupplierController::class, 'update']);
Route::delete('/supplier-delete/{id}', [SupplierController::class, 'destroy']);

//order
Route::get('/order', [OrderController::class, 'index']);
Route::get('/order-create', [OrderController::class, 'create']);
Route::post('/order-store', [OrderController::class, 'store']);
Route::get('/order-edit/{id}', [OrderController::class, 'edit']);
Route::put('/order-update/{id}', [OrderController::class, 'update']);
Route::delete('/order-delete/{id}', [OrderController::class, 'destroy']);
Route::get('/order-print', [OrderController::class, 'print']);


//Prediksi
Route::get('/predictions', [StockPredictionController::class, 'index']);
Route::get('/generatePredectiont', [GeneratePredectionController::class, 'generateStockPredictions']);

//shift
Route::get('/shift', [ShiftController::class, 'index']);
Route::get('/shift-create', [ShiftController::class, 'create']);
Route::post('/shift-store', [ShiftController::class, 'store']);
Route::get('/shift-edit/{id}', [ShiftController::class, 'edit']);
Route::put('/shift-update/{id}', [ShiftController::class, 'update']);

//Absensi
Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::post('/absen-masuk', [AbsensiController::class, 'absenMasuk'])->name('absen.masuk');
Route::post('/absen-keluar', [AbsensiController::class, 'absenKeluar'])->name('absen.keluar');
Route::get('/admin/absensi/riwayat', [AbsensiController::class, 'riwayat'])->name('admin.absensi.riwayat');
Route::get('/cetak-absensi', [AbsensiController::class, 'cetakAbsensi']);


//Shift Karyawan
Route::get('/shift-karyawan', [ShiftKaryawanController::class, 'index']);
Route::get('/shift-karyawan-create', [ShiftKaryawanController::class, 'create']);
Route::post('/shift-karyawan-store', [ShiftKaryawanController::class, 'store']);
Route::get('/shift-karyawan-edit/{id}', [ShiftKaryawanController::class, 'edit']);
Route::put('/shift-karyawan-update/{id}', [ShiftKaryawanController::class, 'update']);
Route::delete('/shift-karyawan-delete', [ShiftKaryawanController::class, 'destroy']);


