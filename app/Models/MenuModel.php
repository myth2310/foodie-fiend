<?php

namespace App\Models;

use App\Entities\MenuEntity;
use CodeIgniter\Model;
use Exception;
use Ramsey\Uuid\Uuid;

class MenuModel extends Model
{
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = MenuEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'store_id', 'name', 'price', 'description', 'category', 'image_url'];

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
        'store_id' => 'required',
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'category' => 'required',
    ];
    protected $validationMessages   = [
        'store_id' => [
            'required' => 'Id UMKM tidak boleh kosong.'
        ],
        'name' => [
            'required' => 'Name menu tidak boleh kosong.',
        ],
        'price' => [
            'required' => 'Harga menu tidak boleh kosong.'
        ],
        'description' => [
            'required' => 'Deskripsi menu tidak boleh kosong.'
        ],
        'category' => [
            'required' => 'Kategori tidak boleh kosong.'
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

    public function getMenuWithStore($menu_id)
    {
        return $this->select('menus.*,stores.user_id as stores_id, stores.name as store_name')
            ->join('stores', 'menus.store_id = stores.id')
            ->where('menus.id', $menu_id)
            ->first();
    }

    public function getMenusByStore($store_id)
    {
        return $this->select('menus.*, ROUND(AVG(reviews.rating), 1) as average_rating')
            ->join('stores', 'stores.id = menus.store_id')
            ->join('reviews', 'reviews.menu_id = menus.id', 'left')
            ->where('menus.store_id', $store_id)
            ->groupBy('menus.id')
            ->findAll();
    }

    public function getMenusAll($user_id = null)
    {
        $all_menus = $this->select('menus.*, stores.name as name_stores, ROUND(AVG(reviews.rating), 1) as average_rating')
            ->join('stores', 'stores.id = menus.store_id')
            ->join('reviews', 'reviews.menu_id = menus.id', 'left')
            ->groupBy('menus.id')
            ->findAll();

        $all_menus_array = array_map(function ($menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'image_url' => $menu->image_url,
                'price' => $menu->price,
                'store_name' => $menu->name_stores,
                'average_rating' => $menu->average_rating,
            ];
        }, $all_menus);

        if ($user_id) {
            $ch = curl_init();
            $api_url = 'http://127.0.0.1:5000/api/recommendation/' . $user_id;
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception('cURL error: ' . curl_error($ch));
            }

            curl_close($ch);

            $recommended_menu_ids = json_decode($response, true);
            if (!is_array($recommended_menu_ids)) {

                $recommended_menu_ids = [];
            }
            $recommended_menus = array_filter($all_menus_array, function ($menu) use ($recommended_menu_ids) {
                return in_array($menu['id'], $recommended_menu_ids);
            });

            return $recommended_menus;
        }

        return $all_menus_array;
    }



    public function countMenusWithRating()
{
    $ratings = [];

    for ($i = 1; $i <= 5; $i++) {
    
        $menuCount = $this->select('menus.id')
            ->join('reviews', 'reviews.menu_id = menus.id')
            ->groupBy('menus.id')
            ->having('FLOOR(AVG(reviews.rating))', $i) 
            ->countAllResults();

        $randomMenu = $this->select('menus.image_url')
            ->join('reviews', 'reviews.menu_id = menus.id')
            ->groupBy('menus.id')
            ->having('FLOOR(AVG(reviews.rating))', $i)
            ->orderBy('RAND()')
            ->first();

        $ratings["rating_{$i}"] = [
            'count' => $menuCount,
            'image' => $randomMenu ? $randomMenu->image_url : null,
        ];
    }

    return $ratings;
}

    
}
