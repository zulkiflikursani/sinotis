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

}