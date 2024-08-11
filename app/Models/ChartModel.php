<?php

namespace App\Models;

use App\Entities\ChartEntity;
use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ChartModel extends Model
{
    protected $table            = 'charts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = ChartEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'user_id', 'menu_id', 'store_id', 'quantity'];

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
        'user_id' => 'required|max_length[36]',
        'menu_id' => 'required|max_length[36]',
        'store_id' => 'required|max_length[36]',
        'quantity' => 'required|max_length[3]',
    ];
    protected $validationMessages   = [
        'user_id' => [
            'required' => 'Anda harus masuk terlebih dahulu',
            'max_length' => 'ID pengguna tidak valid',
        ],
        'menu_id' => [
            'required' => 'ID menu harus diisi',
            'max_length' => 'ID menu tidak valid',
        ],
        'store_id' => [
            'required' => 'ID toko harus diisi',
            'max_length' => 'ID toko tidak valid',
        ],
        'quantity' => [
            'required' => 'Jumlah item minimal 1',
            'quantity' => 'Jumlah item terlalu banyak'
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

    public function getAllChartWithMenu($user_id)
    {
        return $this->select('charts.*, menus.name as menu_name, menus.image_url as menu_img, menus.price as menu_price, stores.name as store_name')
            ->join('menus', 'menus.id = charts.menu_id')
            ->join('stores', 'stores.id = charts.store_id')
            ->findAll();
    }
}
