<?php
include "header.php";
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>


<body>
    <div clas='row'>
        <h3>Validasi Notule</h3>
    </div>

    <div class="row">
        <div class="col-md-11 box-background">
            <table class='cell-border' id='tablenotulen'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Rapat</th>
                        <th>Penulis</th>
                        <th>Perihal</th>
                        <!-- <th>status</th> -->
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // print_r($notulen);
                    if ($notulen == "no data") {
                    } else {
                        foreach ($notulen as $a) {
                    ?>
                    <tr>
                        <td><?= $a->id ?></td>
                        <td><?= $a->nomor ?></td>
                        <td><?= $a->penulis ?></td>
                        <td><?= $a->nama_rapat ?></td>
                        <td><?php if ($a->status == 1) {
                                        echo "<button onclick='unvalidasi(" . $a->id . ")' class='btn btn-sm btn-primary'>Sudah
                            Divalidasi</button>";
                                    } else {
                                        echo "<button onclick='validasi(" . $a->id . ")' class='btn btn-sm btn-warning'>Belum Divalidasi</button>";
                                    } ?>
                            <button class='btn btn-sm btn-primary' onclick="downloadnotulen(<?= $a->id ?>)">Download
                                Notulen</button>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
    <script src="../jquery/dist/jquery-3.5.1.js"></script>
    <script src="../bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="../jquery/dist/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tablenotulen').DataTable();

    });

    function validasi(idnotulen) {
        var conn = new WebSocket('ws://localhost:8080?access_token=<?= session()->get('id') ?>');
        var statuscon;
        conn.onopen = function(e) {
            console.log("Connection established!");
            statuscon = 'connected';
        };

        url = "<?php echo base_url('validasinotulen') ?>"
        var dataform = {
            notulen: idnotulen
        }

        $.ajax({
            url: url,
            type: "POST",
            data: dataform,
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                if (data['status'] == true) {

                    var data1 = {
                        msg: 'UNDANGAN RAPAT',
                        status: "notif",
                        send_to: data['user_to_notif']
                    }
                    console.log(data1);
                    $('#message').html('Berhasil Mengganti Validasi Notulen')
                    $('.modal-notif').modal('show')
                    setTimeout(function() {
                        conn.send(JSON.stringify(data1));
                    }, 1000)
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
                $('#message').html('Gagal Mengganti Validasi Notulen' + jqXHR.responseText)
                $('.modal-notif').modal('show')

            }

        })
        this.send = function(message, callback) {
            this.waitForConnection(function() {
                conn.send(message)
                if (typeof callback !== 'undefined') {
                    callback();
                }
            }, 1000)
        }

        this.waitForConnection = function(callback, inverval) {
            if (conn.readyState === 1) {
                callback()
            } else {
                var that = this;
                setInterval(function() {
                    that.waitForConnection(callback, interval);
                }, interval);
            }
        }
    }




    function unvalidasi(idnotulen) {
        var conn = new WebSocket('ws://localhost:8080?access_token=<?= session()->get('id') ?>');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        url = "<?php echo base_url('validasinotulen') ?>"
        var dataform = {
            notulen: idnotulen,
            aksi: 'edit'
        }

        $.ajax({
            url: url,
            type: "POST",
            data: dataform,
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                if (data['status'] == true) {
                    var data1 = {
                        msg: 'UNDANGAN RAPAT',
                        status: "notif",
                        send_to: data['user_to_notif']
                    }
                    console.log(data1);
                    $('#message').html('Berhasil Mengganti Validasi Notulen')
                    $('.modal-notif').modal('show')
                }
                setTimeout(function() {
                    conn.send(JSON.stringify(data1));
                }, 1000)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
                $('#message').html('Gagal Mengganti Validasi Notulen' + jqXHR.responseText)
                $('.modal-notif').modal('show')

            }

        })
    }

    function downloadnotulen(idnotulen1) {
        url = "<?php echo base_url('outputnotulen') ?>"
        // var formData = new FormData($("#form-notulen")[0]);
        // console.log(formData);

        var dataform = {
            idnotulen: idnotulen1
        }

        $.ajax({
            url: url,
            type: "GET",
            data: dataform,
            dataType: "JSON",

            success: function(data) {
                console.log(data);
                if (data['status'] == true) {
                    // document.getElementById("form-notulen").reset();
                    window.open('<?= base_url() ?>/' + data['link'], '_blank');
                    $('#message').html('Berhasil Mendownload Notulen')
                    $('.modal-notif').modal('show')
                } else {
                    $('#message').html('Gagal Mendownload Notulen ' + data['message'])
                    $('.modal-notif').modal('show')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
                $('#message').html('Cetak Notulen Gagal' + jqXHR.responseText)
                $('.modal-notif').modal('show')

            }

        })
    }
    </script>
    </div>
</body>