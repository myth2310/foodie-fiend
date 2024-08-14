<?php

namespace App\Models;

use App\Entities\StoreEntity;
use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class StoreModel extends Model
{
    protected $table            = 'stores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = StoreEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'user_id', 'name', 'address', 'image_url'];

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
        'name' => 'required',
        'address' => 'required',
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'Nama UMKM tidak boleh kosong.',
        ],
        'address' => [
            'required' => 'Alamat UMKM tidak boleh kosong.',
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
        if (isset($data['data']) && $data['data'] instanceof StoreEntity) {
            $data['data']->id = Uuid::uuid7()->toString();
        }
        return $data;
    }
}
