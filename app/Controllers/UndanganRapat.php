<?php

namespace App\Controllers;
use CodeIgniter\Files\File;
class UndanganRapat extends BaseController
{
    public function index()
    {
        $loginModel = new \App\Models\Admin;
        $UndanganModel = new \App\Models\UndanganModel();
        if ($loginModel->logged_id()) {
            $data['title']= "Undangan Rapat";
            $data['valmenu']="dashboard";
            $data['pmenu']= "dashboard";
            // return view('modal-contoh',$data);
            $data['undangan']= $UndanganModel->findAll();

            
            return view('undangan-rapat',$data);
            }else{
                return view('login');
            
        }
        
    }
    

    public function addUndangan(){
      
        // $file = $this->request->getFile('fileLamp');
        // $filename = $this->db->escapeString($this->request->getPost('nomor'));
        // $file->move(ROOTPATH . 'public\files',$filename);
        $file = $this->request->getFile('fileLamp');

        $file->move("files");
        $namafile =$file->getName(); 

        $data = array(
            'nomor' => $this->db->escapeString($this->request->getPost('nomor')),
            'klasifikasi' => $this->db->escapeString($this->request->getPost('klas')),
            'lampiran' => $this->db->escapeString($this->request->getPost('lamp')),
            'perihal' => $this->db->escapeString($this->request->getPost('hal')),
            'kepada' => $this->db->escapeString($this->request->getPost('kepada')),
            'namafile' =>$namafile,
            'isi' => $this->db->escapeString($this->request->getPost('isi')),
            'tanggal' => $this->db->escapeString($this->request->getPost('tanggal')),

        );
        $UndanganModel = new \App\Models\UndanganModel();
        try {
            $addUndangan = $UndanganModel->insert($data);
           
                echo json_encode(array("status" => TRUE,"message"=>"success"));
            
        } catch (\Exception $e) {
            echo json_encode(array("status" => FALSE,"message"=>$e->getMessage()));
            // echo $e->getMessage();
        }
    }

    public function tambahrapat(){
        $data['title']= "Tambah Undangan Rapat";
        $data['valmenu']="dashboard";
		$data['pmenu']= "dashboard";
        // return view('modal-contoh',$data);
        return view('tambah-undangan-rapat',$data);
    }
    public function editrapat($id){
        $UndanganModel = new \App\Models\UndanganModel();

        // $nomor = this->db->escapeString($this->request->getGet('nomor'));
        $data['title']= "Edit Undangan Rapat";
        $data['valmenu']="dashboard";
		$data['pmenu']= "dashboard";

        $data['rapat']= $UndanganModel->findAll($id);
        // $data['nomor']= $is;
        // return view('modal-contoh',$data);
        return view('edit-undangan-rapat',$data);
    }
}