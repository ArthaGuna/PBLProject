<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set midtrans config
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken(Request $request)
    {
        $orderId = uniqid();
        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $request->input('amount'), // Total harga
        ];

        $customerDetails = [
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'email'         => $request->input('email'),
            'phone'         => $request->input('phone'),
        ];

        $transaction = [
            'payment_type' => 'credit_card',
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'midtrans.serverkey';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    }
}

