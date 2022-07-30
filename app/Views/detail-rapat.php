<?php
include "header.php";
?>
<div clas='row'>
<h3>Detail Rapat</h3>
</div>
<div class="row">
    <div class="col-md-11 box-background">
        <div class="row col-12">
            <div class="row col-12 ">
                <div class="col-6 d-flex d-flex justify-content-start">
                    <h3 class="text-body fw-bold">Rapat Evaluasi</h3>
                </div>
                <div class="col-6 d-flex d-flex justify-content-end">
                    <p class="text-body">Tanggal : 10 Juni 2022</p>
                </div>
            </div>
            <div class="row col-4">
                <label class="col-form-label-sm fw-bold">No Rapat : RAP/004/004</label>
                <label class="col-form-label-sm">Rapat Kinerja</label>
                <label class="col-form-label-sm">Pengisi : Zulkifli</label>
            </div>
            <div class="row col-4">
                <label class="col-form-label-sm fw-bold">Waktu Acara</label>
                <label class="col-form-label-sm">Mulai : 09:00 WITA</label>
                <label class="col-form-label-sm">Sampai : 12:00 WITA</label>

            </div>
        
            <div class="row col-4">
                <label class="col-form-label-sm fw-bold">Status Acara</label>
                <label class="col-form-label-sm">Selesai</label>
                <label class="col-form-label-sm"></label>
            </div>
        
        </div>
 
        <div class="col-md-11">
            <a  data-bs-toggle="modal" data-bs-target="#modalTambahPeserta"><button class='btn btn-primary mb-3'>Tambah Peserta</button></a>
            <table class='cell-border' id='tableuser' >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Peserta</th>
                        <th>No HP</th>
                        <th>Bidang</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Zulkifli</td>
                        <td>082343947212</td>
                        <td>Kepegawaian</td>
                        <td>Pegawai Bidang Kepegawaian</td>
                        <td><a class='btn btn-sm btn-secondary'>Batal</a></td>
                
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Zulkifli</td>
                        <td>082343947212</td>
                        <td>Kepegawaian</td>
                        <td>Pegawai Bidang Kepegawaian</td>
                        <td><a class='btn btn-sm btn-secondary'>Batal</a></td> 
                  
                    </tr>
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal tambah peserta -->
<div class="modal fade" id="modalTambahPeserta" tabindex="-1" role="dialog" aria-labelledby="modalTambahPesertaRapatLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex justify-content-center w-100" >
            <h5 class="modal-title" id="modalTambahPesertaRapatLabel">Tambah Peserta Rapat</h5>
        </div>
        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row col-12">
            <div   div class="col-12 row mb-3">
                <label for="inputNama" class="col-sm-4 col-form-label">Jenis Rapat</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputNama">
                      </div>
            </div>
   
            <div   div class="col-12 row mb-2">
                <label for="inputNama" class="col-sm-4 col-form-label">Nama Peserta</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="namarapat">
                      </div>
            </div>
            <div   div class="col-12 row mb-2">
                <label for="inputNama" class="col-sm-4 col-form-label">No HP</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputNama">
                      </div>
            </div>
            <div   div class="col-12 row mb-2">
                <label for="inputNama" class="col-sm-4 col-form-label">Sub Bidang</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputNama">
                      </div>
            </div>
            <div   div class="col-12 row mb-2">
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