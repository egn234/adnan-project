<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">Konfirmasi</h5>
    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form action="<?= url_to('dosen/dokumen/revisi-req') ?>" id="formRevisi" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="title">Judul Dokumen/Surat</label>
            <input type="text" class="form-control" id="title" name="judul_surat" value="<?= $a->judul_surat ?>" required>
            <input type="text" class="form-control" name="idsurat" value="<?=$a->idsurat?>" hidden>
        </div>
        <div class="mb-3">
            <label class="form-label" for="kat_dokumen">Kategori Dokumen</label>
            <select class="form-select" id="kat_dokumen" name="idkategori" required>
                <option value="" <?=(session()->getFlashdata('idkategori'))?'':'selected'?> disabled>Pilih Kategori...</option>
                <?php foreach ($kat as $b): ?>
                    <option value="<?= $b->idkategori ?>" <?=($a->idkategori == $b->idkategori)?'selected':''?> ><?= $b->nama_kategori ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="doc_upload">Upload Dokumen/Surat (.pdf)</label>
            <input type="file" class="form-control" id="doc_upload" name="file_dosen" accept=".pdf" required>
        </div>
    </form>
</div>
<div class="modal-footer">
    <a class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</a>
    <button type="submit" form="formRevisi" class="btn btn-success">Revisi Dokumen</button>
</div>
