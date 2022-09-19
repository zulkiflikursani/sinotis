<?php

namespace App\Models;

use CodeIgniter\Model;

class UndanganModel extends Model
{
    protected $table      = 'tb_undangan';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'nomor', 'klasifikasi', 'lampiran', 'ruangan', 'pakaian', 'perihal', 'nip', 'kepada', 'namafile', 'tanggal', 'mulai', 'sampai', 'isi', 'status'];


    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


}