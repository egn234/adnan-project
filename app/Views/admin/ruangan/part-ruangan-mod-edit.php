<div class="modal-header">
    <h5 class="modal-title" id="addPengajuanLabel">Ubah Ruangan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="<?= url_to('admin_edit_ruangan', $a->idruangan) ?>" id="formEditRuangan" method="post">
        <div class="mb-3">
            <label class="form-label" for="name_ruangan">Nama Ruangan</label>
            <input type="text" class="form-control" id="name_ruangan" name="nama_ruangan" value="<?=$a->nama_ruangan?>" required>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
    <button type="submit" form="formEditRuangan" class="btn btn-primary">Ubah Ruangan</button>
</div>