<?php
include "header.php";
?>
<div clas='row'>
    <h3>Detail Rapat</h3>
</div>
<?php
foreach ($detailrapat as $a) {
    $namarapat = $a->nama_rapat;
    $tanggal = $a->tanggal;
    $kode_rapat = $a->kode_rapat;
    $kode_rapat = $a->kode_rapat;
    $mulai =  date("h:i", strtotime($a->mulai));
    $sampai =  date("h:i", strtotime($a->sampai));
    $id_notule = $a->id_notulen;
    $cstatus = $a->status;
    if ($cstatus == 2) {
        $status = 'Selesai';
    } else if ($cstatus == 1) {
        $status = 'Aktif';
    } else {
        if ($today > $a->tanggal) {

            $status = 'Proses';
        } else {
            $status = 'Belum diverifikasi';
        }
    }
}
?>
<div class="row">
    <div class="col-md-11 box-background">
        <div class="row col-12">
            <div class="row col-12 ">
                <div class="col-6 d-flex d-flex justify-content-start">
                    <h3 class="text-body fw-bold"><?= $namarapat; ?></h3>
                </div>
                <div class="col-6 d-flex d-flex justify-content-end">
                    <p class="text-body">Tanggal : <?= $tanggal; ?></p>
                </div>
            </div>
            <div class="row col-4">
                <label class="col-form-label-sm fw-bold">No Rapat : <?= $kode_rapat; ?></label>
                <label class="col-form-label-sm">Rapat Kinerja</label>
                <label class="col-form-label-sm">Pengisi : </label>
            </div>
            <div class="row col-4">
                <label class="col-form-label-sm fw-bold">Waktu Acara</label>
                <label class="col-form-label-sm">Mulai : <?= $mulai; ?> WITA</label>
                <label class="col-form-label-sm">Sampai : <?= $sampai; ?> WITA</label>

            </div>

            <div class="row col-4">
                <label class="col-form-label-sm fw-bold">Status Acara</label>
                <label class="col-form-label-sm"><?= $status; ?></label>
                <label class="col-form-label-sm"></label>
            </div>

        </div>

        <div class="col-md-11">
            <a data-bs-toggle="modal" data-bs-target="#modalTambahPeserta"><button class='btn btn-primary mb-3'>Tambah
                    Peserta</button></a>
            <table class='cell-border' id='tableuser'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Peserta</th>
                        <th>No HP</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($detailrapat as $a) {
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $a->peserta ?></td>
                        <td><?= $a->nohp ?></td>
                        <td><?= $a->pangkat ?></td>
                        <td><?= $a->status ?></td>
                        <td><a class='btn btn-sm btn-secondary'>Batal</a></td>

                    </tr>
                    <?php
                        $i++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="">
            <form action="" id='form-notulen'>
                <input type="hidden" name="idnotulen" id='idnotulen' value='<?= $id_notule ?>' />
            </form>
            <form action="" id='form-daftarhadir'>
                <input type="hidden" name="kode_rapat" id='kode_rapat' value='<?= $kode_rapat ?>' />
            </form>
            <button type="button" class="btn btn-primary " onclick="downloaddaftarhadir()">Download Daftar
                Hadir</button>
            <span style='width: 10px'></span>
            <?php if ($id_notule != null) { ?>
            <button type="button" class="btn btn-primary " onclick="downloadnotulen()">Download
                Notulen</button>
            <?php }; ?>
            <span style='width: 10px'></span>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        </div>
    </div>
</div>
<!-- modal tambah peserta -->
<div class="modal fade" id="modalTambahPeserta" tabindex="-1" role="dialog"
    aria-labelledby="modalTambahPesertaRapatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center w-100">
                    <h5 class="modal-title" id="modalTambahPesertaRapatLabel">Tambah Peserta Rapat</h5>
                </div>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row col-12">
                    <div div class="col-12 row mb-3">
                        <label for="inputNama" class="col-sm-4 col-form-label">Jenis Rapat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>

                    <div div class="col-12 row mb-2">
                        <label for="inputNama" class="col-sm-4 col-form-label">Nama Peserta</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="namarapat">
                        </div>
                    </div>
                    <div div class="col-12 row mb-2">
                        <label for="inputNama" class="col-sm-4 col-form-label">No HP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>
                    <div div class="col-12 row mb-2">
                        <label for="inputNama" class="col-sm-4 col-form-label">Sub Bidang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNama">
                        </div>
                    </div>
                    <div div class="col-12 row mb-2">
                        <label for="inputNama" class="col-sm-4 col-form-label">Jabatan</label>
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



<?php
include "footer.php";
?>

<script src="../jquery/dist/jquery-3.5.1.js"></script>
<script src="../bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
<script src="../jquery/dist/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> -->


<script type="text/javascript">
$(document).ready(function() {

    $(' #tableuser').DataTable();
}) // $('#exampleModal').modal('show'); });

function downloaddaftarhadir() {
    url = "<?php echo base_url('outputdaftarhadir') ?>"
    // var formData = new FormData($("#form-notulen")[0]);
    // console.log(formData);
    $.ajax({
        url: url,
        type: "GET",
        data: $('#form-daftarhadir').serialize(),
        dataType: "JSON",
        processData: false,
        contentType: false,
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

function downloadnotulen() {
    url = "<?php echo base_url('outputnotulen') ?>"
    // var formData = new FormData($("#form-notulen")[0]);
    // console.log(formData);
    $.ajax({
        url: url,
        type: "GET",
        data: $('#form-notulen').serialize(),
        dataType: "JSON",
        processData: false,
        contentType: false,
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