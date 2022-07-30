<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisRapatSeeder extends Seeder
{
    public function run()
    {
        $datarapat = [
            [
                'jenis_rapat' => 'jenis 1',
                'status'  => '1'

            ],
            [
                'jenis_rapat' => 'jenis 2',
                'status'  => '1'

            ],
            [
                'jenis_rapat' => 'jenis 3',
                'status'  => '1'

            ],
        ];
        foreach ($datarapat as $data) {
            // insert semua data ke tabel
            $this->db->table('tbJenis_rapat')->insert($data);
        }
    }
}