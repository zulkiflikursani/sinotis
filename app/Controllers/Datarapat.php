<?php

namespace App\Controllers;

class Datarapat extends BaseController
{
    public function index()
    {
        $data['title']= "Data Rapat";
        $data['valmenu']="dashboard";
		$data['pmenu']= "dashboard";
        // return view('modal-contoh',$data);
        return view('data-rapat',$data);
        
    }

    public function detailrapat(){
        $data['title']= "Detail Rapat";
        $data['valmenu']="dashboard";
		$data['pmenu']= "dashboard";
        // return view('modal-contoh',$data);
        return view('detail-rapat',$data);
    }
}
