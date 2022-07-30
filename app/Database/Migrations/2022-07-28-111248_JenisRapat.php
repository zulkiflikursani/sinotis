<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisRapat extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'jenis_rapat' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '5'
            ],
            'update_at  DATETIME DEFAULT CURRENT_TIMESTAMP'



        ]);
        $this->forge->addKey('id', TRUE);

        //membuat table
        $this->forge->createTable('tbJenis_rapat', TRUE);
    }

    public function down()
    {
        //
    }
}