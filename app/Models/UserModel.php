<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = UserEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'name', 'email', 'phone', 'password', 'lat', 'long', 'address', 'profile', 'role', 'is_verif', 'verification_token'];

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
    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'phone' => 'required|regex_match[/^\+?[0-9]{10,15}$/]|is_unique[users.phone]',
        'password' => 'required|min_length[8]',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'Nama wajib diisi.',
            'max_length' => 'Nama terlalu panjang. Panjang karakter tidak diizinkan.',
        ],
        'email' => [
            'required' => 'Email wajib diisi.',
            'valid_email' => 'Alamat email tidak valid.',
            'is_unique' => 'Alamat email sudah terdaftar. Gunakan alamat email lain.'
        ],
        'phone' => [
            'required' => 'Nomor telepon wajib diisi.',
            'regex_match' => 'Nomor telepon tidak valid.',
            'is_unique' => 'Nomor telepon sudah terdaftar. Gunakan nomor telepon lain.',
        ],
        'password' => [
            'required' => 'Password wajib diisi',
            'min_length' => 'Password tidak valid. Password minimal 8 karakter',
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

    public function getUserWithStore($storeId)
    {
        return $this->db->table('users') 
            ->select('stores.*,stores.name as stores_name, users.*') 
            ->join('stores', 'users.id = stores.user_id', 'inner') 
            ->where('users.id', $storeId) 
            ->get()
            ->getRowArray(); 
    }

    public function getStore($perPage = 5)
    {
        return $this->select('users.*, users.id as store_id, stores.*')
            ->join('stores', 'users.id = stores.user_id')
            ->where('users.role', 'store')
            ->paginate($perPage);
    }

    public function getUmkmById($id)
    {
        $umkm = $this->select('users.*, stores.*')
            ->join('stores', 'users.id = stores.user_id')
            ->where('users.id', $id)
            ->first();

        return $umkm;
    }
    public function getUserId($id)
    {
        $users = $this->select('users.*')
            ->where('users.id', $id)
            ->first();

        return $users;
    }


}
