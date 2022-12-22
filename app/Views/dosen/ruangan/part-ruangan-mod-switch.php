<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">Konfirmasi</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        Apakah Anda yakin akan menghapus peminjaman ruangan tersebut?
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
    <a href="<?= url_to('dosen_hapus_pinjaman', $a->idriwayat_pinjaman) ?>" class="btn btn-danger">Hapus</a>
</div>
