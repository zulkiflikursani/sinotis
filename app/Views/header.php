<?php
// $pmenu = "";
// $pt= session()->get("kode_entitas");
// $userid = session()->get("user_id");
// $adminmodal = new admin();
// if($pt != "all"){
//     $statususer = $adminmodal->check_statususer($userid);
//     $menu = array();
//     //array("Akun","Kas_Masuk", "Kas_Keluar","Bank_Masuk","Bank_Keluar","Jurnal_Umum","Setting");

//     if(session()->get("lvl_user") == "1")
//     {
//         $menu =array("Akun","Setting_Laporan","Tutup_Buku","Saldo_Awal","Anggaran_Awal","Kas_Masuk", "Kas_Keluar","Bank_Masuk","Bank_Keluar","Jurnal_Umum","Setting","Buku_Besar","Laporan_Keuangan_Deret","Laporan_Keuangan","Laporan_Perbandingan");

//     }else{
//         if($statususer!= false)
//         {
//             foreach($statususer as $field)
//             {
//                 if($field->agrawl == "1"){array_push($menu,"Saldo_Awal");};
//                 if($field->km == "1"){array_push($menu,"Kas_Masuk");};
//                 if($field->kk == "1"){array_push($menu,"Kas_Keluar");};
//                 if($field->bm == "1"){array_push($menu,"Bank_Masuk");};
//                 if($field->bk == "1"){array_push($menu,"Bank_Keluar");};
//                 if($field->um == "1"){array_push($menu,"Jurnal_umum");};
//                 if($field->lap == "1"){array_push($menu,"Laporan_Keuangan");};

//             }
//         }
//     }
// }
// else
// {
//     $menu =array("Akun","Setting_Laporan","Tutup_Buku","Saldo_Awal","Anggaran_Awal","Kas_Masuk", "Kas_Keluar","Bank_Masuk","Bank_Keluar","Jurnal_Umum","Setting","Buku_Besar","Laporan_Keuangan_Deret","Laporan_Keuangan","Laporan_Perbandingan","Konsolidasi");
// }
// $pmenu = $currentmenu;

?>
<!-- begin::Head -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- botstrap material -->
    <link href="<?= base_url() ?>/bs/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
    <!-- <link href="bs/css/bootstrap-icons.css" rel="stylesheet"> -->
    <link href="<?= base_url() ?>/css/jquery.dataTables.min.css" rel="stylesheet">


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/> -->

    <!--end::Web font -->

    <!--begin:: Global Mandatory Vendors -->

    <link rel="stylesheet" href="<?= base_url() ?>/css/all.css?version=52" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css?version=1" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>/css/headfoot.css?version=1" type="text/css" />

    <!--end:: Global Mandatory Vendors -->


</head>

<!-- end::Head -->

<!-- begin::Body -->
<!--

-->


<title><?php echo $title; ?></title>
<header>
    <div class="navigasi">
        <ul>
            <li>
                <div class="left-logo">
                    <img id="logo" src="<?= base_url() ?>/img/logo.png" />

                </div>
                <div class="text-logo">
                    <p>SINOTIS</p>
                </div>
                <div class="topmenu">
                    <?php
                    $a = tanggal_indonesia(date("Y-m-d "));
                    echo "<p>=  " . $a . "&nbsp;</p><p id='clock'></p>";
                    ?>
                </div>
                <div class="logo navbar1">
                    <a href="#" id="notifications">
                        <label for='check' class="icon-button">
                            <span class="material-icons">notifications</span>
                            <span class="icon-button__badge count jumlah-notif">0</span>
                        </label>
                    </a>
                    <input type="checkbox" class="dropdown-check" id="check" />
                    <ul class="dropdown list-notif">
                        <h4 class='border-bottom border-primary'>List Notifikasi</h4>
                        <ul class="dropdown1 list-notif1">
                            <li>1</li>
                            <li>2</li>
                        </ul>
                    </ul>
                </div>
                <div class="logo">
                    <p> <?= session()->get('username') ?></p>
                </div>

            </li>
        </ul>

    </div>
</header>
<div id='konfirmasi'>
    <h3 class="judulform">Konfirmasi</h3>
    <div class="container">
        <div id="konfirmform" class="col-md-12">


        </div>
        <div class="col-md-12">
            <div class="row" id="colpass">
                <label class="col-md-3">Password</label>
                <label class="">:</label>
                <label class="col-md-8"><input id="passkonfirm" type='password' class="form-control m-input" /> </label>
            </div>
            <div class="row">
                <div class='col-md-7'></div>
                <button class="col-md-2 btn btn-primary" id="simpankonf">Submit</button>
                <button class="col-md-2 btn btn-primary" id="closekonf" style="margin-left:20px;">Batal</button>

            </div>

        </div>
    </div>
</div>

