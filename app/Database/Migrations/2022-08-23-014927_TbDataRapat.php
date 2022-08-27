<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbDataRapat extends Migration
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
            'kode_rapat' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'tanngal_rapat' => [
                'type' => 'datetime'
                
            ],
            'nama_rapat' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'pengisi_rapat' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'tema_rapat' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'update_at  DATETIME DEFAULT CURRENT_TIMESTAMP'



        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addKey('kode_rapat', TRUE);

        //membuat table
        $this->forge->createTable('tb_data_rapat', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tb_data_rapat', TRUE);
    }
}