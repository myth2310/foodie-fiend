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
    protected $allowedFields    = ['id', 'user_id', 'order_id', 'store_id', 'menu_id', 'quantity', 'price', 'total_price','shipping_cost','application_fee', 'status','delivery_status'];

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


    // public function getAllOrdersWithMenus($user_id, $order_status)
    // {
    //     if (is_null($order_status)) {
    //         return $this->select('orders.*, menus.image_url as menu_img, menus.name as menu_name, stores.name as store_name')
    //         ->join('menus', 'menus.id = orders.menu_id')
    //         ->join('stores', 'stores.id = orders.store_id')
    //         ->where('orders.user_id', $user_id)
    //         ->findAll();
    //     }
    //     return $this->select('orders.*, menus.image_url as menu_img, menus.name as menu_name, stores.name as store_name')
    //         ->join('menus', 'menus.id = orders.menu_id')
    //         ->join('stores', 'stores.id = orders.store_id')
    //         ->where(['orders.user_id' => $user_id, 'orders.status' => $order_status])
    //         ->findAll();
    // }

    public function getAllOrdersWithMenus($user_id, $order_status, $perPage = 2)
    {
        $this->select(
            'orders.created_at, 
                   GROUP_CONCAT(orders.menu_id) as menu_id, 
                   GROUP_CONCAT(menus.image_url) as menu_imgs, 
                   GROUP_CONCAT(menus.name) as menu_names, 
                   GROUP_CONCAT(orders.price) as price, 
                   GROUP_CONCAT(orders.total_price) as total_price, 
                   GROUP_CONCAT(orders.quantity) as quantity, 
                   GROUP_CONCAT(orders.status) as status, 
                   GROUP_CONCAT(orders.delivery_status) as delivery_status, 
                   GROUP_CONCAT(orders.shipping_cost) as shipping_cost, 
                   GROUP_CONCAT(orders.application_fee) as application_fee, 
                   stores.name as store_name',
        )
            ->join('menus', 'menus.id = orders.menu_id')
            ->join('stores', 'stores.id = orders.store_id')
            ->where('orders.user_id', $user_id);

        if (!is_null($order_status)) {
            $this->where('orders.status', $order_status);
        }

        $this->orderBy('orders.created_at', 'DESC');

        return $this->groupBy('orders.created_at, stores.name')
            ->paginate($perPage);
    }

    public function getOrdersByStoreId($store_id, $perPage = 5)
    {
        return $this->select('
                    orders.id, 
                    orders.total_price, 
                    orders.status, 
                    orders.quantity, 
                    orders.created_at, 
                    orders.delivery_status, 
                    menus.name AS menu_name, 
                    users.name AS customer_name
                ')
            ->join('menus', 'menus.id = orders.menu_id')
            ->join('users', 'users.id = orders.user_id')
            ->where('orders.store_id', $store_id)
            ->orderBy('orders.created_at', 'DESC')
            ->paginate($perPage);  
    }


    public function getDetailOrder($id)
    {
        $orderDetail = $this->select('orders.*, users.*,menus.name as menus_name')
            ->join('users', 'users.id = orders.user_id')
            ->join('menus', 'menus.id = orders.menu_id')
            ->where('orders.id', $id)
            ->first();

        return $orderDetail;
    }
    
}
