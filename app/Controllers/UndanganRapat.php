<?php

namespace App\Controllers;

class UndanganRapat extends BaseController
{
    public function index()
    {
        $data['title']= "Undangan Rapat";
        $data['valmenu']="dashboard";
		$data['pmenu']= "dashboard";
        // return view('modal-contoh',$data);
        return view('undangan-rapat',$data);
        
    }

    public function tambahrapat(){
        $data['title']= "Tambah Undangan Rapat";
        $data['valmenu']="dashboard";
		$data['pmenu']= "dashboard";
        // return view('modal-contoh',$data);
        return view('tambah-undangan-rapat',$data);
    }
    public function editrapat(){
        $data['title']= "Edit Undangan Rapat";
        $data['valmenu']="dashboard";
		$data['pmenu']= "dashboard";
        // return view('modal-contoh',$data);
        return view('edit-undangan-rapat',$data);
    }
}
