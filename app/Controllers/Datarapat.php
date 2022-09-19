<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use PhpParser\Node\Stmt\TryCatch;

class Datarapat extends BaseController
{
    public function index()
    {
        $DatarapatModel = new \App\Models\DataRapatModel();
        $data['title'] = "Data Rapat";
        $data['valmenu'] = "dashboard";
        $data['pmenu'] = "dashboard";
        // return view('modal-contoh',$data);
        $data['undangan'] = $DatarapatModel->findAll();
        $today = Time::today('Asia/Makassar', 'en_US');
        $updateat = date("Y-m-d", strtotime($today));

        $data['today'] = $updateat;
        return view('data-rapat', $data);
    }

    public function detailrapat($id)
    {
        $data['title'] = "Detail Rapat";
        $data['valmenu'] = "dashboard";
        $data['pmenu'] = "dashboard";
        // return view('modal-contoh',$data);

        $db      = \Config\Database::connect();
        $getDataRapat = $db->query("SELECT tb_data_rapat.id, a.tanggal, tb_data_rapat.kode_rapat, tb_data_rapat.nama_rapat, a.nip, a.kepada AS peserta, a.ruangan, tb_data_rapat.mulai, tb_data_rapat.sampai, a.pangkat, '' AS nohp, a.status, tb_notulen.nip as nip_notulen, tb_notulen.penulis as nama_notulen, tb_notulen.id as id_notulen FROM tb_data_rapat LEFT JOIN( SELECT tb_undangan.*, tb_user.user_name, tb_user.nama_lengkap, tb_user.pangkat, tb_user.email, tb_user.status AS status_user, tb_user.level FROM tb_undangan LEFT JOIN tb_user ON tb_undangan.nip = tb_user.nip ) a ON tb_data_rapat.kode_rapat = a.nomor LEFT JOIN tb_notulen on tb_data_rapat.kode_rapat = tb_notulen.nomor WHERE tb_data_rapat.id ='$id'");
        if ($getDataRapat->getResult() != null) {
            $datarapat = $getDataRapat->getResult();
        } else {
            return false;
        }
        $today = Time::today('Asia/Makassar', 'en_US');
        $updateat = date("Y-m-d", strtotime($today));

        $data['today'] = $updateat;


        $data['id'] = $id;
        $data['detailrapat'] = $datarapat;
        return view('detail-rapat', $data);
    }

    public function editStatus()
    {
        $nomor = $this->db->escapeString($this->request->getPost('nomor'));
        $status = $this->db->escapeString($this->request->getPost('eStatus'));

        try {
            //code...
            $datarapatModel = new \App\Models\DataRapatModel();
            $updatestatus = $datarapatModel->set('status', $status)->where('kode_rapat', $nomor)->update();
            echo json_encode(array("status" => true, "message" => "success"));
        } catch (\Throwable $e) {
            $error = $e->getMessage();
            echo json_encode(array("status" => false, "message" => "gagal " . $error));
            // exit($e->getMessage());
            //throw $th;
        }
    }
}