<div class="modal-header">
    <h5 class="modal-title" id="addPengajuanLabel">Ubah Kategori</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="<?= url_to('admin_edit_dosen', $a->iduser) ?>" id="formEditDosen" method="post">
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?=$a->username?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?=$a->nama_lengkap?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nip">NIP</label>
            <input type="number" class="form-control" id="nip" name="nip" value="<?=$a->nip?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="jabatan">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?=$a->jabatan?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="no_hp">No HP</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?=$a->no_hp?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?=$a->email?>" required>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
    <button type="submit" form="formEditDosen" class="btn btn-primary">Ubah Kategori</button>
</div>