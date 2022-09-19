<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $loginModel = new \App\Models\Admin;
        $UserModel = new \App\Models\UserModel();
        $undangaModel = new \App\Models\UndanganModel();
        $datarapatModel = new \App\Models\DataRapatModel();
        if ($loginModel->logged_id()) {
            $data['title'] = "Home";
            $data['valmenu'] = "dashboard";
            $data['pmenu'] = "dashboard";
            // return view('modal-contoh',$data);

            $datauser =  $UserModel->findAll();
            $data['users'] = $datauser;

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

            $thisyear = date('Y');
            $builder2 = $db->query("SELECT count(kode_rapat) as id, month(tanggal) as bulan FROM `tb_data_rapat` where year(tanggal) ='$thisyear' group by month(tanggal)")->getResult();
            $term = array();
            $dataPoints = [];
            foreach ($builder2 as $a) {
                $dataPoints[] = array(
                    "name" => $this->bulan($a->bulan),
                    "y" => intval($a->id),
                );

                array_push($term, $this->bulan($a->bulan));
            }

            $data['data'] = json_encode($dataPoints);
            $data['terms'] = json_encode(array('juli', 'september'));


            $data['jumlahUser'] = $julmahdata->id;
            $data['userAktif'] = $userAktif->id;
            $data['bulanini'] = $this->bulan(date('m'));
            $data['userTidakAktif'] = $userTidakAktif->id;
            $wheredatarapat = "month(tanggal) =" . date('m') . " and year(tanggal) =" . date('Y');
            $data['rapatbulanini'] = $datarapatModel->where($wheredatarapat)->find();
            if (session()->get('level') == 5) {
                return view('homeuser', $data);
            } else {
                return view('home', $data);
            }
        } else {
            return view('login');
        }
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
}