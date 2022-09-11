<?php

namespace App\Controllers;

class ChatRoom extends BaseController
{
    public function index()
    {
        $loginModel = new \App\Models\Admin;
        $UserModel = new \App\Models\UserModel();
        if ($loginModel->logged_id()) {
            $data['title'] = "Home";
            $data['valmenu'] = "dashboard";
            $data['pmenu'] = "dashboard";

            $data['users'] = $UserModel->findAll();

            return view('chatroom', $data);
        } else {
            return view('login');
        }
    }

    public function privatechat($chat_to){
        $loginModel = new \App\Models\Admin;
        $UserModel = new \App\Models\UserModel();
        if ($loginModel->logged_id()) {
            $data['title'] = "Private chat";
            $data['valmenu'] = "chat";
            $data['pmenu'] = "Private chat";

            $data['users'] = $UserModel->findAll();

            $data['chat_to']= $chat_to;
            $data['getAuthor'] = $this->getAuthor($chat_to);

            return view('privatechat', $data);
        } else {
            return view('login');
        }
    }
    public function getChat(){
        $send_to = $this->db->escapeString($this->request->getPost('send_to'));
        $sender = $this->db->escapeString($this->request->getPost('sender'));

        $chatPrivateModel = new \App\Models\PrivateChatModel();
        
        $where = "(send_to='$send_to' AND sender='$sender') OR (send_to='$sender' AND sender='$send_to')";
        $results  = $chatPrivateModel->where($where)->orderBy('update_at','ASC')->find();

        return json_encode($results);
       
       
    }

    public function getAuthor($id){
        $UserModel = new \App\Models\UserModel();
        $results = $UserModel->where('id',$id)->find();
        foreach($results as $b){
            $result = $b['nama_lengkap'];
        }


        return $result;
    }

    public function addChat(){
        $PrivateChatModel = new \App\Models\PrivateChatModel();
                    $data2= [
                        'message' =>$this->db->escapeString($this->request->getPost('msg')),
                        'send_to'=> $this->db->escapeString($this->request->getPost('send_to')),
                        'sender'=> $this->db->escapeString($this->request->getPost('sender')),
                        'time' => date('H:i'),
                        'status'=>'1'
                    ];

                    $savechat = $PrivateChatModel->insert($data2);
                    if($savechat){
                        return true;
                    }else{
                        return false;
                    }
    }
}