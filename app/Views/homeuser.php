<?php
include "header.php";
?>

<div clas='row'>
    <h3>Beranda</h3>
</div>
<div class="box1">
    <p>Selamat Datang, <?= session()->get("username");  ?></p>
    <a data-bs-toggle="modal" data-bs-target="#modalSetting"><img id='setting_icon' src="img/setting-icon.png"
            alt=""></a>

</div>
<div class="row">
    <div class="col-md-11" style='margin-top:10px'>
        <a data-bs-toggle="modal" data-bs-target="#modalAddUser">
            <div class='row box-button m-1 p-1'>
                <div style='float:left;width:80px'>
                    <p class='p1'>0</p>
                    <p class='p2'>User Baru</p>
                </div>
                <img src="img/add-user.png" alt="">
            </div>
        </a>
        <div class='row box-button m-1 p-1'>
            <div style='float:left;width:80px'>
                <p class='p1'><?= $userAktif; ?></p>
                <p class='p2'>User Aktiv</p>
            </div>
            <img src="img/user-aktiv.png" alt="">
        </div>
        <div class='row box-button m-1 p-1'>
            <div style='float:left;width:100px'>
                <p class='p1'><?= $userTidakAktif ?></p>
                <p class='p2'>User Tidak Aktif</p>
            </div>
            <img src="img/user-tidak-aktif.png" alt="">
        </div>
        <div class='row box-button m-1 p-1'>
            <div style='float:left;width:80px'>
                <p class='p1'><?= $jumlahUser; ?></p>
                <p class='p2'>Total User</p>
            </div>
            <img src="img/total-user.png" alt="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="mt-5">
                        <div id="bar-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pt-5 text-center">
                <h3>Data Rapat Bulan <?= $bulanini ?></h3>
                <table class='table table-bordered' style="background-color:#ffff">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Rapat</th>
                            <th>Tanggal</th>
                            <th>Mulai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $i = 1;
                            foreach ($rapatbulanini as $a) {
                            ?>

                            <td><?= $i ?></td>
                            <td><?= $a['nama_rapat'] ?></td>
                            <td><?= date('d-m-Y', strtotime(str_replace('.', '/', $a['tanggal']))); ?> </td>
                            <td><?= $a['mulai'] ?></td>
                            <td><?= $a['status'] ?></td>
                            <?php
                                $i++;
                            } ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- Button trigger modal -->


<!-- Modal Setting -->
<div class="modal fade" id="modalSetting" tabindex="-1" role="dialog" aria-labelledby="modalSettingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center w-100">
                    <h5 class="modal-title" id="modalSettingLabel">Pengaturan</h5>
                </div>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id='form-edituser'>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="col-6 row">
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">

                                    <input type="hidden" class="form-control" id="Email" name='email'
                                        value="<?= session()->get('email') ?>">
                                    <input type="hidden" class="form-control" id="userid" name='userid'
                                        value="<?= session()->get('id') ?>">
                                    <input type="text" class="form-control" id="Email"
                                        value="<?= session()->get('email') ?>" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPasswordlama" class="col-sm-4 col-form-label">Pass Lama</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputPasswordlama" name='passlama'>
                                </div>
                            </div>

                        </div>
                        <div class="col-6 row">
                            <label for="inputNama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputNama"
                                    value="<?= session()->get('nama_lengkap') ?>" name='namalengkap'>
                            </div>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="row col-6">
                            <div class="mb-3 row">
                                <label for="inputPassword1" class="col-sm-4 col-form-label">Pass Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputPassword1" name='pass1'>
                                </div>
                            </div>
                        </div>
                        <div class="row col-6">
                            <div class="mb-3 row">
                                <label for="inputPassword1" class="col-sm-6 col-form-label">Ulang Pass Baru</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="inputPassword2" name='pass2'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="mb-3 row">
                            <label for="img" class="col-sm-2 col-form-label">Photo</label>

                            <img class="col-sm-2" id="output" />
                            <input type="file" class="col-sm-6" name='filename' accept="image/*"
                                onchange="loadFile(event)">

                        </div>
                        <script>
                        var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                        </script>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" onclick='edituser()'>Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end-model -->

<?php
include "footer.php";
?>


<script src="jquery/dist/jquery-3.5.1.js"></script>
<script src="bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
<script src="jquery/dist/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
$(function() {
    Highcharts.chart('bar-chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Rapat Tahun <?= date('Y') ?>'
        },
        xAxis: {
            reversed: false,
            type: 'category',
            tickWidth: 0,
            labels: {
                formatter() {
                    if (typeof(this.value) === 'string') {
                        return this.value
                    }
                }
            },
            title: {
                text: 'Bulan'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Rapat'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Jumlah Rapat',
            data: <?= $data ?>
        }]
    });
});

$(document).ready(function() {

    $('#tableuser').DataTable();
    // google.charts.load('visualization', "1", {
    //     packages: ['corechart']
    // });
    // google.charts.setOnLoadCallback(drawBarChart);

    // // Pie Chart
    // google.charts.setOnLoadCallback(showBarChart);

    // // $('#exampleModal').modal('show');
});

function edituser() {
    alert('sd')
    url = "<?php echo base_url('Manajemenuser/editUser') ?>"
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form-edituser').serialize(),
        dataType: "JSON",
        success: function(data) {
            // console.log(data)
            if (data['status'] == true) {
                document.getElementById("form-edituser").reset();
                $('#modalEditUser').modal('hide')
                $('#message').html('Edit User Sukses')
                $('.modal-notif').modal('show')
            } else if (data['status'] == false) {
                document.getElementById("form-edituser").reset();
                $('#modalEditUser').modal('hide')
                $('#message').html('Edit User Gagal ' + data['message'])
                $('.modal-notif').modal('show')
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#message').html("Data User Gagal Diedit")
            $('.modal-notif').modal('show')
        }

    })
}
</script>