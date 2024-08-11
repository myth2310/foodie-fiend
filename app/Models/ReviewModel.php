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
    protected $allowedFields    = ['id', 'user_id', 'menu_id', 'review', 'rating'];

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
                    ->findAll();
    }

    public function countMenusWithRating()
    {
        $rating_1 = $this->select('menu_id')->groupBy('menu_id')->having('AVG(rating)', 1)->countAllResults();
        $rating_2 = $this->select('menu_id')->groupBy('menu_id')->having('AVG(rating)', 2)->countAllResults();
        $rating_3 = $this->select('menu_id')->groupBy('menu_id')->having('AVG(rating)', 3)->countAllResults();
        $rating_4 = $this->select('menu_id')->groupBy('menu_id')->having('AVG(rating)', 4)->countAllResults();
        $ratings = [
            'rating_1' => $rating_1,
            'rating_2' => $rating_2,
            'rating_3' => $rating_3,
            'rating_4' => $rating_4,
        ];

        return $ratings;
    }
}
