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
                'nama_lengkap'  => 'Nurul',
                'pangkat'  => 'pangkatnya',
                'nip'  => '1927389127',
                'status' => '1',
                'level' => '1',
                'pass' => 'admin'

            ],
            [
                'user_name' => 'testing1',
                'email'  => 'testing1@gmail.com',
                'nama_lengkap'  => 'Nurul 2',
                'pangkat'  => 'pangkat 2',
                'nip'  => '39248083',
                'status' => '1',
                'level' => '2',
                'pass' => 'admin'
            ],
            [
                'user_name' => 'testing2',
                'email'  => 'testing2@gmail.com',
                'nama_lengkap'  => 'Nurul 3',
                'pangkat'  => 'pangkat 3a',
                'nip'  => '90535908309583',
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