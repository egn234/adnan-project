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
                            Ringkasan Data Peminjaman Dosen
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <th>Total Peminjaman Ruangan</th>
                                    <th>Pending</th>
                                    <th>Approval</th>
                                    <th>Ditolak</th>
                                </thead>
                                <tbody>
                                    <td><b><?=$total->jumlah?></b> ruangan</td>
                                    <td><b><?=$pending->jumlah?></b> ruangan</td>
                                    <td><b><?=$approval->jumlah?></b> ruangan</td>
                                    <td><b><?=$decline->jumlah?></b> ruangan</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Peminjaman Ruangan
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

    <?= $this->include('dosen/partials/partial-footer') ?>

    <script type="text/javascript" src="<?=base_url()?>/assets/datatables/datatables.min.js"></script>
     <script type="text/javascript" src="<?=base_url()?>/assets/datatables/datatables.min.js"></script>
    <script type="text/javascript">
        $('#dataTable').DataTable();
    </script>


</body>

</html>