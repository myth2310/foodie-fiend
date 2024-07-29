<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ChartEntity extends Entity
{
    protected $datamap = [
        'id' => null,
        'user_id' => null,
        'menu_id' => null,
        'store_id' => null,
        'quantity' => null,
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
