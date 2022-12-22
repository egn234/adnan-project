<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">Konfirmasi</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        Apakah Anda yakin ingin menghapus Akun <?=$a->nama_lengkap?> ?
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
    <a href="<?= url_to('admin_switch_akun', $a->iduser) ?>" class="btn btn-danger">Iya</a>
</div>
