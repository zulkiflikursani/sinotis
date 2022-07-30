<?php
include "header.php";
?>
<div clas='row'>
    <h3>Manajemen User</h3>
</div>
<div class="row">
    <div class="col-md-11 box-background">
        <a data-bs-toggle="modal" data-bs-target="#modalManajemenUser"><button class='btn btn-primary mb-3'>Tambah
                User</button></a>
        <table class='cell-border' id='tableuser'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
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
                    <td for='id'><?= $a['id'] ?></td>
                    <td for='username'><?= $a['user_name'] ?></td>
                    <td for='email'><?= $a['email'] ?></td>
                    <td for='level' lvl='<?= $a['level'] ?>'><?= $lvl ?></td>
                    <td for='status' sts='<?= $a['status'] ?>'><?= $status ?></td>
                    <td for='update_at'><?= $a['update_at'] ?></td>
                    <td><a class='btn btn-sm btn-secondary' onclick="getThis($(this))" data-bs-toggle="modal"
                            data-bs-target="#modalEditUser"><i class="bi bi-pencil"></i> Edit </a></td>
                </tr>
                <?php
                }

                ?>



            </tbody>
        </table>
    </div>
</div>
<!-- modal add user -->
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalManajemenUserLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center w-100">
                    <h5 class="modal-title" id="modalEditUserLabel">Edit User</h5>
                </div>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id='form-updateUser'>
                <input type="text" name="euserid" id="euserid" value="" hidden>
                <div class="modal-body">

                    <div class="row col-12">
                        <div class="col-12 row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Level</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="elevel" id="eLevel">
                                    <option value="">Pilih Level</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kelapa</option>
                                    <option value="3">Kasubag</option>
                                    <option value="4">User</option>
                                </select>
                            </div>
                        </div>
                        <div div class="col-12 row">
                            <label for="inputNama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name='eusername' id="eusername">
                            </div>
                        </div>

                        <div class="col-12 row px-4">
                            <div class="row col-11">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" name='estatus' id="1"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Aktif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="0" name='estatus' id="0">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" onclick="updateUser()" class="btn btn-primary">Simpan Data</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- end-model edit user-->
<!-- modal add user -->
<div class="modal fade" id="modalManajemenUser" tabindex="-1" role="dialog" aria-labelledby="modalManajemenUserLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center w-100">
                    <h5 class="modal-title" id="modalManajemenUserLabel">Manajemen User</h5>
                </div>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id='form-addUser'>
                    <div class="row col-12">
                        <div class="col-6 row">
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Level</label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="level" id="Level">
                                        <option value="">Pilih Level</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Kelapa</option>
                                        <option value="3">Kasubag</option>
                                        <option value="4">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Alamat Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Email" name="email">
                                </div>
                            </div>

                        </div>
                        <div class="col-6 row">
                            <label for="inputNama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name='username'>
                            </div>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="row col-6">
                            <div class="mb-3 row">
                                <label for="inputPassword1" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name='pass1' class="form-control" id="inputPassword1">
                                </div>
                            </div>
                        </div>
                        <div class="row col-6">
                            <div class="mb-3 row">
                                <label for="inputPassword1" class="col-sm-6 name='pass2' col-form-label">Ulang
                                    Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="inputPassword2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" onclick="addUser()" class="btn btn-primary">Simpan Data</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end-model add user-->


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

    function getThis(ini) {
        id = ini.parent().parent().find("td[for=id]").html();
        username = ini.parent().parent().find("td[for=username]").html();
        level = ini.parent().parent().find("td[for=level]").attr('lvl');
        status = ini.parent().parent().find("td[for=status]").attr('sts');
        $('#eusername').val(username)
        $('#euserid').val(id)
        selectElement('eLevel', level)
        statusaktif = document.getElementById('1');
        statustidakakitf = document.getElementById('0');
        if (status == 1) {
            statusaktif.checked = true;
            statustidakakitf.checked = false;
        } else {
            statusaktif.checked = false;
            statustidakakitf.checked = true;
        }
    }

    function selectElement(id, valueToSelect) {
        let element = document.getElementById(id);
        element.value = valueToSelect;
    }


    function addUser() {
        url = "<?php echo base_url('Manajemenuser/addUser') ?>"
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form-addUser').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data['status'] == true) {
                    document.getElementById("form-addUser").reset();
                    $('#modalManajemenUser').modal('hide')

                    $('#message').html('Tambah User Sukses')
                    $('.modal-notif').modal('show')

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#message').html('Tamabah User Gagal')
                $('.modal-notif').modal('show')
            }

        })
    }

    function updateUser() {
        url = "<?php echo base_url('Manajemenuser/udpateUser') ?>"
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form-updateUser').serialize(),
            dataType: "JSON",
            success: function(data) {
                // console.log(data)
                if (data['status'] == true) {
                    document.getElementById("form-updateUser").reset();
                    $('#modalEditUser').modal('hide')
                    $('#message').html('Edit User Sukses')
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