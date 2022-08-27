<?php
include "header.php";
?>
<div clas='row'>
    <h3>Undangan Rapat</h3>
</div>

<div class='body'>
    <form action="" id='form-undangan'>
        <div class="row col-11 mb-2">
            <label for="nomor" class="col-2 col-form-label-sm">Nomor</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="nomor" name='nomor'>
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="tanggal" class="col-2 col-form-label">Tanggal Rapat</label>
            <div class="col-sm-4">
                <input type="date" id='tanggal' date-format="dd/mm/yyyy" name="tanggal" class="col-sm-4 form-control ">
            </div>
        </div>
        <div class=" row col-11 mb-2">
            <label for="klas" class="col-2 col-form-label-sm">Klasifikasi</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="klas" name='klas'>
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="lamp" class="col-2 col-form-label-sm">Lampiran</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="lamp" name='lamp'>
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="hal" class="col-2 col-form-label-sm">Perihal</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="hal" name="hal">
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="kepala" class="col-2 col-form-label-sm">Kepada</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="kepala" name="kepada">
            </div>
        </div>

        <div class="row col-11 mb-2">
            <label for="isi" class="col-11 col-form-label-sm">isi</label>
            <div class="col-sm-11">
                <textarea class="form-control" id="isi" name="isi" rows="3"></textarea>
            </div>
        </div>
        <div class=" row col-11 mb-2 form-check">
            <label for="fileLamp" class="col-4 col-form-label">Masukkan Lampiran</label>
            <input type="file" id='fileLamp' name="fileLamp" class="col-sm-4 form-control-file">
        </div>
        <div class=" row col-11 mb-2">
            <div class="d-flex justify-content-center">
                <input type="button" onclick="addUndangan()" class="btn btn-primary mt-4" value="Simpan Undangan ">

            </div>
        </div>
    </form>
</div>

<?php
include "footer.php";
?>

<script src="jquery/dist/jquery-3.5.1.js"></script>
<script src="bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
<script src="jquery/dist/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> -->


<script type="text/javascript">
$(document).ready(function() {


    // $('#exampleModal').modal('show');
});

function addUndangan() {
    url = "<?php echo base_url('UndanganRapat/addUndangan') ?>"
    var formData = new FormData($("#form-undangan")[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(data) {
            if (data['status'] == true) {
                document.getElementById("form-undangan").reset();
                $('#message').html('Tambah Jenis Rapat Sukses')
                $('.modal-notif').modal('show')
            } else {
                $('#message').html('Tambah Jenis Rapat Gagak ' + data['message'])
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