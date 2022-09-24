<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tb_user';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'user_name', 'nama_lengkap', 'pangkat', 'nip', 'email', 'status', 'level', 'pass',];


    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


}