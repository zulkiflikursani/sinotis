<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbNotulen extends Migration
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
            'nomor' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => '100'

            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'devisi' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'hasil' => [
                'type' => 'TEXT',
                'null' => true
            ],

            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100'

            ],
            'update_at  DATETIME DEFAULT CURRENT_TIMESTAMP'



        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addKey('nomor', TRUE);

        //membuat table
        $this->forge->createTable('tb_notulen', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tb_notulen', TRUE);
    }
}