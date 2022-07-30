<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $loginModel = new \App\Models\Admin;
        $UserModel = new \App\Models\UserModel();
        if ($loginModel->logged_id()) {
            $data['title'] = "Home";
            $data['valmenu'] = "dashboard";
            $data['pmenu'] = "dashboard";
            // return view('modal-contoh',$data);

            $data['users'] = $UserModel->findAll();

            $db      = \Config\Database::connect();
            $builder = $db->table('tb_user');
            $builder->selectCount('id');
            $julmahdata = $builder->get()->getRow();

            $builder->selectCount('id');
            $builder->where('status', '1');
            $userAktif = $builder->get()->getRow();

            $builder->selectCount('id');
            $builder->where('status', '0');
            $userTidakAktif = $builder->get()->getRow();

            $data['jumlahUser'] = $julmahdata->id;
            $data['userAktif'] = $userAktif->id;
            $data['userTidakAktif'] = $userTidakAktif->id;
            return view('home', $data);
        } else {
            return view('login');
        }
    }
}