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
                    <th>Notulen</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($undangan)) {
                    $i = 1;
                    foreach ($undangan as $isi) {

                        if ($isi['status'] == 2) {
                            $status = 'Selesai';
                        } else if ($isi['status'] == 1) {
                            $status = 'Aktif';
                        } else {
                            if ($today > $isi['tanggal']) {

                                $status = '<a class="">Proses</a>';
                            } else {
                                $status = 'Belum diverifikasi';
                            }
                        }

                        $ceknotulen = ceknotulen($isi['kode_rapat']);
                        if ($ceknotulen == true) {
                            $notulen = "<button class='btn btn-sm btn-secondary'> Sudah ada Notulen</button>";
                        } else {

                            $notulen = "<a href='Notulen/" . $isi['id'] . "'><button
                            class='button btn btn-sm btn-primary'>Notulen</button></a>";
                        }
                ?>

                <tr>
                    <td for="nomor" nmr='<?= $isi['kode_rapat'] ?>' sts='<?= $isi['status'] ?>'><a
                            onclick="getStatusRapat($(this))"><i class="bi bi-send"></i></a></td>
                    <td for="perihal"><?= $isi['nama_rapat'] ?></td>
                    <td for='tgl'><?= $isi['tanggal'] ?></td>
                    <td for='tgl'><?= $isi['mulai'] ?></td>
                    <td for='tgl'><?= $isi['sampai'] ?></td>
                    <td for='status'><?= $status ?></td>
                    <td for='tgl'><?= $notulen ?></a></td>
                    <td><a class='btn btn-sm btn-secondary text-decoration-none text-white'
                            href='detailrapat/<?= $isi['id'] ?>'><i class="bi bi-eye"></i> Peserta</a></td>

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
    <!-- modal tambah rapat -->
    <div class="modal fade" id="modelEditStatusRapat" tabindex="-1" role="dialog"
        aria-labelledby="modalEditStatusRapatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="modalEditStatusRapattLabel">Staus Rapat</h5>
                    </div>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id='form-editStatus'>
                    <div class="modal-body">
                        <div class="row col-12">
                            <label for="jenisrapat" class="col-form-label">Kode Rapat</label>
                            <input type="hidden" name="nomor" id='nomor'>
                            <input type="text" class="form-control" name='dnomor' id="dnomor" disabled=true>
                        </div>
                        <div class="row col-12">
                            <label for="jenisrapat" class="col-form-label">Nama Rapat</label>
                            <input type="text" class="form-control" name='nama' id="nama" disabled=true>
                        </div>
                        <div class="row col-10 m-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name='eStatus' id="1" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Proses
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="2" name='eStatus' id="0">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button onclick='editStatus()' type="button" class="btn btn-primary">Simpan Data</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

function ceknotulen($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('tb_notulen');
    $builder->selectCount('id')->where('nomor', $id);
    $julmahdata = $builder->get()->getRow();
    if ($julmahdata->id > 0) {
        return true;
    } else {
        return false;
    }
}

?>


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

function getStatusRapat(ini) {

    nomor = ini.parent().attr('nmr');
    status = ini.parent().attr('sts');
    nama = ini.parent().parent().find('td[for=perihal]').html();

    statusproses = document.getElementById('1');
    statusselesai = document.getElementById('0');
    if (status == 0) {
        statusproses.checked = true;
        statusselesai.checked = false;
    } else {
        statusproses.checked = false;
        statusselesai.checked = true;
    }

    $('#dnomor').val(nomor)
    $('#nomor').val(nomor)
    $('#nama').val(nama)
    $('#modelEditStatusRapat').modal('show');
}

function editStatus() {
    url = "<?php echo base_url('Datarapat/editstatus') ?>"
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form-editStatus').serialize(),
        dataType: "JSON",
        success: function(data) {
            if (data['status'] == true) {
                document.getElementById("form-editStatus").reset();
                $('#modelEditStatusRapat').modal('hide')

                $('#message').html('Status Rapat Berhasil diedit')
                $('.modal-notif').modal('show')

            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#message').html('Tamabah Jenis Rapat Gagal')
            $('.modal-notif').modal('show')
        }

    })
}
</script>