<?php

namespace App\Models;

use App\Entities\ReviewEntity;
use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = ReviewEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'menu_id', 'review', 'rating'];

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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
