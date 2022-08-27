<?php
include "header.php";
?>
<div clas='row'>
    <h3>Undangan Rapat</h3>
</div>
<div class="col-md-11 box-background">
    <a href="tambahrapat"><button class='btn btn-primary mb-3'>Tambah Undangan Rapat</button></a>
    <div class="row">
        <table class='cell-border' id='tableuser'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Undangan Rapat</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if(isset($undangan)){
                    $i= 1;
                    foreach($undangan as $isi){
                        ?>

                <tr>
                    <td for="nomor" nmr='<?= $isi['nomor']?>'><?= $i?></td>
                    <td for="jenis-rapat"><?= $isi['klasifikasi']?></td>
                    <td for='status'><?= "aktif" ?></td>
                    <td for='tgl'><?= $isi['tanggal']?></td>
                    <td><a class='btn btn-sm btn-secondary' href="editrapat/<?= $isi['id']?>"><i
                                class="bi bi-pencil"></i> Edit </a></td>
                </tr>
                <?php
                    $i++;
                    }
                }
                ?>


                <!-- <tr>
                    <td>1</td>
                    <td>Zulkifli</td>
                    <td>tes@gmai.com</td>
           
                    <td>12 Juni 2022</td>
                    <td><a class='btn btn-sm btn-secondary'><i class="bi bi-pencil"></i> Edit </a></td>


                </tr>
                <tr>
                    <td>1</td>
                    <td>Zulkifli</td>
               
                    <td>Aktif</td>
                    <td>12 Juni 2022</td>
                    <td><a class='btn btn-sm btn-secondary'><i class="bi bi-pencil"></i> Edit </a></td>


                </tr>
                <tr>
                    <td>1</td>
                    <td>Zulkifli</td>
                  
                    <td>Aktif</td>
                    <td>12 Juni 2022</td>
                    <td><a class='btn btn-sm btn-secondary'><i class="bi bi-pencil"></i> Edit </a></td>


                </tr> -->

            </tbody>
        </table>
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
$(document).ready(function() {

    $('#tableuser').DataTable();
    // $('#exampleModal').modal('show');
});
</script>