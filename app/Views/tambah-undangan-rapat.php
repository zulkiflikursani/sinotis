<?php
include "header.php";
?>
<div clas='row'>
<h3>Undangan Rapat</h3>
</div>

<div class='body'>
    <div class="row col-11 mb-2">
            <label for="inputNama" class="col-2 col-form-label-sm">Jenis Rapat</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="inputNama">
            </div>
    </div>
    <div class="row col-11 mb-2">
            <label for="inputNama" class="col-2 col-form-label-sm">Klasifikasi</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="inputNama">
            </div>
    </div>
    <div class="row col-11 mb-2">
            <label for="inputNama" class="col-2 col-form-label-sm">Lampiran</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="inputNama">
            </div>
    </div>
    <div class="row col-11 mb-2">
            <label for="inputNama" class="col-2 col-form-label-sm">Perihal</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="inputNama">
            </div>
    </div>
    <div class="row col-11 mb-2">
            <label for="inputNama" class="col-2 col-form-label-sm">Kepada</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="inputNama">
            </div>
    </div>
    <div class="row col-11 mb-2">
            <label for="inputNama" class="col-11 col-form-label-sm">isi</label>
            <div class="col-sm-11">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
    </div>
    <div class="row col-11 mb-2">
        <label for="inputNama" class="col-4 col-form-label">Masukkan Lampiran</label>
          <input type="file" class="col-sm-4 form-control-file" " >
    </div>
    <div class="row col-11 mb-2">
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary mt-4">Cek Undangan</button>
            
        </div>
    </div>
</div>

<?php
include "footer.php";
?>

<script src="jquery/dist/jquery-3.5.1.js"></script>
<script src="bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
<script src="jquery/dist/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> -->
		

<script type="text/javascript">
    $(document).ready(function () {
    
   
    // $('#exampleModal').modal('show');
});
</script>