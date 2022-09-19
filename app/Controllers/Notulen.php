<?php

namespace App\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use CodeIgniter\I18n\Time;
use stdClass;

class Notulen extends BaseController
{
    public function index($id)
    {



        $loginModel = new \App\Models\Admin;
        if ($loginModel->logged_id()) {
            $data['title'] = "Home";
            $data['valmenu'] = "dashboard";
            $data['pmenu'] = "dashboard";

            $datarapatModel = new \App\Models\DataRapatModel;

            $data['datarapat'] = $datarapatModel->find($id);

            $data['id'] = $id;
            return view('notulen', $data);
        } else {
            return view('login');
        }
    }

    public function addnotulen()
    {
        $nomor = $this->db->escapeString($this->request->getPost('nomor'));
        $data = array(
            'nomor' => $this->db->escapeString($this->request->getPost('nomor')),
            'penulis' => $this->db->escapeString($this->request->getPost('penulis')),
            'jabatan' => $this->db->escapeString($this->request->getPost('jabatan')),
            'devisi' => $this->db->escapeString($this->request->getPost('devisi')),
            'nip' => $this->db->escapeString($this->request->getPost('nip')),
            'hasil' => $this->db->escapeString($this->request->getPost('isi')),
            'status' => 0,
        );
        $notulenModel = new \App\Models\NotulenModel;
        $error = '';
        try {
            $this->db->transStart();
            $addnotulen = $notulenModel->insert($data);
            $notifModel = new \App\Models\NotifikasiModel();
            $sekuser = $this->selectSekertaris();

            $datanotif = array(
                'user_id' => $sekuser,
                'sender' => session()->get('id'),
                'categori' => "Validasi",
                'message' => $nomor,
                'status' => 0
            );
            // print_r($datanotif);
            $addNotif = $notifModel->insert($datanotif);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            exit($e->getMessage());
        }
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $status = "no";
        } else {
            $this->db->transCommit();
            $status = "ok";
        }

