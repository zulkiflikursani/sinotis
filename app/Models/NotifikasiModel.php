<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'tb_notifikasi';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'user_id', 'sender', 'status', 'categori', 'message', 'update_at'];


    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';
    // protected $deletedField = 'deleted_at';


}