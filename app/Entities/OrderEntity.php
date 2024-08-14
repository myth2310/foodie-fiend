<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class OrderEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'order_id' => null,
        'user_id' => null,
        'menu_id' => null,
        'quantity' => null,
        'price' => null,
        'total_price' => null,
        'status' => null,
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
