<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\UserEntity';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'phone', 'password', 'profile', 'role'];

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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
