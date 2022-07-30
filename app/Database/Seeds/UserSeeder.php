<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'user_name' => 'testing',
                'email'  => 'testing@gmail.com',
                'status' => '1',
                'level' => '1',
                'pass' => 'admin'

            ],
            [
                'user_name' => 'testing1',
                'email'  => 'testing1@gmail.com',
                'status' => '1',
                'level' => '2',
                'pass' => 'admin'
            ],
            [
                'user_name' => 'testing2',
                'email'  => 'testing2@gmail.com',
                'status' => '1',
                'level' => '3',
                'pass' => 'admin'
            ]
        ];
        foreach ($users as $data) {
            // insert semua data ke tabel
            $this->db->table('tb_user')->insert($data);
        }
        //
    }
}