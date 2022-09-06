<?php

namespace App\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use CodeIgniter\I18n\Time;


class UndanganRapat extends BaseController
{
    public function index()
    {
        $loginModel = new \App\Models\Admin;
        $UndanganModel = new \App\Models\UndanganModel();
        $UserModel = new \App\Models\UserModel();
        if ($loginModel->logged_id()) {
            $data['title'] = "Undangan Rapat";
            $data['valmenu'] = "dashboard";
            $data['pmenu'] = "dashboard";
            // return view('modal-contoh',$data);
            $data['undangan'] = $UndanganModel->groupBy("nomor")->findAll();
            $data['users'] = $UserModel->findAll();

            return view('undangan-rapat', $data);
        } else {
            return view('login');

        }

    }


    public function addUndangan()
    {

 
        
        $tanggal = $this->db->escapeString($this->request->getPost('tgl')); //2022-09-06
        $tanggalsurat= date('l',strtotime($tanggal));
        $hari =  $this->hariIndo($tanggalsurat);

        $explodetglrapat = explode('-',$tanggal);
        $tahun1 = $explodetglrapat[0];
        $bulan1 = $explodetglrapat[1];
        $day1  = $explodetglrapat[2];
        $bulan1 = $this->bulan($bulan1);
        $tanggalrapat = $day1." ".$bulan1." ".$tahun1;
      
      


        $today = Time::today('America/Chicago', 'en_US');
        $updateat=date("d-m-Y", strtotime($today));;
        $explodetgl = explode('-',$updateat);
        $day = $explodetgl[0];
        $bulan = $explodetgl[1];
        $tahun  = $explodetgl[2];
        $bulanindo = $this->bulan($bulan);
        $update_at = $day." ".$bulanindo." ".$tahun;   
        
        $UndanganModel = new \App\Models\UndanganModel();
        $kepada = $this->request->getPost('kepada');

        $filename = str_replace("/","",$this->db->escapeString($this->request->getPost('nomor')));
        
        foreach($kepada as $a){
            $nama = $this->getNama($a);
            $data = array(
                'nomor' => $this->db->escapeString($this->request->getPost('nomor')),
                'klasifikasi' => $this->db->escapeString($this->request->getPost('klas')),
                'lampiran' => $this->db->escapeString($this->request->getPost('lamp')),
                'perihal' => $this->db->escapeString($this->request->getPost('hal')),
                'ruangan' => $this->db->escapeString($this->request->getPost('ruangan')),
                'kepada' => $nama,
                'namafile' => $filename.$a,
                'isi' => $this->db->escapeString($this->request->getPost('isi')),
                'pakaian' => $this->db->escapeString($this->request->getPost('pakaian')),
                'tanggal' => $this->db->escapeString($this->request->getPost('tgl')),
                'mulai' => $this->db->escapeString($this->request->getPost('mulai')),
                'sampai' => $this->db->escapeString($this->request->getPost('sampai')),
                'status' => 0,

            );
            $datasurat = array(
                'nomor' => $this->db->escapeString($this->request->getPost('nomor')),
                'klasifikasi' => $this->db->escapeString($this->request->getPost('klas')),
                'lampiran' => $this->db->escapeString($this->request->getPost('lamp')),
                'perihal' => $this->db->escapeString($this->request->getPost('hal')),
                'ruangan' => $this->db->escapeString($this->request->getPost('ruangan')),
                'kepada' => $nama,
                'hari' =>$hari,
                'namafile' => $filename.$a,
                'isi' => $this->db->escapeString($this->request->getPost('isi')),
                'tanggal' => $tanggalrapat,
                'mulai' => $this->db->escapeString($this->request->getPost('mulai')),
                'sampai' => $this->db->escapeString($this->request->getPost('sampai')),
                'pakaian' => $this->db->escapeString($this->request->getPost('pakaian')),
                'alamat' => "Jln. Batara Bira KM. 16 No. 5 Makassar",
                'userkepala' => "User Kepala",
                'nipkepala' => "NIP Kepala",
                'pangkat' => "PANGKAT",
                'update_at' =>$update_at,

            );
            try {
                $addUndangan = $UndanganModel->insert($data);
                $this->generate_undangan($datasurat);
    
                $status = "ok";
                // echo json_encode(array("status" => true, "message" => "success"));
    
            } catch (\Exception $e) {
                $status ='gagal';
                echo json_encode(array("status" => false, "message" => $e->getMessage()));
                // echo $e->getMessage();
            }
           
        }
        if($status == "ok"){
            echo json_encode(array("status" => true, "message" => "success"));
        }
    }

