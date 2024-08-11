<?php

namespace App\Models;

use App\Entities\OrderEntity;
use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = OrderEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'user_id', 'order_id', 'store_id', 'menu_id', 'quantity', 'price', 'total_price', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id' => 'required',
        'menu_id' => 'required',
        'quantity' => 'required',
        'total_price' => 'required',
    ];
    protected $validationMessages   = [
        'user_id' => [
            'required' => 'Id user tidak boleh kosong.',
        ],
        'menu_id' => [
            'required' => 'Id menu tidak boleh kosong.',
        ],
        'quantity' => [
            'required' => 'Jumlah pesanan tidak boleh kosong.',
        ],
        'total_price' => [
            'required' => 'Total harga tidak boleh kosong.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateUUID'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function generateUUID(array $data)
    {
        $data['data']['id'] = Uuid::uuid7()->toString();
        return $data;
    }

    public function getAllOrdersWithMenus($user_id, $order_status)
    {
        if (is_null($order_status)) {
            return $this->select('orders.*, menus.image_url as menu_img, menus.name as menu_name, stores.name as store_name')
            ->join('menus', 'menus.id = orders.menu_id')
            ->join('stores', 'stores.id = orders.store_id')
            ->where('orders.user_id', $user_id)
            ->findAll();
        }
        return $this->select('orders.*, menus.image_url as menu_img, menus.name as menu_name, stores.name as store_name')
            ->join('menus', 'menus.id = orders.menu_id')
            ->join('stores', 'stores.id = orders.store_id')
            ->where(['orders.user_id' => $user_id, 'orders.status' => $order_status])
            ->findAll();
    }
}
