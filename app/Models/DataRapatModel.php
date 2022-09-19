<?php

namespace App\Models;

use CodeIgniter\Model;

class DataRapatModel extends Model
{
    protected $table      = 'tb_data_rapat';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'kode_rapat', 'tanggal', 'nama_rapat', 'pengisi_rapat', 'tema_rapat', 'mulai', 'sampai', 'status', 'update_at'];


    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


}