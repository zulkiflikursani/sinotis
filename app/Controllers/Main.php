<?php

namespace App\Controllers;



class Main extends BaseController
{

    protected $adminModel;
    public function __construct()
    {
        //load model admin

    }
    public function index()
    {
        $userModel = new \App\Models\Admin;

        if ($userModel->logged_id()) {

            //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
            // $this->logout();
            // return redirect('/controller/Welcome');
            return redirect()->to(base_url('Home'));
            // return view("welcome");
        } else {


            //jika session belum terdaftar
            $validation =  \Config\Services::validation();
            // //set form validation
            // $validation->setRule('username', 'Username', 'required');
            // $validation->setRule('password', 'Password', 'required');
            $validation->setRules(
                [
                    'email' => 'required',
                    'password' => 'required'
                ],
                [   // Errors
                    'email' => [
                        'required' => 'All accounts must have usernames provided',
                    ],
                    'password' => [
                        'min_length' => 'Your password is too short. You want to get hacked?'
                    ]
                ]
            );
            //set message form validation
            // $validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
            //     <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            //cek validasi


            if ($validation->withRequest($this->request)->run() == TRUE) {



                //get data dari FORM
                $username = $this->request->getPost("email");
                $password = $this->request->getPost('password');
                //$password = $this->input->post('password', TRUE);

                // checking data via model
                $checking = $userModel->check_login('tb_user', $username, $password);

                // jika ditemukan, maka create session

                if ($checking != FALSE) {

                    //    echo $checking;
                    foreach ($checking as $apps) {

                        $session_data = array(
                            'email'   => $apps->email,
                            'username' => $apps->user_name,
                            'level' => $apps->level,
                            'status' => $apps->status,
                        );
                        //set session userdata
                        session()->set($session_data);
                        return redirect()->to(base_url('Home'));
                    }
                } else {
                    $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
                    return  view('login', $data);
                }
            } else {

                $data['error'] = $validation->listErrors();

                return  view('login', $data);
                // $this->load->view('wid/maintenence');

            }
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('Home'));
    }

    //--------------------------------------------------------------------

}