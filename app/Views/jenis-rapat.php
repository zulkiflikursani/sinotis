<?php
include "header.php";
?>
<div clas='row'>
    <h3>Ruang Rapat</h3>
</div>
<div class="row">
    <div class="col-md-11 box-background">
        <a data-bs-toggle="modal" data-bs-target="#modalTambahRapat"><button class='btn btn-primary mb-3'>Tambah
                Ruangan
                Rapat</button></a>
        <table class='cell-border' id='tableJenisRapat'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ruang Rapat</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($jenisRapat as $data) {
    if ($data['status'] == '1') {
        $status = "Aktif";
    } else {
        $status = "Tidak Aktif";
    }
    ?>
                <tr>
                    <td for='id'><?=$data['id']?></td>
                    <td for='jenisRapat'><?=$data['jenis_rapat']?></td>
                    <td for='status' sts='<?=$data['status']?>'><?=$status?></td>
                    <td><?=$data['update_at']?></td>
                    <td><a class='btn btn-sm btn-secondary' onclick="getThis($(this))" data-bs-toggle="modal"
                            data-bs-target="#modalEditRapat"><i class="bi bi-pencil"></i> Edit </a></td>

                </tr>

                <?php
}
?>

            </tbody>
        </table>
    </div>
</div>

<!-- modal tambah rapat -->
<div class="modal fade" id="modalTambahRapat" tabindex="-1" role="dialog" aria-labelledby="modalTambahRapatLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center w-100">
                    <h5 class="modal-title" id="modalTambahRapatLabel">Tambah Ruang Rapat</h5>
                </div>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form ction="" id='form-addRapat'>
                <div class="modal-body">
                    <div class="row col-12">
                        <label for="jenisrapat" class="col-form-label">Ruang Rapat</label>
                        <input type="text" class="form-control" name='jenisrapat' id="jenisrapat">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button onclick='addRapat()' type="button" class="btn btn-primary">Simpan Data</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal tambah rapat -->
<!-- modal tambah rapat -->
<div class="modal fade" id="modalEditRapat" tabindex="-1" role="dialog" aria-labelledby="modalEditRapatLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center w-100">
                    <h5 class="modal-title" id="modalEditRapatLabel">Edit Jenis Rapat</h5>
                </div>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id='form-editRapat'>
                <input type="text" name="eId" id="eId" value="" hidden>

                <div class="modal-body">
                    <div class="row col-10 m-4">
                        <label for="inputNama" class="col-form-label">Ruang Rapat</label>
                        <input type="text" class="form-control" id="ejenisrapat" name="ejenisrapat">
                    </div>
                    <div class="row col-10 m-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name='eStatus' id="1" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name='eStatus' id="0">
                            <label class="form-check-label" for="flexCheckChecked">
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" onclick='editRapat()' class="btn btn-primary">Simpan Data</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal tambah rapat -->
<?php
include "footer.php";
?>

<script src="jquery/dist/jquery-3.5.1.js"></script>
<script src="bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
<script src="jquery/dist/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> -->


<script type="text/javascript">
$(document).ready(function() {

    $('#tableJenisRapat').DataTable();
    // $('#exampleModal').modal('show');
});

function getThis(ini) {
    jenisrapat = ini.parent().parent().find('td[for=jenisRapat]').html();
    idrapat = ini.parent().parent().find('td[for=id]').html();
    status = ini.parent().parent().find('td[for=status]').attr('sts');

    $('#eId').val(idrapat)
    $('#ejenisrapat').val(jenisrapat)
    // selectElement('eLevel', level)
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

function addRapat() {
    url = "<?php echo base_url('Ruangrapat/addRapat') ?>"
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form-addRapat').serialize(),
        dataType: "JSON",
        success: function(data) {
            if (data['status'] == true) {
                document.getElementById("form-addRapat").reset();
                $('#modalTambahRapat').modal('hide')

                $('#message').html('Tambah Ruang Rapat Sukses')
                $('.modal-notif').modal('show')

            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#message').html('Tamabah Jenis Rapat Gagal')
            $('.modal-notif').modal('show')
        }

    })
}

function editRapat() {
    url = "<?php echo base_url('Ruangrapat/editRapat') ?>"
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form-editRapat').serialize(),
        dataType: "JSON",
        success: function(data) {
            if (data['status'] == true) {
                document.getElementById("form-editRapat").reset();
                $('#modalTambahRapat').modal('hide')

                $('#message').html('Edit Jenis Rapat Sukses')
                $('.modal-notif').modal('show')

            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#message').html('Edit Jenis Rapat Gagal')
            $('.modal-notif').modal('show')
        }

    })
}
</script>