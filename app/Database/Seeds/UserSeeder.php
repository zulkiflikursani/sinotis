<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'user_name' => 'Nurul',
                'email'  => 'Nurul@gmail.com',
                'nama_lengkap'  => 'Nurul',
                'pangkat'  => 'Golongan C',
                'nip'  => '123456789',
                'status' => '1',
                'level' => '1',
                'pass' => 'admin'

            ],
            [
                'user_name' => 'NurulSekertaris',
                'email'  => 'Nurul2@gmail.com',
                'nama_lengkap'  => 'Nurul 2',
                'pangkat'  => 'Golongan C',
                'nip'  => '987654321',
                'status' => '1',
                'level' => '2',
                'pass' => 'admin'
            ],
            [
                'user_name' => 'NurulUser',
                'nama_lengkap'  => 'Nurul 3',
                'pangkat'  => 'Golongan C',
                'email'  => 'Nurul3@gmail.com',
                'nip'  => '321654987',
                'status' => '1',
                'level' => '5',
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