        if ($status == 'ok') {
            // $sekuser = $this->selectSekertaris();

            echo json_encode(array("status" => true, "message" => "success", 'user_to_notif' => $sekuser));
        } else {
            echo json_encode(array("status" => false, "message" => $error));
        }
    }

    public function validasinotulen()
    {
        $loginModel = new \App\Models\Admin;
        if ($loginModel->logged_id()) {
            $data['title'] = "Validasi Notulen";
            $data['valmenu'] = "Validasi_Notulen";
            $data['pmenu'] = "Validasi_Notulen";

            $notulenModel = new \App\Models\NotulenModel();
            $db      = \Config\Database::connect();
            $datanotulen = $db->query("select tb_notulen.*, tb_data_rapat.nama_rapat from tb_notulen left join tb_data_rapat on tb_notulen.nomor=tb_data_rapat.kode_rapat")->getResult();
            if ($datanotulen != null) {
                $data['notulen'] = $datanotulen;
            } else {
                $data['notulen'] = "no data";
            }
            return view('validasinotulen', $data);
        } else {
            return view('login');
        }
    }
    public function validasi()
    {
        $idnotulen = $this->db->escapeString($this->request->getPost('notulen'));

        $notulenModel = new \App\Models\NotulenModel();
        $selectNotule = $notulenModel->where('id', $idnotulen)->findAll();
        foreach ($selectNotule as $b) {
            $getnip = $b['nip'];
            $nomor = $b['nomor'];
        };
        $user_to_notif = $this->getIdUser($getnip);
        foreach ($user_to_notif as $c) {
            $cid = $c->id;
            $datanotif = array(
                'user_id' => $c->id,
                'sender' => session()->get('id'),
                'categori' => "Telah Divalidasi",
                'message' => $nomor,
                'status' => 0
            );
            $notifModel = new \App\Models\NotifikasiModel();
            $addNotif = $notifModel->insert($datanotif);
        };


        try {
            $db      = \Config\Database::connect();
            $aksi = $this->request->getPost('aksi');
            if (isset($aksi)) {
                $validasi = $db->query("update tb_notulen set status='0' where id='$idnotulen'");
            } else {

                $validasi = $db->query("update tb_notulen set status='1' where id='$idnotulen'");
            }

            if ($validasi) {
                $data['status'] = true;
                $data['user_to_notif'] = $cid;
            } else {
                $data['status'] = false;
            }
        } catch (\Throwable $th) {
            //throw $th;
            $data['status'] = false;
        }

        echo json_encode($data);
    }

    public function getIdUser($nip)
    {
        $db      = \Config\Database::connect();
        $validasi = $db->query("select id from tb_user where nip = '$nip'")->getResult();
        return $validasi;
    }

    public function outputdaftarhadir()
    {
        $kode_rapat = $this->db->escapeString($this->request->getGet('kode_rapat'));
        $db      = \Config\Database::connect();
        $getidrapat =
            $getDataRapat = $db->query("select tb_undangan.*,tb_user.pangkat from tb_undangan left join tb_user on tb_undangan.nip= tb_user.nip where tb_undangan.nomor='$kode_rapat';");
        if ($getDataRapat->getResult() != null) {
            $datarapat = $getDataRapat->getResult();
        } else {
            return false;
        }

        $i = 0;
        $datapeserta = [];
        foreach ($datarapat as $a) {
            // echo $i;

            $tanggalsurat = date('l', strtotime($a->tanggal));
            $hari =  $this->hariIndo($tanggalsurat);

            $peserta = $this->getJumlahPeserta($a->nomor);

            $today = Time::today('America/Chicago', 'en_US');
            $updateat = date("d-m-Y", strtotime($today));
            $explodetgl = explode('-', $updateat);
            $day = $explodetgl[0];
            $bulan = $explodetgl[1];
            $tahun  = $explodetgl[2];
            $bulanindo = $this->bulan($bulan);
            $update_at = $day . " " . $bulanindo . " " . $tahun;


            $explodetglrapat = explode('-', $a->tanggal);
            $tahun1 = $explodetglrapat[0];
            $bulan1 = $explodetglrapat[1];
            $day1  = $explodetglrapat[2];
            $bulan1 = $this->bulan($bulan1);
            $tanggalrapat = $day1 . " " . $bulan1 . " " . $tahun1;

            $data = array(
                "hari" => $hari,
                "tanggal" => $tanggalrapat,
                "mulai" => date("h:i", strtotime($a->mulai)),
                "ruangan" => $a->ruangan,
                "perihal" => $a->perihal,
                "tanggalbuat" => $update_at,
                "namasekertaris" => "",
                "pangkatsekertaris" => "",
                "nipsekertaris" => "",
                "namafile" => "Absensi_" . $a->id
            );
            // $datapeserta = [];

            $value = array(
                "userId" => $i + 1,
                "namapeserta" => $a->kepada,
                "nip" => $a->nip,
                "pangkat" => $a->pangkat,
                "jabatan" => $a->pangkat,
            );
            $datapeserta[] = (object)$value;
            $i++;
        }
        // print_r($datapeserta);
        $generatenotulen = $this->generate_absen($data, $datapeserta);
        if ($generatenotulen['status'] == true) {
            // $sekuser = $this->selectSekertaris();

            echo json_encode(array("status" => true, "message" => "success", "link" => $generatenotulen['path']));
        } else {
            echo json_encode(array("status" => false, "message" => "gagal mendownload file"));
        }
    }
    public function outputnotulen()
    {
        $idnotulen = $this->db->escapeString($this->request->getGet('idnotulen'));
        $db      = \Config\Database::connect();
        $getDataNotulen = $db->query("SELECT tb_notulen.id,tb_notulen.nomor, tb_notulen.penulis,tb_notulen.jabatan,tb_notulen.devisi,tb_notulen.devisi,tb_notulen.nip as nip_notulen,tb_notulen.hasil,tb_notulen.status as status_notulen,tb_notulen.update_at,tb_undangan.* FROM `tb_notulen` LEFT JOIN tb_undangan on tb_notulen.nomor= tb_undangan.nomor where tb_notulen.id='$idnotulen' GROUP by tb_notulen.id;");
        if ($getDataNotulen->getResult() != null) {
            $datanotulen = $getDataNotulen->getResult();
        } else {
            return false;
        }

        foreach ($datanotulen as $a) {
            $tanggalsurat = date('l', strtotime($a->tanggal));
            $hari =  $this->hariIndo($tanggalsurat);

            $peserta = $this->getJumlahPeserta($a->nomor);

            $today = Time::today('America/Chicago', 'en_US');
            $updateat = date("d-m-Y", strtotime($today));
            $explodetgl = explode('-', $updateat);
            $day = $explodetgl[0];
            $bulan = $explodetgl[1];
            $tahun  = $explodetgl[2];
            $bulanindo = $this->bulan($bulan);
            $update_at = $day . " " . $bulanindo . " " . $tahun;


            $explodetglrapat = explode('-', $a->tanggal);
            $tahun1 = $explodetglrapat[0];
            $bulan1 = $explodetglrapat[1];
            $day1  = $explodetglrapat[2];
            $bulan1 = $this->bulan($bulan1);
            $tanggalrapat = $day1 . " " . $bulan1 . " " . $tahun1;

            $data = array(
                "hari" => $hari,
                "tanggal" => $tanggalrapat,
                "mulai" => $a->mulai,
                "ruangan" => $a->ruangan,
                "pimpinan" => "Nama Pimpinan",
                "nip_pimpinan" => "465464654",
                "peserta" => $peserta,
                "tanggalbuat" => $update_at,
                "pangkatpimpinan" => "Pangkat PImpinan",
                "notulen" => $a->penulis,
                "nip_notulen" => $a->nip_notulen,
                "isi" => $a->hasil,
                "namafile" => "Notulen_" . $idnotulen
            );
        }

        $generatenotulen = $this->generate_notulen($data);
        if ($generatenotulen['status'] == true) {
            // $sekuser = $this->selectSekertaris();

            echo json_encode(array("status" => true, "message" => "success", "link" => $generatenotulen['path']));
        } else {
            echo json_encode(array("status" => false, "message" => "gagal mendownload file"));
        }
    }
    public function generate_absen($data, $datapeserta)
    {
        $templateProcessor = new TemplateProcessor("template/templatedaftarhadir.docx");

        $templateProcessor->setValue('hari', $data['hari']);
        $templateProcessor->setValue('tanggal', $data['tanggal']);
        $templateProcessor->setValue('mulai', $data['mulai']);
        $templateProcessor->setValue('ruangan', $data['ruangan']);
        $templateProcessor->setValue('perihal', $data['perihal']);
        // $templateProcessor->setValue('tanggalbuat', $data['tanggalbuat']);
        $templateProcessor->setValue('namasekertaris', $data['namasekertaris']);
        $templateProcessor->setValue('pangkatsekertaris', $data['pangkatsekertaris']);
        $templateProcessor->setValue('nipsekertaris', $data['nipsekertaris']);

        $templateProcessor->cloneRowAndSetValues('userId', $datapeserta);
        // $filename = str_replace($nomorsurat,"/","");
        $pathToSave = 'files/absen/' . $data['namafile'] . ".docx";
        $templateProcessor->saveAs($pathToSave);
        if (file_exists($pathToSave) > 0) {

            return array('status' => true, 'path' => $pathToSave);
            // unlink($pathToSave);  // re
        } else {
            return  array('status' => false, 'path' => '');;
        }
    }

    public function generate_notulen($data)
    {
        $templateProcessor = new TemplateProcessor("template/template_notulen.docx");

        $templateProcessor->setValue('hari', $data['hari']);
        $templateProcessor->setValue('tanggal', $data['tanggal']);
        $templateProcessor->setValue('mulai', $data['mulai']);
        $templateProcessor->setValue('ruangan', $data['ruangan']);
        $templateProcessor->setValue('pimpinan', $data['pimpinan']);
        $templateProcessor->setValue('nip_pimpinan', $data['nip_pimpinan']);
        $templateProcessor->setValue('peserta', $data['peserta']);
        // $templateProcessor->setValue('isi', $data['hari']);
        $templateProcessor->setValue('tanggalbuat', $data['tanggalbuat']);
        $templateProcessor->setValue('pangkatpimpinan', $data['pangkatpimpinan']);
        $templateProcessor->setValue('notulen', $data['notulen']);
        $templateProcessor->setValue('nip_notulen', $data['nip_notulen']);

        $textData = str_replace('</p><p>', "\n", $data['isi']);
        // $textData = str_replace('<p>', "", $textData);
        // $textData = str_replace('</p>', "", $textData);
        $textData = explode("\n", $textData);
        $replacements = [];
        foreach ($textData as $text) {
            $replacements[] = ['text' => strip_tags($text)];
        };
        // print_r($replacements);
        $templateProcessor->cloneBlock('paragraph', count($replacements), true, false, $replacements);

        // $filename = str_replace($nomorsurat,"/","");
        $pathToSave = 'files/notulen/' . $data['namafile'] . ".docx";
        $templateProcessor->saveAs($pathToSave);
        if (file_exists($pathToSave) > 0) {

            return array('status' => true, 'path' => $pathToSave);
            // unlink($pathToSave);  // re
        } else {
            return  array('status' => false, 'path' => '');;
        }
    }


    public function getJumlahPeserta($nomorsurat)
    {
        $db      = \Config\Database::connect();
        $getDataNotulen = $db->query("SELECT count(id) as jumlah FROM `tb_undangan` where tb_undangan.nomor='$nomorsurat'");
        if ($getDataNotulen->getResult() != null) {
            foreach ($getDataNotulen->getResult() as $a) {
                return $a->jumlah;
            }
        } else {
            return false;
        }
    }
    public function selectSekertaris()
    {
        $userModel = new \App\Models\UserModel();
        $sekUser = $userModel->where('level', 2)->findAll();
        $usersek = array();
        foreach ($sekUser as $a) {
            array_push($usersek, $a['id']);
        }
        return $usersek;
    }
    public function bulan($bulan)
    {
        switch ($bulan) {
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
        }
        return $bulan;
    }
    public function hariIndo($hariInggris)
    {
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

    public function getNama($id)
    {
        $UserModel = new \App\Models\UserModel();

        $nama  = $UserModel->where('nip', $id)->find();
        foreach ($nama as $result) {
            $results = $result['nama_lengkap'];
        }

        return $results;
    }
}