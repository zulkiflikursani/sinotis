<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PrivateChat extends Migration
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
        'sender' => [
            'type' => 'VARCHAR',
            'constraint' => '100'
        ],
        'send_to' => [
            'type' => 'VARCHAR',
            'constraint' => '100'
        ],
        'message' => [
            'type' => 'VARCHAR',
            'constraint' => '100'
        ],
        'time' => [
            'type' => 'time',
            
        ],
        'status' => [
            'type' => 'VARCHAR',
            'constraint' => '10'
        ],
        'update_at  DATETIME DEFAULT CURRENT_TIMESTAMP'



    ]);
    $this->forge->addKey('id', TRUE);
    
    //membuat table
    $this->forge->createTable('tb_private_chat', TRUE);
}

public function down()
{
    $this->forge->dropTable('tb_private_chat', TRUE);
}
}