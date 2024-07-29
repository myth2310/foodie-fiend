<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Midtrans;
use CodeIgniter\HTTP\ResponseInterface;

class PaymentController extends BaseController
{
    protected $midtrans;

    public function __construct()
    {
        $this->midtrans = new Midtrans();
    }

    public function index()
    {
        $transaction_detail = [
            'order_id' => rand(),
            'gross_amount' => 10000, // Amount in IDR
        ];
        $customer_detail = [
            'first_name' => 'Widies Ade',
            'last_name' => 'Priyanto',
            'email' => 'adepriyantowidies@gmail.com',
            'phone' => '081393677013',
        ];
        $transaction_data = [
            'transaction_details' => $transaction_detail,
            'customer_details' => $customer_detail,
        ];

        $data['snapToken'] = $this->midtrans->getSnapToken($transaction_data);
        return view('pages/payment', $data);
    }

    public function notification()
    {
        $notif = $this->midtrans->handleNotification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $oreder_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO: Update order status to 'challenge' in database
                } else {
                    // TODO: Update order status to 'success' in database
                }
            }
        } elseif ($transaction == 'settlement') {
            // TODO: Update order status to 'settlement' in database
        } elseif ($transaction == 'pending') {
            // TODO: Updata order status to 'pending' in database
        } else if ($transaction == 'deny') {
            // TODO: Update order status to 'deny' in database
        } else if ($transaction == 'expire') {
            // TODO: Update order status to 'expire' in database
        } else if ($transaction == 'cancel') {
            // TODO: Update order status to 'cancel' in database
        }
    }
}
