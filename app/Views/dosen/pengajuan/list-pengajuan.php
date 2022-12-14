<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->include('dosen/partials/partial-head') ?>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/datatables/datatables.min.css"/>
    </head>

    <body class="sb-nav-fixed">
        
        <?= $this->include('dosen/partials/partial-topbar') ?>

        <div id="layoutSidenav">
            <?= $this->include('dosen/partials/partial-sidebar') ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?=$title?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Berkas & Dokumen</li>
                            <li class="breadcrumb-item active"><?=$title?></li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Daftar Pengajuan Dekan
                                <div class="btn-group float-end">
                                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPengajuan">
                                        Tambah Pengajuan
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?= session()->getFlashdata('notif')?>
                                <table id="dataTable" class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Waktu Kegiatan</th>
                                            <th>Pelaksana Kegiatan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $c = 1 ?>
                                        <?php foreach ($list_surat as $a) {?>
                                            <tr>
                                                <td><?=$c?></td>
                                                <td><?=$a->nama_kegiatan?></td>
                                                <td><?=$a->tanggal_kegiatan?></td>
                                                <td><?=$a->waktu_kegiatan?></td>
                                                <td><?=$a->pelaksana_kegiatan?></td>
                                                <td><?=$a->status?></td>
                                                <td>
                                                    <div class="btn-group d-flex align-items-center">
                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailSurat" data-id="<?=$a->idpengajuan?>">
                                                            <span class="fa fa-search"></span> Detail
                                                        </a>
                                                        <?php if ($a->flag == 0) {?>
                                                            <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#revisiUpdate" data-id="<?=$a->idpengajuan?>">
                                                                <span class="fa fa-edit"></span> Revisi
                                                            </a>
                                                        <?php }?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $c++; ?>
                                        <?php }?>
                                    </tbody>
                                </table>
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

        <div id="detailSurat" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <span class="fetched-data"></span>
                </div>
            </div>
        </div><!-- /.modal -->

        <div id="revisiUpdate" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <span class="fetched-data"></span>
                </div>
            </div>
        </div><!-- /.modal -->

        <div id="addPengajuan" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPengajuanLabel">Upload Dokumen/Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= url_to('dosen/dokumen/add-req') ?>" id="formDoc" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="title">Judul Dokumen/Surat</label>
                                <input type="text" class="form-control" id="title" name="judul_surat" value="<?=session()->getFlashdata('judul_surat')?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="kat_dokumen">Kategori Dokumen</label>
                                <select class="form-select" id="kat_dokumen" name="idkategori" required>
                                    <option value="" <?=(session()->getFlashdata('idkategori'))?'':'selected'?> disabled>Pilih Kategori...</option>
                                    <?php foreach ($list_kategori as $b): ?>
                                        <option value="<?= $b->idkategori ?>" <?=(session()->getFlashdata('idkategori') == $b->idkategori)?'selected':''?> ><?= $b->nama_kategori ?></option>
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
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" form="formDoc" class="btn btn-success">Upload Dokumen</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <?= $this->include('dosen/partials/partial-footer') ?> 
        
        <script type="text/javascript" src="<?=base_url()?>/assets/datatables/datatables.min.js"></script>
        <script type="text/javascript">
            $('#dataTable').DataTable();
            $(document).ready(function() {
                $('#revisiUpdate').on('show.bs.modal', function(e) {
                    var rowid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url() ?>/dosen/dokumen/revisi-update',
                        data: 'rowid=' + rowid,
                        success: function(data) {
                            $('.fetched-data').html(data); //menampilkan data ke dalam modal
                        }
                    });
                });
                $('#detailSurat').on('show.bs.modal', function(e) {
                    var rowid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url() ?>/dosen/dokumen/detail-surat',
                        data: 'rowid=' + rowid,
                        success: function(data) {
                            $('.fetched-data').html(data); //menampilkan data ke dalam modal
                        }
                    });
                });
            });
        </script>

    </body>
</html>

