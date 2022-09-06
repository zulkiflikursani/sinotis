<?php

namespace App\Controllers;

class GoogleDocView extends BaseController
{
    public function index()
    {
        $loginModel = new \App\Models\Admin;
        $jenisRapatModel = new \App\Models\JenisRapatModel();

        $data['title'] = "Jenis Rapat";
        $data['valmenu'] = "dashboard";
        $data['pmenu'] = "dashboard";
        // return view('modal-contoh',$data);
        $data['jenisRapat'] = $jenisRapatModel->findAll();

        return view('google-doc-views', $data);
    }
}