<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->include('admin/partials/partial-head') ?>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/datatables/datatables.min.css"/>
    </head>

    <body class="sb-nav-fixed">
        
        <?= $this->include('admin/partials/partial-topbar') ?>

        <div id="layoutSidenav">
            <?= $this->include('admin/partials/partial-sidebar') ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?=$title?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?=$title?></li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Daftar Ruangan
                                <div class="btn-group float-end">
                                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addRuangan">
                                        Tambah Ruangan
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?= session()->getFlashdata('notif')?>
                                <table id="dataTable" class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th>Nama Ruangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $c = 1 ?>
                                        <?php foreach ($list_ruangan as $a) {?>
                                            <tr>
                                                <td><?=$c?></td>
                                                <td><?=$a->nama_ruangan?></td>
                                                <td><?=($a->flag == 1)?'Aktif':'Nonaktif'?></td>
                                                <td>
                                                    <div class="btn-group d-flex align-items-center">
                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateRuangan" data-id="<?=$a->idruangan?>">
                                                            <i class="fa fa-edit"></i> Ubah
                                                        </a>
                                                        <?php if($a->flag == 1){?>
                                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#switchKategori" data-id="<?=$a->idruangan?>">
                                                                Nonaktifkan
                                                            </a>
                                                        <?php }else{?>
                                                            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#switchKategori" data-id="<?=$a->idruangan?>">
                                                                Aktifkan
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
        
        <div id="updateRuangan" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <span class="fetched-data"></span>
                </div>
            </div>
        </div><!-- /.modal -->

        <div id="switchKategori" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <span class="fetched-data"></span>
                </div>
            </div>
        </div><!-- /.modal -->

        <div id="addRuangan" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPengajuanLabel">Tambah ruangan baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= url_to('admin/ruangan/add-ruangan') ?>" id="formRu" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="name_ruangan">Nama Ruangan</label>
                                <input type="text" class="form-control" id="name_ruangan" name="nama_ruangan" value="<?=session()->getFlashdata('nama_ruangan')?>" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" form="formRu" class="btn btn-primary">Tambah Ruangan</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <?= $this->include('admin/partials/partial-footer') ?> 
        
        <script type="text/javascript" src="<?=base_url()?>/assets/datatables/datatables.min.js"></script>
        <script type="text/javascript">
            $('#dataTable').DataTable();
            $('#switchKategori').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>/admin/ruangan/switch-ruangan',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
            $('#updateRuangan').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>/admin/ruangan/edit-ruangan',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });      
        </script>

    </body>
</html>

