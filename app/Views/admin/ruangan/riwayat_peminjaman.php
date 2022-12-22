<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('admin/partials/partial-head') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/datatables/datatables.min.css" />
</head>

<body class="sb-nav-fixed">

    <?= $this->include('admin/partials/partial-topbar') ?>

    <div id="layoutSidenav">
        <?= $this->include('admin/partials/partial-sidebar') ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">
                        <?=$title?>
                    </h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">
                            <?=$title?>
                        </li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Riwayat Peminjaman Ruangan
                        </div>
                        <div class="card-body">
                            <?= session()->getFlashdata('notif')?>
                            <table id="dataTable" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Waktu Peminjaman</th>
                                        <th>Ruangan</th>
                                        <th>Status</th>
                                        <th width="25%">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $c = 1 ?>
                                    <?php foreach ($list_ruangan as $a) {?>
                                    <tr>
                                        <td>
                                            <?=$c?>
                                        </td>
                                        <td>
                                            <?=$a->nama_lengkap?>
                                        </td>
                                        <td>
                                            <center>
                                            <?php
                                            $date=date_create($a->tanggal_peminjaman);
                                            echo date_format($date,"d/m/Y");
                                            ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                 <?php
                                            $date=date_create($a->jam_mulai_peminjaman);
                                            echo date_format($date," H:i");
                                            ?> -
                                              <?php
                                            $date=date_create($a->jam_selesai_peminjaman);
                                            echo date_format($date," H:i");
                                            ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <?=$a->nama_ruangan?>
                                            </center>
                                        </td>
                                        <td>
                                             <center>
                                            <?php if($a->flags == 0){?>
                                            <a class="btn btn-warning btn-sm">
                                                Pending
                                            </a>
                                            <?php }else if($a->flags == 1){?>
                                            <a class="btn btn-success btn-sm">
                                                Approval
                                            </a>
                                            <?php }else{?>
                                            <a class="btn btn-danger btn-sm">
                                                Ditolak
                                            </a>
                                            <?php } ?>
                                            </center>
                                        </td>
                                        <td>
                                          <?=$a->keterangan?>
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

    <div id="updateKategori" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="fetched-data"></span>
            </div>
        </div>
    </div><!-- /.modal -->

    <div id="switchAktif" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="fetched-data"></span>
            </div>
        </div>
    </div><!-- /.modal -->
    
    <div id="switchNonAktif" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="fetched-data"></span>
            </div>
        </div>
    </div><!-- /.modal -->

    <div id="addPeminjaman" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPengajuanLabel">Tambah peminjaman baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= url_to('admin/ruangan/add-peminjaman') ?>" id="formPinjam" method="post">
                        <div class="mb-3">
                            <label class="form-label" for="name_user">Peminjam</label>
                            <select name="iduser" class="form-control" id="name_user">
                                <option> -- Pilih Peminjam -- </option>
                                <?php foreach($dataUser as $user){?>
                                <option value="<?=$user->iduser?>">
                                    <?=$user->nama_lengkap?> (
                                    <?=$user->jabatan?>)
                                </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal_peminjaman"
                                value="<?=session()->getFlashdata('tanggal_peminjaman')?>" required>
                        </div>
                        <div class="mb-3">
                            <table cellpadding="10px">
                                <tr>
                                    <td>
                                        <label class="form-label" for="mulai">Jam Mulai Peminjaman</label>
                                        <input type="time" class="form-control" name="jam_mulai_peminjaman" id="mulai"
                                            value="<?=session()->getFlashdata('jam_mulai_peminjaman')?>" required>
                                    </td>
                                    <td>
                                        <label class="form-label" for="selesai">Jam Akhir Peminjaman</label>
                                        <input type="time" class="form-control" name="jam_selesai_peminjaman" id="selesai"
                                            value="<?=session()->getFlashdata('jam_selesai_peminjaman')?>" required>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="ruangan">Ruangan</label>
                            <select name="idruangan" class="form-control" id="ruangan">
                                <option> -- Pilih Ruangan -- </option>
                                <?php foreach($ruangan as $r){?>
                                <option value="<?=$r->idruangan?>">
                                    <?=$r->nama_ruangan?> <?=$r->idruangan?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control" id="keterangan" cols="10" rows="5"
                                value="<?=session()->getFlashdata('keterangan')?>" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" form="formPinjam" class="btn btn-primary">Tambah Ruangan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    <?= $this->include('admin/partials/partial-footer') ?>

    <script type="text/javascript" src="<?=base_url()?>/assets/datatables/datatables.min.js"></script>
    <script type="text/javascript">
        $('#dataTable').DataTable();
        $('#switchAktif').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>/admin/ruangan/switch-pinjaman',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        $('#switchNonAktif').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>/admin/ruangan/switch-pinjaman2',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        $('#checkKeterangan').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>/admin/ruangan/check',
                data: 'rowid=' + rowid,
                success: function (data) {
                    $('.fetched-data').html(data); //menampilkan data ke dalam modal
                }
            });
        });      
    </script>

</body>

</html>