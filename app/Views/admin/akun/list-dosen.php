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
                                Daftar Akun
                                <div class="btn-group float-end">
                                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDosen">
                                        Tambah Akun Dosen
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?= session()->getFlashdata('notif')?>
                                <table id="dataTable" class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $c = 1 ?>
                                        <?php foreach ($list_dosen as $a) {?>
                                            <tr>
                                                <td><?=$c?></td>
                                                <td><?=$a->username?></td>
                                                <td><?=$a->nama_lengkap?></td>
                                                <td><?=$a->nip?></td>
                                                <td><?=$a->jabatan?></td>
                                                <td><?=$a->no_hp?></td>
                                                <td><?=$a->email?></td>
                                                <td>
                                                    <div class="btn-group d-flex align-items-center">
                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateAkun" data-id="<?=$a->iduser?>">
                                                            <i class="fa fa-edit"></i> Ubah
                                                        </a>
                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#switchKategori" data-id="<?=$a->iduser?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </a>
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
        
        <div id="updateAkun" class="modal fade" tabindex="-1">
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

        <div id="addDosen" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPengajuanLabel">Tambah akun dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= url_to('admin/akun/add-akun') ?>" id="formDosen" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?=session()->getFlashdata('username')?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?=session()->getFlashdata('nama_lengkap')?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nip">NIP</label>
                                <input type="number" class="form-control" id="nip" name="nip" value="<?=session()->getFlashdata('nip')?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?=session()->getFlashdata('jabatan')?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="no_hp">No HP</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?=session()->getFlashdata('no_hp')?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?=session()->getFlashdata('email')?>" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" form="formDosen" class="btn btn-primary">Tambah Dosen</button>
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
                    url: '<?= base_url() ?>/admin/akun/switch-akun',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
            $('#updateAkun').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>/admin/akun/edit-dosen',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });      
        </script>

    </body>
</html>

