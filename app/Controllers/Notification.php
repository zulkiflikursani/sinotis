<?php

namespace App\Controllers;

class Notification extends BaseController
{
    public function index()
    {

        $data['title'] = 'judul notif';
        $data['msg'] = 'notif_msg';
        $data['icon'] = 'https://phpzag.com/demo/push-notification-system-with-php-mysql-demo/avatar.png';
        $data['url'] = 'https://phpzag.com';
        $rows[] = $data;
        // $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($key['notif_repeat']*60));
        $array['notif'] = $rows;
        $array['count'] = 1;
        $array['result'] = true;
        echo json_encode($array);
    }

    public function addnotif()
    {
        $data = array(
            'user_id' => $this->db->escapeString($this->request->getPost('user_id')),
            'sender' => $this->db->escapeString($this->request->getPost('sender')),
            'status' => $this->db->escapeString($this->request->getPost('status')),
            'message' => $this->db->escapeString($this->request->getPost('message')),

        );
        $notifModel = new \App\Models\NotifikasiModel();
        $addNotif = $notifModel->insert($data);
    }
    public function refreshnotif()
    {
        $notifModel = new \App\Models\NotifikasiModel();
        $notif['data'] = $notifModel->where('status', 0)->where('user_id', session()->get('id'))->findAll();
        $db      = \Config\Database::connect();
        $notif['count'] = $db->table('tb_notifikasi')->where('status', 0)->where('user_id', session()->get('id'))->countAllResults();
        if ($notif['data'] != null) {
            $notif['status'] = 'ok';
        } else {
            $notif['status'] = 'no';
        }

        echo json_encode($notif, true);
    }

    public function removestatus()
    {
        $id = $this->db->escapeString($this->request->getGet('id'));
        $notifModel = new \App\Models\NotifikasiModel();
        $notif['data'] = $notifModel->set('status', 1)->where('user_id', session()->get('id'))->where('id', $id)->update();
        if ($notif['data'] != null) {
            $notif['status'] = 'ok';
        } else {
            $notif['status'] = 'no';
        }
        echo json_encode($notif, true);
    }
}