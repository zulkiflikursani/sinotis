<?php
include "header.php";
?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>


<body>
    <div clas='row'>
        <h3>Input Notule</h3>
    </div>

    <div class="row">
        <div class="col-md-11 box-background">
            <form id='form-notulen' action="">
                <div class="row col-11 mb-2 mt-2">
                    <label for="nomor" class="col-1 col-form-label-sm">Nomor</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="nomor" value="<?= $datarapat['kode_rapat'] ?>">
                        <input type="text" class="form-control form-control-sm" id="nomor"
                            value='<?= $datarapat['kode_rapat'] ?>' name='nomor' disabled='true'>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <!-- <input type="date" id='tanggal' date-format="dd/mm/yyyy" name="tanggal" class="col-sm-4 form-control "> -->
                    <div class="row">
                        <div class="row col-3 mx-1">
                            <label for="" class="col-form-label">Penulis Notulen</label>
                            <input type="text" class='form-control-sm ' name="penulis" id="">
                        </div>
                        <div class="row col-2 mx-1">
                            <label for="" class="col-form-label">Jabatan Notulen</label>
                            <input type="text" class='form-control-sm' name="jabatan" id="">
                        </div>
                        <div class="row col-2 mx-1">
                            <label for="" class="col-form-label">Devisi Notulen</label>
                            <input type="text" class='form-control-sm' name="devisi" id="">
                        </div>
                        <div class="row col-2 mx-2 text-start">
                            <label for="" class="col-form-label">NIP Notulen</label>
                            <input type="text" class='form-control-sm' name="nip" id="">
                        </div>
                    </div>

                    <div class='mt-4'>
                        <h3 style='color:black'> Hasil Rapat</h3>

                        <input type="hidden" name="isi" value="">
                        <div id="editor" name='editor' style="min-height: 160px; background-color:#ffff"></div>
                    </div>

                    <div class="mt-2">
                        <button type="button" onclick="addNotulen()" name="draft" class="button btn btn-primary"
                            value="false">Simpan</button>
                        <a href="../Datarapat"><button type="button" name="draft" class="button btn btn-primary"
                                value="false">Batal</button></a>
                        <div class="invalid-feedback">

                        </div>
                    </div>
            </form>
        </div>
        <?php
        include "footer.php";
        ?>
        <script src="../jquery/dist/jquery-3.5.1.js"></script>
        <script src="../bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        font: []
                    }],
                    ["bold", "italic"],
                    ["link", "blockquote", "code-block", "image"],
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }],
                    [{
                        script: "sub"
                    }, {
                        script: "super"
                    }],
                    [{
                        color: []
                    }, {
                        background: []
                    }],
                    [{
                        'align': []
                    }],
                ]
            },
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='isi']").value = quill.root.innerHTML;
        });

        function addNotulen() {
            var conn = new WebSocket('ws://localhost:8080?access_token=<?= session()->get('id') ?>');
            conn.onopen = function(e) {
                console.log("Connection established!");
            };
            url = "<?php echo base_url('Notulen/addnotulen') ?>"
            var formData = new FormData($("#form-notulen")[0]);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data['status'] == true) {
                        // document.getElementById("form-notulen").reset();
                        $.each(data['user_to_notif'], function(a, b) {
                            var data = {
                                msg: 'VALIDASI',
                                status: "notif",
                                send_to: b
                            }
                            console.log(data);
                            conn.send(JSON.stringify(data));
                        })
                        $('#message').html('Tambah Notulen Rapat Sukses')
                        $('.modal-notif').modal('show')
                    } else {
                        $('#message').html('Tambah Notulen Rapat gagal ' + data['message'])
                        $('.modal-notif').modal('show')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR)
                    $('#message').html('Tamabah Undangan Rapat Gagal ' + jqXHR.responseText)
                    $('.modal-notif').modal('show')

                }

            })
        }
        </script>
    </div>
</body>