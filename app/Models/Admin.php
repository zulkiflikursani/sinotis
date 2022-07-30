<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{


    function logged_id()
    {
        if (session()->get('username') == null) {
            return false;
        } else {
            return session()->get('username');
        };
    }

    function check_login($table, $field1, $field2)
    {
        $query1 = "select * from $table where user_name='$field1' and  pass='$field2' limit 1";


        $builder = $this->db->query($query1);

        $query = $builder->getResult();

        return $query;
    }
    function check_statususer($iduser)
    {
        // $this->db->select('*');
        // $this->db->from("tb_usr2");

        // $this->db->where($iduser);
        // $this->db->limit(1);
        $query1 = "select * from s where a='$iduser'  limit 1";
        $builder = $this->db->query($query1);

        if ($builder->getResult() != null) {
            return $builder->getResult();
        } else {
            return FALSE;
        };
    }
}