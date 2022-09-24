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
            'nama_lengkap' => $this->db->escapeString($this->request->getPost('namelengkap')),
            'pangkat' => $this->db->escapeString($this->request->getPost('pangkat')),
            'nip' => $this->db->escapeString($this->request->getPost('nip')),
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
    public function editUser()
    {
        $db      = \Config\Database::connect();
        $UserBuilder = $db->table('tb_user');
        $pass1 = $this->db->escapeString($this->request->getPost('pass1'));
        $pass2 = $this->db->escapeString($this->request->getPost('pass1'));
        $passlama = $this->db->escapeString($this->request->getPost('passlama'));
        $userid = $this->db->escapeString($this->request->getPost('userid'));
        $result = $UserBuilder->where('pass', $passlama)->selectCount('id')->get()->getRow();
        $file = $this->request->getFile('my_file');
        // print_r($file);

        if ($result->id > 0) {
            if (($file->getName() != "")) {
                // Where the file is going to be stored
                $target_dir = "img/profil/";
                $file = $file->getName();
                $path = pathinfo($file);
                $filename = session()->get('id');
                $ext = $path['extension'];
                $temp_name = $_FILES['my_file']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;

                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                    // echo "Sorry, file already exists.";
                    unlink($path_filename_ext);
                    move_uploaded_file($temp_name, $path_filename_ext);
                    $statusupload = "ok";
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);
                    $statusupload = "ok";
                }
            }
            if ($statusupload == "ok") {
                $data = array(
                    // 'level' => $this->db->escapeString($this->request->getPost('elevel')),
                    'nama_lengkap' => $this->db->escapeString($this->request->getPost('namalengkap')),
                    'pass' => $this->db->escapeString($this->request->getPost('pass1')),

                );


                try {
                    $updateuser = $UserBuilder->where('id', $userid)->update($data);
                    if ($updateuser) {
                        echo json_encode(array("status" => TRUE, 'message', 'success'));
                    }
                } catch (\Exception $e) {
                    echo json_encode(array("status" => FALSE, 'message', 'gagal'));
                    // echo $e->getMessage();
                }
            } else {
                echo json_encode(array("status" => FALSE, 'message', 'gagal upload image'));
            }
        } else {
            echo json_encode(array("status" => FALSE, "message" => "Password Salah"));
            //
        }
    }
}