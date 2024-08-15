<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class SendSmsController extends Controller
{
    public function sendsms() 
    {
        $products = Product::whereColumn('stok_barang', '<=', 'minimal_barang')->get();

        $messageText = getenv("SMS_MESSAGE_TEXT") ?: "Stok barang mencapai batas minimum.";

        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $sendernumber = getenv("TWILIO_PHONE_NUMBER");
        $receivernumber = getenv("TO_PHONE_NUMBER");

        $twilio = new Client($sid, $token);

        foreach ($products as $product) {
            $message = $twilio->messages->create(
                $receivernumber, // to
                [
                    "body" => "Peringatan : \nStok barang '{$product->nama_barang}' hampir habis. \nStok saat ini: {$product->stok_barang}.",
                    "from" => $sendernumber,
                ]
            );
        }

        return "Pesan berhasil dikirim!";
    }
}
