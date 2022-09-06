<?php

namespace App\Models;

use CodeIgniter\Model;

class UndanganModel extends Model
{
    protected $table      = 'tb_undangan';
    protected $primaryKey = 'nomor';

    protected $allowedFields = ['nomor', 'klasifikasi', 'lampiran','ruangan','pakaian','perihal','kepada','namafile','tanggal','mulai','sampai','isi','status'];


    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


}