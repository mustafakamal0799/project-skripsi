<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'prediction_date',
        'predicted_stock',
    ];

    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
