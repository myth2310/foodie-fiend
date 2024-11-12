<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'lat' => [
                'type' => 'DECIMAL',
                'constraint' => '10,8',
            ],
            'long' => [
                'type' => 'DECIMAL',
                'constraint' => '11,8',
            ],            
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'profile' => [
                'type' => 'TEXT',
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['user', 'admin', 'store'],
                'default' => 'user',
            ],
            'is_verif' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'verification_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);   
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
