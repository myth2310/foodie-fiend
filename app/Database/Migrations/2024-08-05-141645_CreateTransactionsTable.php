<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'order_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'transaction_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'gross_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => false,
            ],
            'transaction_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'payment_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'transaction_time' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'fraud_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'customer_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'customer_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'customer_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'payment_code' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'bank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'va_numbers' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'approval_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'signature_key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'expiry_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'billing_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'shipping_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'item_details' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('order_id', 'orders', 'id');
        $this->forge->createTable('transactions', true);
    }

    public function down()
    {
        $this->forge->dropTable('transactions', true);
    }
}
