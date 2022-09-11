<?php

namespace App\Models;

use CodeIgniter\Model;

class PrivateChatModel extends Model
{
    protected $table      = 'tb_private_chat';
    protected $primaryKey = 'nomor';

    protected $allowedFields = ['id', 'sender', 'send_to','message','time','status','update_at'];


    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


}