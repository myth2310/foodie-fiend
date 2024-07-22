<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchantModel extends Model
{
    protected $table            = 'merchants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\MerchantEntity';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['store_id', 'user_id'];

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
        'store_id' => 'required|min_length[1]',
        'user_id' => 'required|min_length[1]',
    ];
    protected $validationMessages   = [
        'store_id' => [
            'required' => 'Id toko tidak boleh kosong.',
            'min_length' => 'Id toko harus terdiri dari minimal 1 karakter.',
        ],
        'user_id' => [
            'required' => 'Id pengguna tidak boleh kosong.',
            'min_length' => 'Id pengguna harus terdiri dari minimal 1 karakter.',
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
