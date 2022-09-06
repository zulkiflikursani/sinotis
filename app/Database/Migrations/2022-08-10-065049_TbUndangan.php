<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbUndangan extends Migration
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
            'klasifikasi' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'lampiran' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'perihal' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'kepada' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'ruangan' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'pakaian' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'isi' => [
                'type' => 'VARCHAR',
                'constraint' => '10000'
            ],
            'namafile' => [
                'type' => 'VARCHAR',
                'constraint' => '10000'
            ],
            'tanggal' => [
                'type' => 'date',
                
            ],
            'mulai' => [
                'type' => 'time',
                
            ],
            'sampai' => [
                'type' => 'time',
                
            ],
            'update_at  DATETIME DEFAULT CURRENT_TIMESTAMP'



        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addKey('nomor', TRUE);

        //membuat table
        $this->forge->createTable('tb_undangan', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tb_undangan', TRUE);
    }
}