    public function bulan($bulan)
        {
        Switch ($bulan){
            case 1 : $bulan="Januari";
                Break;
            case 2 : $bulan="Februari";
                Break;
            case 3 : $bulan="Maret";
                Break;
            case 4 : $bulan="April";
                Break;
            case 5 : $bulan="Mei";
                Break;
            case 6 : $bulan="Juni";
                Break;
            case 7 : $bulan="Juli";
                Break;
            case 8 : $bulan="Agustus";
                Break;
            case 9 : $bulan="September";
                Break;
            case 10 : $bulan="Oktober";
                Break;
            case 11 : $bulan="November";
                Break;
            case 12 : $bulan="Desember";
                Break;
            }
        return $bulan;
        }
    public function hariIndo ($hariInggris) {
        switch ($hariInggris) {
          case 'Sunday':
            return 'Minggu';
          case 'Monday':
            return 'Senin';
          case 'Tuesday':
            return 'Selasa';
          case 'Wednesday':
            return 'Rabu';
          case 'Thursday':
            return 'Kamis';
          case 'Friday':
            return 'Jumat';
          case 'Saturday':
            return 'Sabtu';
          default:
            return 'hari tidak valid';
        }
      }

    public function getNama($id){
        $UserModel = new \App\Models\UserModel();
        
        $nama  = $UserModel->where('nip', $id)->find();
        foreach($nama as $result){
            $results =$result['nama_lengkap'];
        }

        return $results;
        
    }
    // public function generate_undangan($nomorsurat,$klasifikasi,$perihal,$kepada,$isi,$ruangrapat,$alamat,$pakaian,$userkepala,$nipkepala,$update_at)
    public function generate_undangan($data)
    {
        $templateProcessor = new TemplateProcessor("template/templatesuratundanganrapat.docx");
        $templateProcessor->setValue('nomorsurat', $data['nomor']);
        $templateProcessor->setValue('klasifikasi', $data['klasifikasi']);
        $templateProcessor->setValue('perihal', $data['perihal']);
        $templateProcessor->setValue('lampiran', $data['lampiran']);
        $templateProcessor->setValue('kepada', $data['kepada']);
        $templateProcessor->setValue('isi', $data['isi']);
        $templateProcessor->setValue('ruangrapat',$data['ruangan']);
        $templateProcessor->setValue('Hari',$data['hari']);
        $templateProcessor->setValue('tanggal_rapat',$data['tanggal']);
        $templateProcessor->setValue('jammulai',$data['mulai']);
        $templateProcessor->setValue('alamat', $data['alamat']);
        $templateProcessor->setValue('pakaian', $data['pakaian']);
        $templateProcessor->setValue('userkepala', $data['userkepala']);
        $templateProcessor->setValue('nip_kepala', $data['nipkepala']);
        $templateProcessor->setValue('pangkat', $data['pangkat']);
        $templateProcessor->setValue('update_at', $data['update_at']);

        // $filename = str_replace($nomorsurat,"/","");
        $pathToSave = 'files/'.$data['namafile'].".docx";
        $templateProcessor->saveAs($pathToSave);
    }

    public function tambahrapat()
    {
        $UserModel = new \App\Models\UserModel();

        $data['title'] = "Tambah Undangan Rapat";
        $data['valmenu'] = "dashboard";
        $data['pmenu'] = "dashboard";
        // return view('modal-contoh',$data);
        $data['users'] = $UserModel->findAll();
        return view('tambah-undangan-rapat', $data);
    }
    public function editrapat($id)
    {
        $UndanganModel = new \App\Models\UndanganModel();

        // $nomor = this->db->escapeString($this->request->getGet('nomor'));
        $data['title'] = "Edit Undangan Rapat";
        $data['valmenu'] = "dashboard";
        $data['pmenu'] = "dashboard";

        $data['rapat'] = $UndanganModel->findAll($id);
        // $data['nomor']= $is;
        // return view('modal-contoh',$data);
        return view('edit-undangan-rapat', $data);
    }
}