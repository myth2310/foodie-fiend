<?php

namespace App\Models;

use App\Entities\ReviewEntity;
use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = ReviewEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'user_id', 'menu_id','order_id', 'review', 'rating'];

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
        // 'review' => 'required',
        'rating' => 'required'
    ];
    protected $validationMessages   = [
        'user_id' => [
            'required' => 'Id user tidak boleh kosong.'
        ],
        'menu_id' => [
            'required' => 'Id menu tidak boleh kosong.',
        ],
        // 'review' => [
        //     'required' => 'Komentar tidak boleh kosong.'
        // ],
        'rating' => [
            'required' => 'Rating menu tidak boleh kosong.'
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

    public function getReviewWithUser($menu_id)
    {
        return $this->select('reviews.*, users.name as user_name, users.profile as user_profile')
            ->join('users', 'reviews.user_id = users.id')
            ->where('reviews.menu_id', $menu_id)
            ->orderBy('reviews.created_at', 'DESC')
            ->limit(5)
            ->findAll();
    }


    public function getMenusWithRating($menu_ids)
    {
        return $this->select('reviews.menu_id id, ROUND(AVG(rating)) rating, m.image_url, m.name, m.price')
            ->join('menus m', 'reviews.menu_id = m.id')
            ->groupBy('menu_id')
            ->whereIn('reviews.menu_id', $menu_ids)
            ->findAll();
    }

    public function getMenusWithRatingFromStoreId($store_id)
    {
        return $this->select('reviews.menu_id id, ROUND(AVG(reviews.rating)) rating, m.image_url, m.name, m.price')
            ->join('menus m', 'reviews.menu_id = m.id')
            ->where('m.store_id', $store_id)
            ->groupBy('reviews.menu_id, m.name, m.price, m.image_url')
            ->findAll();
    }



    public function getMenus($rating)
    {
        return $this->select('reviews.menu_id, FLOOR(AVG(reviews.rating)) AS rounded_rating, m.name, m.price, m.image_url')
            ->join('menus m', 'reviews.menu_id = m.id')
            ->groupBy('reviews.menu_id, m.name, m.price, m.image_url')
            ->having('rounded_rating', $rating)
            ->findAll();
    }
}
