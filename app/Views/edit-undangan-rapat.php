<?php
include "header.php";

?>
<div clas='row'>
    <h3>Edit Undangan Rapat</h3>
    <?php 
    // print_r($rapat);
    if(isset($rapat)){
        foreach($rapat as $isi){
            $nomor = $isi['nomor'];
            $namafile = $isi['namafile'];
            $klasifikasi = $isi['klasifikasi'];
            $tanggal = $isi['tanggal'];
            $lampiran = $isi['lampiran'];
            $perihal = $isi['perihal'];
            $kepada = $isi['kepada'];
            $isi = $isi['isi'];
            // 

        }
    }
        ?>
</div>

<div class='body'>
    <form action="" id='form-editrapat'>
        <div class="row col-11 mb-2">
            <label for="nomor" class="col-2 col-form-label-sm">Nomor</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="nomor" name='nomor'
                    value='<?= isset($nomor)? $nomor:""?>'>
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="tanggal" class="col-2 col-form-label">Tanggal Rapat</label>
            <div class="col-sm-4">
                <input type="date" id='tanggal' date-format="dd/mm/yyyy" name="tanggal" class="col-sm-4 form-control "
                    value='<?= isset($tanggal)? $tanggal:""?>'>
            </div>
        </div>
        <div class=" row col-11 mb-2">
            <label for="klas" class="col-2 col-form-label-sm">Klasifikasi</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="klas" name='klas'
                    value='<?= isset($klasifikasi)? $klasifikasi:""?>'>
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="lamp" class="col-2 col-form-label-sm">Lampiran</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="lamp" name='lamp'
                    value='<?= isset($lampiran)? $lampiran:""?>'>
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="hal" class="col-2 col-form-label-sm">Perihal</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="hal" name="hal"
                    value='<?= isset($perihal)? $perihal:""?>'>
            </div>
        </div>
        <div class="row col-11 mb-2">
            <label for="kepala" class="col-2 col-form-label-sm">Kepada</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="kepala" name="kepada"
                    value='<?= isset($kepada)? $kepada:""?>'>
            </div>
        </div>

        <div class="row col-11 mb-2">
            <label for="isi" class="col-11 col-form-label-sm">isi</label>
            <div class="col-sm-11">
                <textarea class="form-control" id="isi" name="isi" rows="3"><?= isset($isi)? $isi:""?></textarea>
            </div>
        </div>
        <div class=" row col-11 mb-2 ">
            <label for="fileLamp" class="col-2 col-form-label">Masukkan Lampiran</label>
            <input type="file" id='fileLamp' name="fileLamp" value='' class="col-sm-4 form-control-file"><label for=""
                c;ass='col-form-label col-3'><?= isset($namafile)? $namafile:""?></label>
        </div>
        <div class=" row col-11 mb-2">
            <div class="d-flex justify-content-center">
                <a href="<?=base_url("files/".$namafile)?>" target=" _blank"><input type="button"
                        onclick="udpateUndangan()" class="btn btn-primary mt-4 " value="Cek Undangan "></a>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="button" onclick="udpateUndangan()" class="btn btn-primary mt-4 " value="Simpan Undangan ">

            </div>
        </div>
    </form>
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


});
</script>