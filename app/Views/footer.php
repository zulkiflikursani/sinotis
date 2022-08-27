</div>
<div id="buram"></div>
<div class="modal modal-notif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhatian !!!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body " style="text-align: center;">
                <img src="<?= base_url()?>/img/checklist-icon.png" alt="" height="80px">
                <p id='message'>Modal body text goes here.</p>
            </div>
            <div class="modal-footer align-items-center justify-content-center">
                <button type="button" onclick="reload()" class="btn btn-primary col-4"
                    data-bs-dismiss="modal">OK</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<footer>
    Copyright © 2022 |
    <power style='float:right; margin-right:30px;'>
        <a>Pengadilan Militer III 16 Makassar</a>
    </power>
</footer>
<!-- end::Scroll Top -->
<style type="text/css">
.toast {
    opacity: 1 !important;
    top: 20px;
}
</style>

<script>
function reload() {
    location.reload();
}
</script>


</body>