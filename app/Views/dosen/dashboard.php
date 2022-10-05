<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->include('dosen/partials/partial-head') ?>
    </head>
    
    <body class="sb-nav-fixed">
        <?= $this->include('dosen/partials/partial-topbar') ?>

        <div id="layoutSidenav">
            <?= $this->include('dosen/partials/partial-sidebar') ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                Selamat datang di user dosen!
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

    </body>
</html>
