<?php

namespace App\Models;

use CodeIgniter\Model;

class NotulenModel extends Model
{
    protected $table      = 'tb_notulen';
    protected $primaryKey = 'nomor';

    protected $allowedFields = ['nomor', 'penulis', 'jabatan', 'devisi', 'nip', 'hasil', 'status', 'update_at'];


    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


}