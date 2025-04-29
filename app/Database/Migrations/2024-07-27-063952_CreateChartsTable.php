<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChartsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'user_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'menu_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'store_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'default' => 1,
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
        // $this->forge->addForeignKey('user_id', 'users', 'id');
        // $this->forge->addForeignKey('menu_id', 'menus', 'id');

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('store_id', 'stores', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('charts', true);
    }

    public function down()
    {
        $this->forge->dropTable('charts', true);
    }
}
