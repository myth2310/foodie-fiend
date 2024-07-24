<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'order_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'account_number' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'transaction_evidence' => [
                'type' => 'TEXT',
                'default' => null,
            ],
            'is_delete' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('order_id', 'orders', 'id');
        $this->forge->createTable('payments', true);

        // Menambah kolom 'method' untuk metode pembayaran dengan type ENUM menggunakan query manual
        $this->db->query("ALTER TABLE `payments` ADD `method` ENUM('cod', 'transfer') NOT NULL DEFAULT 'cod'");
    }

    public function down()
    {
        $this->forge->dropTable('payments', true);
    }
}
