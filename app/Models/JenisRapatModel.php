<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisRapatModel extends Model
{
    protected $table      = 'tbJenis_rapat';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'jenis_rapat', 'status'];


    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


}