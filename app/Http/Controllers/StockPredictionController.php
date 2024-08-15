<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockPrediction;

class StockPredictionController extends Controller
{
    public function index()
    {
        $predictions = StockPrediction::with('product')->get();

        return view('admin.produk.prediksi.index', compact('predictions'));
    }

    public function generate()
    {
        // Panggil metode generateStockPredictions yang dibuat sebelumnya
        app()->call('App\Http\Controllers\GeneratePredectionController@generateStockPredictions');

        return redirect()->route('predictions.index')->with('success', 'Prediksi stok berhasil diperbarui.');
    }
}
