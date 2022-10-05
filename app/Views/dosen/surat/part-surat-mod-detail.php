<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">Konfirmasi</h5>
    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
</div>
<div class="modal-body">
    <?= session()->getFlashdata('notif')?>
    <table class="table">
        <tr>
            <td>Judul</td>
            <td>:</td>
            <td><b><?=$a->judul_surat?></b></td>
        </tr>
        <tr>
            <td>Tanggal Upload</td>
            <td>:</td>
            <td><b><?=$a->tanggal_upload?></b></td>
        </tr>
        <?php if($a->tanggal_revisi){?>
            <tr>
                <td>Tanggal Revisi</td>
                <td>:</td>
                <td><b><?=$a->tanggal_revisi?></b></td>
            </tr>
        <?php }?>
        <?php if($a->tanggal_acc){?>
            <tr>
                <td>Tanggal di ACC</td>
                <td>:</td>
                <td><b><?=$a->tanggal_acc?></b></td>
            </tr>
        <?php }?>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td><b>
                <?php if($a->flag == 0){?>
                    Revisi
                <?php }elseif($a->flag == 1){?>
                    Sedang direview oleh Dekan
                <?php }elseif($a->flag == 2){?>
                    Menunggu TTD Dekan 
                <?php }elseif($a->flag == 3){?>
                    Telah di ACC 
                <?php }?>
            </b></td>
        </tr>
        <tr>
            <td>Jenis Dokumen / Surat</td>
            <td>:</td>
            <td><b><?=$a->nama_kategori?></b></td>
        </tr>
        <tr>
            <td>File</td>
            <td>:</td>
            <td>
                <a href="<?= base_url() ?>/uploads/user/<?=$a->username?>/doc/<?=$a->file_dosen?>" download="<?=$a->file_dosen?>">
                    <b><?=$a->file_dosen?></b>
                </a>
            </td>
        </tr>
        <?php if($a->file_sekpem){?>
            <tr>
                <td>File TTD</td>
                <td>:</td>
                <td>
                    <a href="<?= base_url() ?>/uploads/user/<?=$a->username?>/doc/<?=$a->file_sekpem?>" download="<?=$a->file_sekpem?>">
                        <b><?=$a->file_sekpem?></b>
                    </a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<div class="modal-footer">
    <a class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</a>
    <?php if($a->file_sekpem){?>
        <a href="<?= base_url() ?>/uploads/user/<?=$a->username?>/doc/<?=$a->file_sekpem?>" download="<?=$a->file_sekpem?>" class="btn btn-success">
            Unduh file TTD
        </a>
    <?php }?>
</div>
