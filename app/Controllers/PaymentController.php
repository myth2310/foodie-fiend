<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\OrderEntity;
use App\Entities\TransactionEntity;
use App\Libraries\Midtrans;
use App\Models\OrderModel;
use App\Models\TransactionModel;
use Ramsey\Uuid\Uuid;
use CodeIgniter\HTTP\ResponseInterface;

class PaymentController extends BaseController
{
    protected $midtrans;
    protected $transactionModel;
    protected $orderModel;

    public function __construct()
    {
        $this->midtrans = new Midtrans();
        $this->transactionModel = new TransactionModel();
        $this->orderModel = new OrderModel();
    }


    public function create($data)
{
    foreach ($data as $item) {
        
        $total_price = $item['price'] * $item['quantity'];
        $order_id = Uuid::uuid7()->toString();

        // Data pesanan
        $order_data = [
            'user_id' => session()->get('user_id'),
            'order_id' => $order_id,
            'store_id' => $item['store_id'],
            'menu_id' => $item['menu_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'total_price' => $total_price,
            'status' => 'pending',
        ];

        $order = new OrderEntity($order_data);
        $this->orderModel->save($order);

        // Data transaksi untuk Midtrans
        $transaction_detail = [
            'order_id' => $order_id,
            'gross_amount' => $total_price,
        ];
        $customer_detail = [
            'first_name' => session()->get('name'),
            'email' => session()->get('email'),
            'phone' => session()->get('phone'),
        ];
        $transaction_data = [
            'transaction_details' => $transaction_detail,
            'customer_details' => $customer_detail,
            'callbacks' => [
                'finish' => base_url('/'),
            ],
        ];

        $transactionData = [
            'order_id' => $order_id,
            'transaction_id' => null,
            'gross_amount' => $total_price,
            'transaction_status' => 'pending',
            'payment_type' => null,
            'transaction_time' => null,
            'fraud_status' => null,
            'customer_name' => $customer_detail['first_name'],
            'customer_email' => $customer_detail['email'],
            'customer_phone' => $customer_detail['phone'],
        ];

        $transactionEntity = new TransactionEntity($transactionData);
        $this->transactionModel->insert($transactionEntity);
    }

    // Kembalikan token untuk transaksi
    return $this->midtrans->getSnapToken($transaction_data);
}



    //     public function create($data)
    // {
    //     $total_price = $data['price'] * $data['quantity'];
    //     $order_id = Uuid::uuid7()->toString();
    //     $order_data = [
    //         'user_id' => session()->get('user_id'),
    //         'order_id' => $order_id,
    //         'store_id' => $data['store_id'],
    //         'menu_id' => $data['menu_id'],
    //         'quantity' => $data['quantity'],
    //         'price' => $data['price'],
    //         'total_price' => $total_price,
    //         // Set status awal menjadi 'pending'
    //         'status' => 'completed',
    //     ];
    //     $order = new OrderEntity($order_data);
    //     $this->orderModel->save($order);

    //     $transaction_detail = [
    //         'order_id' => $order_id,
    //         'gross_amount' => $total_price,
    //     ];
    //     $customer_detail = [
    //         'first_name' => session()->get('name'),
    //         'email' => session()->get('email'),
    //         'phone' => session()->get('phone'),
    //     ];
    //     $transaction_data = [
    //         'transaction_details' => $transaction_detail,
    //         'customer_details' => $customer_detail,
    //         'callbacks' => [
    //             'finish' => base_url('/'), 
    //         ],
    //     ];

    //     return $this->midtrans->getSnapToken($transaction_data);
    // }

    public function notification()
    {
        $notif = $this->midtrans->handleNotification();

        $transactionData = [
            'order_id' => $notif->order_id,
            'transaction_id' => $notif->transaction_id,
            'gross_amount' => $notif->gross_amount,
            'transaction_status' => $notif->transaction_status,
            'payment_type' => $notif->payment_type,
            'transaction_time' => $notif->transaction_time,
            'fraud_status' => $notif->fraud_status,
            'customer_name' => $notif->customer_details->first_name . ' ' . $notif->customer_details->last_name,
            'customer_email' => $notif->customer_details->email,
            'customer_phone' => $notif->customer_details->phone,
        ];

        $transactionEntity = new TransactionEntity($transactionData);
        $existingTransaction = $this->transactionModel->where('transaction_id', $notif->transaction_id)->first();
        if ($existingTransaction) {
            $transactionEntity->id = $existingTransaction->id;
            $this->transactionModel->save($transactionEntity);
        } else {
            $this->transactionModel->insert($transactionEntity);
        }
        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;

        if ($transaction == 'capture' || $transaction == 'settlement') {
            $this->orderModel->where('order_id', $order_id)->set(['status' => 'completed'])->update();
        } elseif ($transaction == 'pending') {
            $this->orderModel->where('order_id', $order_id)->set(['status' => 'pending'])->update();
        } elseif ($transaction == 'deny' || $transaction == 'cancel' || $transaction == 'expire') {
            $this->orderModel->where('order_id', $order_id)->set(['status' => 'canceled'])->update();
        }

        return $this->response->setStatusCode(200);
    }
}