<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use App\Models\StockPrediction;

class GeneratePredectionController extends Controller
{
    public function generateStockPredictions()
    {
        StockPrediction::truncate();

        $products = Product::all();
        $predictionDate = Carbon::now()->addDays(7); // Prediksi untuk 7 hari ke depan

        // Hapus prediksi lama untuk tanggal dan produk yang sama
        StockPrediction::where('prediction_date', $predictionDate)->delete();

        foreach ($products as $product) {
            // Ambil data penjualan 30 hari terakhir
            $salesData = Pendapatan::where('product_id', $product->id)
                ->whereDate('tanggal', '>=', Carbon::now()->subDays(30))
                ->pluck('terjual');

            // Hitung rata-rata penjualan
            $averageSales = $salesData->avg();

            // Prediksi kebutuhan stok 7 hari ke depan
            $predictedStock = $averageSales * 7;

            // Simpan hasil prediksi
            StockPrediction::updateOrCreate(
                ['product_id' => $product->id, 'prediction_date' => $predictionDate],
                ['predicted_stock' => $predictedStock]
            );
        }

        return redirect('/predictions');
    }
}
