<?php

namespace App\Controllers;

class ManajemenUser extends BaseController
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

            return view('manajemen-user', $data);
        } else {
            return view('login');
        }
    }

    public function addUser()
    {
        $data = array(
            'user_name' => $this->db->escapeString($this->request->getPost('username')),
            'email' => $this->db->escapeString($this->request->getPost('email')),
            'level' => $this->db->escapeString($this->request->getPost('level')),
            'status' => "1",
            'pass' => $this->db->escapeString($this->request->getPost('pass1')),

        );
        $UserModel = new \App\Models\UserModel();
        try {
            $addUser = $UserModel->insert($data);
            if ($addUser) {
                echo json_encode(array("status" => TRUE));
            }
        } catch (\Exception $e) {
            echo json_encode(array("status" => FALSE));
            echo $e->getMessage();
        }
    }

    public function udpateUser()
    {
        $data = array(
            'id' => $this->db->escapeString($this->request->getPost('euserid')),
            'user_name' => $this->db->escapeString($this->request->getPost('eusername')),
            'level' => $this->db->escapeString($this->request->getPost('elevel')),
            'status' => $this->db->escapeString($this->request->getPost('estatus')),

        );
        $UserModel = new \App\Models\UserModel();
        try {
            $updateuser = $UserModel->save($data);
            if ($updateuser) {
                echo json_encode(array("status" => TRUE));
            }
        } catch (\Exception $e) {
            echo json_encode(array("status" => FALSE));
            echo $e->getMessage();
        }
    }
}