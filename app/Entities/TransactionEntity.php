<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class TransactionEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'order_id' => null,
        'transaction_id' => null,
        'gross_amount' => null,
        'transaction_status' => null,
        'payment_type' => null,
        'transaction_time' => null,
        'fraud_status' => null,
        'customer_name' => null,
        'customer_email' => null,
        'customer_phone' => null,
        'payment_code' => null,
        'bank' => null,
        'va_numbers' => null,
        'approval_code' => null,
        'signature_key' => null,
        'currency' => null,
        'expiry_time' => null,
        'billing_address' => null,
        'shipping_address' => null,
        'item_details' => null,
        'created_at' => null,
        'updated_at' => null
    ];
    protected $datamap = [];
    protected $dates   = ['transaction_time', 'expiry_time','created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'billing_address' => 'json',
        'shipping_address' => 'json',
        'item_details' => 'json',
    ];
}
