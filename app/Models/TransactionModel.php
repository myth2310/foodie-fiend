<?php

namespace App\Models;

use App\Entities\TransactionEntity;
use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = TransactionEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'order_id', 'transaction_id', 'gross_amount', 'transaction_status', 'payment_type',
        'transaction_time', 'fraud_status', 'customer_name', 'customer_email', 'customer_phone',
        'payment_code', 'bank', 'va_numbers', 'approval_code', 'signature_key', 'currency',
        'expiry_time', 'billing_address', 'shipping_address', 'item_details',
    ];

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
        'order_id' => 'required',
        'transaction_id' => 'required',
        'gross_amount' => 'required',
        'payment_type' => 'required',
        'customer_name'=> 'required',
        'customer_email' => 'required',
        'customer_phone' => 'required',
    ];
    protected $validationMessages   = [
        'order_id' => [
            'required' => 'ID order harus diisi',
        ],
        'transaction_id' => [
            'required' => 'ID transaksi harus diisi',
        ],
        'gross_amount' => [
            'required' => 'Total harga harus diisi',
        ],
        'payment_type' => [
            'required' => 'Jenis pembayaran harus diisi',
        ],
        'customer_name' => [
            'required' => 'Nama pelanggan harus diisi',
        ],
        'customer_email' => [
            'required' => 'Email pelanggan harus diisi',
        ],
        'customer_phone' => [
            'required' => 'Nomor telepon pelanggan harus diisi',
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
}
