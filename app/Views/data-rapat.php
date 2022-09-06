<?php
include "header.php";
?>
<div clas='row'>
    <h3>Data Rapat</h3>
</div>
<div class="row">
    <div class="col-md-11 box-background">
        <!-- <a  data-bs-toggle="modal" data-bs-target="#modalTambahRapat"><button class='btn btn-primary mb-3'>Tambah Rapat</button></a> -->
        <table class='cell-border' id='tableuser'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Perihal</th>
                    <th>Tanggal</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if(isset($undangan)){
                    $i= 1;
                    foreach($undangan as $isi){
                        if($isi['status']==2){
                            $status='Selesa';
                        }else if($isi['status']==1){
                            $status='Aktif';
                        }else{
                            $status='Belum diverifikasi';

                        }
                        ?>

                <tr>
                    <td for="nomor" nmr='<?= $isi['nomor']?>'><?= $i?></td>
                    <td for="perihal"><?= $isi['perihal']?></td>
                    <td for='tgl'><?= $isi['tanggal']?></td>
                    <td for='tgl'><?= $isi['mulai']?></td>
                    <td for='tgl'><?= $isi['sampai']?></td>
                    <td for='status'><?= $status ?></td>
                    <td><a class='btn btn-sm btn-secondary text-decoration-none text-white' href='detailrapat'><i
                                class="bi bi-eye"></i> Peserta</a></td>

                </tr>
                <?php
                    $i++;
                    }
                }
                ?>
                <!-- <tr>
                    <td>1</td>
                    <td>Rapat terbuka</td>
                    <td>21-6-2022</td>
                    <td>Rapat Laporan Kinerja</td>
                    <td>Nurul</td>
                    <td>09:00:00</td>
                    <td>11:00:00</td>
                    <td>aktif</td>
                    <td><a class='btn btn-sm btn-secondary' data-bs-toggle="modal" data-bs-target="#modalEditUser"><i class="bi bi-pencil"></i> Edit </a></td>
                    <td><a class='btn btn-sm btn-secondary text-decoration-none text-white' href='detailrapat'><i class="bi bi-eye"></i> Peserta</a></td>
              
                </tr> -->


            </tbody>
        </table>
    </div>
</div>
<!-- modal add user -->
<div class="modal fade" id="modalTambahRapat" tabindex="-1" role="dialog" aria-labelledby="modalManajemenUserLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center w-100">
                    <h5 class="modal-title" id="modalEditUserLabel">Edit User</h5>
                </div>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row col-12">
                    <div class="col-12 row mb-3">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Jenis Rapat</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="" id="Level">
                                <option value="">Pilih Level</option>
                                <option value="">Rapat Terbuka</option>
                                <option value="">Rapat Tertutup</option>
                                <option value="">Rapat Biasa</option>
                                <option value="">Rapat Lain-lain</option>
                            </select>
                        </div>
                    </div>
                    <div div class="col-12 row mb-3">
                        <label for="inputNama" class="col-sm-4 col-form-label">Kode Rapat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>

                    <div class="col-12 row px-4 mb-2">
                        <div class="row col-4 mx-1">
                            <label for="" class="col-3 col-form-label">Tanggal</label>
                            <input type="date" class='form-control-sm' name="tgl" id="">
                        </div>
                        <div class="row col-3 mx-1">
                            <label for="" class="col-3 col-form-label">Mulai</label>
                            <input type="time" class='form-control-sm' name="mulai" id="">
                        </div>
                        <div class="row col-3 mx-1">
                            <label for="" class="col-3 col-form-label">Sampai</label>
                            <input type="time" class='form-control-sm' name="sampai" id="">
                        </div>
                    </div>
                    <div div class="col-12 row mb-2">
                        <label for="inputNama" class="col-sm-4 col-form-label">Nama Rapat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="namarapat">
                        </div>
                    </div>
                    <div div class="col-12 row mb-2">
                        <label for="inputNama" class="col-sm-4 col-form-label">Pengisi Rapat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>
                    <div div class="col-12 row mb-2">
                        <label for="inputNama" class="col-sm-4 col-form-label">Tema Rapat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-primary">Simpan Data</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
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
                <div class="row col-12">
                    <div class="col-6 row">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Level</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="" id="Level">
                                    <option value="">Pilih Level</option>
                                    <option value="">Admin</option>
                                    <option value="">Kelapa</option>
                                    <option value="">Kasubag</option>
                                    <option value="">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Alamat Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Email" value="">
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
                            <label for="inputPassword1" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword1">
                            </div>
                        </div>
                    </div>
                    <div class="row col-6">
                        <div class="mb-3 row">
                            <label for="inputPassword1" class="col-sm-6 col-form-label">Ulang Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="inputPassword2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary">Simpan Data</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                </div>
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
    </script>