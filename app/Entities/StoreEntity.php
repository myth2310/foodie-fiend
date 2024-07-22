<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Ramsey\Uuid\Uuid;

class StoreEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'user_id' => null,
        'name' => null,
        'image_url' => null,
        'address' => null,
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function generateUUID()
    {
        $this->attributes['id'] = Uuid::uuid7()->toString();
        return $this;
    }
}
