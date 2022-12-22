<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('dosen/partials/partial-head') ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/datatables/datatables.min.css" />
</head>

<body class="sb-nav-fixed">

    <?= $this->include('dosen/partials/partial-topbar') ?>

    <div id="layoutSidenav">
        <?= $this->include('dosen/partials/partial-sidebar') ?>

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
                            Daftar Peminjaman Ruangan
                            <div class="btn-group float-end">
                                <a class="btn btn-sm btn-warning <?=($title == 'Peminjaman Ruangan Terkini')?'active':''?>"
							href="<?= url_to('dosen/check-ruangan') ?>">
                                    <i class="fa fa-search"></i>
                                    Check Ruangan</a>&nbsp;&nbsp;
                                <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addPeminjaman">
                                    Ajukan Peminjaman
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= session()->getFlashdata('notif')?>
                            <table id="dataTable" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Waktu Peminjaman</th>
                                        <th>Ruangan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
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
                                            <center>
                                             <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#checkKeterangan" data-id="<?=$a->idriwayat_pinjaman?>">
                                                    <i class="fa fa-check"></i> Check
                                            </a>
                                            </center>
                                        </td>
                                        <td>
                                            <div class="btn-group d-flex align-items-center">
                                            <?php if($a->flags == 0){?>
                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePinjaman" data-id="<?=$a->idriwayat_pinjaman?>">
                                                     <i class="fa fa-trash"></i>
                                                                Hapus
                                                            </a>
                                            <?php }else{?>
                                            -
                                            <?php } ?>
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

    <div id="deletePinjaman" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="fetched-data"></span>
            </div>
        </div>
    </div><!-- /.modal -->
    
       <div id="checkKeterangan" class="modal fade" tabindex="-1">
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
                    <form action="<?= url_to('dosen/ruangan/add-peminjaman') ?>" id="formPinjam" method="post">
                        <input type="hidden" class="form-control" id="iduser" name="iduser" value="<?=$duser->iduser?>" required>
                        <p style="color:red">*Pastikan ruangan yang akan Anda pinjam tersedia ! <br> <span style="font-size:10px">(cek terlebih dahulu pada tombol <b><i class="fa fa-search"></i>Check Ruangan</b>)</span></p>
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

    <?= $this->include('dosen/partials/partial-footer') ?>

    <script type="text/javascript" src="<?=base_url()?>/assets/datatables/datatables.min.js"></script>
    <script type="text/javascript">
        $('#dataTable').DataTable();
        $('#deletePinjaman').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>/dosen/ruangan/hapus-pinjaman',
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
                url: '<?= base_url() ?>/dosen/ruangan/check',
                data: 'rowid=' + rowid,
                success: function (data) {
                    $('.fetched-data').html(data); //menampilkan data ke dalam modal
                }
            });
        });      
    </script>

</body>

</html>