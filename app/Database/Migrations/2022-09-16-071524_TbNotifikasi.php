<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbNotifikasi extends Migration
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
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'sender' => [
                'type' => 'VARCHAR',
                'constraint' => '100'

            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'categori' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'message' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'update_at  DATETIME DEFAULT CURRENT_TIMESTAMP'



        ]);
        // $this->forge->addKey('id', TRUE);
        $this->forge->addKey('id', TRUE);

        //membuat table
        $this->forge->createTable('tb_notifikasi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tb_notifikasi', TRUE);
    }
}