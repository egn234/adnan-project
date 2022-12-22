            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link <?=($title == 'Dashboard')?'active':''?>" href="<?= url_to('admin/dashboard') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                                 List Akun
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=($title == 'List Akun Dosen')?'active':''?>" href="<?= url_to('admin/list-dosen') ?>">Akun Dosen</a>
                                </nav>
                            </div>
                            <a class="nav-link <?=($title == 'List Kategori')?'active':''?>" href="<?= url_to('admin/kategori') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                List Kategori
                            </a>
                             <a class="nav-link <?=($title == 'List Ruangan')?'active':''?>" href="<?= url_to('admin/ruangan') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-people-roof"></i></div>
                                List Ruangan
                            </a>
                            <div class="sb-sidenav-menu-heading">Berkas & Dokumen</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                 Dokumen Surat
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=($title == 'List Surat')?'active':''?>" href="<?= url_to('admin/dokumen') ?>">Daftar Pengajuan TTD</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-contract"></i></div>
                                 Dokumen Ruangan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=($title == 'List Peminjaman Ruangan')?'active':''?>" href="<?= url_to('admin/dokumen-peminjaman') ?>">Daftar Peminjaman Ruangan</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=($title == 'Riwayat Peminjaman Ruangan')?'active':''?>" href="<?= url_to('admin/riwayat_peminjaman') ?>">Riwayat Peminjaman Ruangan</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        admin
                    </div>
                </nav>
            </div>