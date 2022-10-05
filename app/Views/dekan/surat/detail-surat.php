<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->include('dekan/partials/partial-head') ?>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/datatables/datatables.min.css"/>
    </head>

    <body class="sb-nav-fixed">
        
        <?= $this->include('dekan/partials/partial-topbar') ?>

        <div id="layoutSidenav">
            <?= $this->include('dekan/partials/partial-sidebar') ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?=$title?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Berkas & Dokumen</li>
                            <li class="breadcrumb-item active">Dokumen Surat</li>
                            <li class="breadcrumb-item active"><?=$title?></li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-book-open me-1"></i>
                                Detail Dokumen / Surat
                            </div>
                            <div class="card-body">
                                <?= session()->getFlashdata('notif')?>
                                <table class="table">
                                    <tr>
                                        <td>Pemohon</td>
                                        <td>:</td>
                                        <td><b><?=$detail_surat->nama_lengkap?></b></td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td><b><?=$detail_surat->nip?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td>:</td>
                                        <td><b><?=$detail_surat->judul_surat?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Upload</td>
                                        <td>:</td>
                                        <td><b><?=$detail_surat->tanggal_upload?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Dokumen / Surat</td>
                                        <td>:</td>
                                        <td><b><?=$detail_surat->nama_kategori?></b></td>
                                    </tr>
                                    <tr>
                                        <td>File</td>
                                        <td>:</td>
                                        <td>
                                            <a href="<?= base_url() ?>/uploads/user/<?=$detail_surat->username?>/doc/<?=$detail_surat->file_dosen?>" download="<?=$detail_surat->file_dosen?>">
                                                <b><?=$detail_surat->file_dosen?></b>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary m-1 <?=($detail_surat->flag != 1)?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#RevisiDokumen">
                                        Ajukan revisi ke pemohon
                                    </a>
                                    <a class="btn btn-success m-1 <?=($detail_surat->flag != 1)?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#AccDokumen">
                                        ACC Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div id="RevisiDokumen" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPengajuanLabel">Konfirmasi Revisi Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Ajukan revisi untuk dokumen ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batalkan</button>
                        <a href="<?= url_to('dekan_pengajuan_revisi', $detail_surat->idsurat) ?>" class="btn btn-primary">Ajukan</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <div id="AccDokumen" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPengajuanLabel">Konfirmasi Acc Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Acc dokumen ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batalkan</button>
                        <a href="<?= url_to('dekan_acc_dokumen', $detail_surat->idsurat) ?>" class="btn btn-success">ACC</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <?= $this->include('dekan/partials/partial-footer') ?> 

    </body>
</html>

