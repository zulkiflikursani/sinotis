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

    <div class="col-md-11 box-background">
        <table class='cell-border' id='tableuser'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $a) {
                    if ($a['level'] == 1) {
                        $lvl = "Admin";
                    } else if ($a['level'] == 2) {
                        $lvl = "Kepala";
                    } else if ($a['level'] == 3) {
                        $lvl = "Kasubag";
                    } else if ($a['level'] == 4) {
                        $lvl = "User";
                    }

                    if ($a['status'] == 1) {
                        $status = "Aktif";
                    } else if ($a['status'] == 0) {
                        $status = "Tidak Aktif";
                    }
                ?>
                <tr>
                    <td><?= $a['id'] ?></td>
                    <td><?= $a['user_name'] ?></td>
                    <td><?= $a['email'] ?></td>
                    <td><?= $lvl ?></td>
                    <td><?= $status ?></td>
                    <td><?= $a['update_at'] ?></td>
                </tr>

                <?php
                }

                ?>


            </tbody>
        </table>
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
            <div class="modal-body">
                <div class="row col-12">
                    <div class="col-6 row">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Email" value="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPasswordlama" class="col-sm-4 col-form-label">Pass Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPasswordlama">
                            </div>
                        </div>

                    </div>
                    <div class="col-6 row">
                        <label for="inputNama" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>
                </div>

                <div class="row col-12">
                    <div class="row col-6">
                        <div class="mb-3 row">
                            <label for="inputPassword1" class="col-sm-4 col-form-label">Pass Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword1">
                            </div>
                        </div>
                    </div>
                    <div class="row col-6">
                        <div class="mb-3 row">
                            <label for="inputPassword1" class="col-sm-6 col-form-label">Ulang Pass Baru</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="inputPassword2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="mb-3 row">
                        <label for="img" class="col-sm-2 col-form-label">Photo</label>

                        <img class="col-sm-2" id="output" />
                        <input type="file" class="col-sm-6" accept="image/*" onchange="loadFile(event)">

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
                <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
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


<script type="text/javascript">
$(document).ready(function() {

    $('#tableuser').DataTable();
    // $('#exampleModal').modal('show');
});
</script>