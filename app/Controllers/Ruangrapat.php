<?php

namespace App\Controllers;

class Ruangrapat extends BaseController
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

        return view('jenis-rapat', $data);
    }
    public function addRapat()
    {
        $data = array(
            'jenis_rapat' => $this->db->escapeString($this->request->getPost('jenisrapat')),
            'status' => 1,
        );
        $jenisRapatModel = new \App\Models\JenisRapatModel();

        try {
            $addRapat = $jenisRapatModel->insert($data);
            if ($addRapat) {
                echo json_encode(array("status" => true));
            }
        } catch (\Exception $e) {
            echo json_encode(array("status" => false));
            echo $e->getMessage();
        }
    }
    public function editRapat()
    {
        $data = array(
            'id' => $this->db->escapeString($this->request->getPost('eId')),
            'jenis_rapat' => $this->db->escapeString($this->request->getPost('ejenisrapat')),
            'status' => $this->db->escapeString($this->request->getPost('eStatus')),
        );
        $jenisRapatModel = new \App\Models\JenisRapatModel();

        try {
            $addRapat = $jenisRapatModel->save($data);
            if ($addRapat) {
                echo json_encode(array("status" => true));
            }
        } catch (\Exception $e) {
            echo json_encode(array("status" => false));
            echo $e->getMessage();
        }
    }

}