<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use phpDocumentor\Reflection\PseudoTypes\True_;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ],
            'level' => [
                'type' => 'VARCHAR',
                'constraint' => '5'
            ],
            'pass' => [
                'type' => 'VARCHAR',
                'constraint' => '300'
            ],
            'update_at  DATETIME DEFAULT CURRENT_TIMESTAMP'

        ]);

        //membuat primery key
        $this->forge->addKey('id', TRUE);

        //membuat table
        $this->forge->createTable('tb_user', TRUE);
    }

    public function down()
    {
        //Menghapus table
        $this->forge->dropTable('tb_user');
    }
}