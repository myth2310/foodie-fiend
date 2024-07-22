<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\MenuEntity';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['store_id', 'name', 'price', 'description', 'category', 'image_url'];

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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