<div id="menu2" class="m-scrollable" data-scrollable="true">
    <div id="keterangan">
        Welcome </br><?php echo session()->get("nama_lengkap"); ?></br>
        <!-- <a href="<?php echo base_url() ?>/logout"> <button class="btn btn-sm btn-primary ">Log out</button></a> -->

    </div>



    <?php
    if (session()->get('level') == '1' || session()->get('level') == '2' || session()->get('level') == '3') {

        $menu = array("Home", "Manajemen_User", "Ruang_Rapat", "Undangan_Rapat", "Validasi_Notulen", "Data_Rapat", "Chat_Room", "Logout");
    } else if (session()->get('level') == '5') {
        $menu = array("Home", "Undangan_Rapat", "Data_Rapat", "Chat_Room", "Logout");
    }
    foreach ($menu as $menu) {

        $isimenu = str_replace("_", " ", $menu);
        $menuloc = ucfirst(strtolower($menu));
        $loc = str_replace("_", "", $menuloc);
        $a = base_url() . "/" . $loc;
        if ($menu == $pmenu) {
            //echo '<li class="m-menu__item  m-menu__item--submenu m-menu__item--open" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="'.$a.'" class="m-menu__link m-menu__toggle m-menu__item--open"><i class="m-menu__link-icon flaticon-layers"></i><span class="m-menu__link-text">'.$isimenu.'</span><i
            //                                                         class="m-menu__ver-arrow la la-angle-right"></i></a>
            //                                                </li>';
            echo "<a href=" . $a . "><li class='pilih'><img class='icon-menu' src='" . base_url() . "/img/" . $menu .
                ".png' alt=''>$isimenu</li></a>";
        } else {
            echo "<a href=" . $a . ">
        <li> <img class='icon-menu' src='" . base_url() . "/img/" . $menu . ".png' alt=''>$isimenu</li>
    </a>";
            /*
    echo '<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
    href="'.$a.'" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-layers"></i><span
    class="m-menu__link-text">'.$isimenu.'</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
    </li>';
     */
        };
    }
    ?>



</div>
<div id="body">
    <script src="<?= base_url() ?>/jquery/dist/jquery-3.5.1.js"></script>

    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    <script src="/js/Notification.js"></script>
    <script>
    $(document).ready(function() {
        var conn = new WebSocket('ws://localhost:8080?access_token=<?= session()->get('id') ?>');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };
        refreshnotif()
        conn.onmessage = function(e) {
            console.log(e.data);

            var data = JSON.parse(e.data)
            if ('users' in data) {
                // conso(data.users)
            } else if ('message' in data) {

                if (data.status == 'public') {
                    console.log(data)
                    if (data.author !== '<?= session()->get('username') ?>') {
                        showNotification(data.author, data.message, "chatroom/" + "")
                    };
                } else if (data.status == 'private') {
                    if (data.send_to == '<?= session()->get('id') ?>') {
                        showNotification(data.author, data.message, "Privivate Chat");
                        // newMessage(data)
                    }
                } else if (data.status == 'notif') {
                    if (data.send_to == '<?= session()->get('id') ?>') {
                        showNotification(data.author, data.message, "Notif Rapat");
                        refreshnotif() // newMessage(data)
                    }
                }
            }

        };


    })

    function refreshnotif() {
        url = "<?php echo base_url('Notification/refreshnotif') ?>"

        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                if (data['status'] == 'ok') {
                    $('.jumlah-notif').html(data['count'])
                    $('.list-notif1').children('li').remove();
                    $.each(data['data'], function(a, b) {
                        $('.list-notif1').append("<li onclick='removestatus(" + b['id'] + ")'>" + b[
                                'categori'] + " : " + b['message'] +
                            "</li>")
                    })
                } else {
                    $('.list-notif1').children('li').remove();
                    $('.list-notif1').append("<li>Tidak ada notifikasi</li>");

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText)
                // $('#message').html('Tamabah Undangan Rapat Gagal2'.jqXHR)
                // $('.modal-notif').modal('show')
            }

        })
    }

    function removestatus(ini) {

        url = "<?php echo base_url('Notification/removestatus') ?>"
        var formData = {
            id: ini
        }
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            data: formData,
            success: function(data) {
                window.location = "<?= base_url('Datarapat') ?>";
                console.log(data);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR.responseText)
                // $('#message').html('Tamabah Undangan Rapat Gagal2'.jqXHR)
                // $('.modal-notif').modal('show')
            }
        })
    }

    function currentTime() {
        let date = new Date();
        let hh = date.getHours();
        let mm = date.getMinutes();
        let ss = date.getSeconds();
        let session = "AM";

        if (hh == 0) {
            hh = 12;
        }
        if (hh > 12) {
            hh = hh - 12;
            session = "PM";
        }

        hh = (hh < 10) ? "0" + hh : hh;
        mm = (mm < 10) ? "0" + mm : mm;
        ss = (ss < 10) ? "0" + ss : ss;

        let time = hh + ":" + mm + ":" + ss + " " + session;

        document.getElementById("clock").innerText = time;
        let t = setTimeout(function() {
            currentTime()
        }, 1000);
    }
    currentTime();

    // const beamsClient = new PusherPushNotifications.Client({
    //     instanceId: 'a0c7cde1-ea5c-4616-bfbf-78fd70fbc6f8',
    // });

    // beamsClient.start()
    //     .then(() => beamsClient.addDeviceInterest('hello'))
    //     .then(() => console.log('Successfully registered and subscribed!'))
    //     .catch(console.error);
    </script>
    <?php
    function tanggal_indonesia($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );

        $pecahkan = explode(' ', $tanggal);
        //2022-06-24 12:24:08pm
        $pecahantanggal = explode('-', $pecahkan[0]);
        $pecahanjam = $pecahkan[1];

        return $pecahantanggal[2] . ' ' . $bulan[(int) $pecahantanggal[1]] . ' ' . $pecahantanggal[0] . ' ' . $pecahanjam;
    }

    ?>