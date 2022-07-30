<?php
include "header.php";
?>
<div clas='row'>
<h3>Undangan Rapat</h3>
</div>
<div class="col-md-11 box-background">
    <a href="tambahrapat"><button class='btn btn-primary mb-3'>Tambah Undangan Rapat</button></a>
    <div class="row">
        <table class='cell-border' id='tableuser' >
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
                <tr>
                    <td>1</td>
                    <td>Rapat Tertutup</td>
                    <td>Aktif</td>
                    <td>12-6-2022</td>
                    <td><a class='btn btn-sm btn-secondary' data-bs-toggle="modal" data-bs-target="#modalEditUndangan"><i class="bi bi-pencil"></i> Edit </a></td>
                </tr>
                
                <tr>
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


                </tr>

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
    $(document).ready(function () {
    
    $('#tableuser').DataTable();
    // $('#exampleModal').modal('show');
});
</script>