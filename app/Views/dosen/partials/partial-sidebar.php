<div id="layoutSidenav_nav">
	<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
		<div class="sb-sidenav-menu">
			<div class="nav">
				<div class="sb-sidenav-menu-heading">Core</div>
				<a class="nav-link <?=($title == 'Dashboard')?'active':''?>" href="<?= url_to('dosen/dashboard') ?>">
					<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
					Dashboard
				</a>
				<a class="nav-link <?=($title == 'List Kategori')?'active':''?>"
					href="<?= url_to('dosen/dashboard') ?>">
					<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
					List Kategori
				</a>
				<a class="nav-link <?=($title == 'List Ruangan')?'active':''?>"
					href="<?= url_to('dosen/ruangan') ?>">
					<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
					List Ruangan
				</a>
				<div class="sb-sidenav-menu-heading">Berkas & Dokumen</div>
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
					aria-expanded="false" aria-controls="collapseLayouts">
					<div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
					Dokumen Surat
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
					data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link <?=($title == 'List Surat')?'active':''?>"
							href="<?= url_to('dosen/dokumen') ?>">Daftar Pengajuan Surat</a>
					</nav>
				</div>
					<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2"
					aria-expanded="false" aria-controls="collapseLayouts">
					<div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
					Dokumen Ruangan
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
					data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link <?=($title == 'List Peminjaman Ruangan')?'active':''?>"
							href="<?= url_to('dosen/dokumen-peminjaman') ?>">Daftar Pengajuan Ruangan</a>
					</nav>
				</div>
				<div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
					data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link <?=($title == 'Riwayat Peminjaman Ruangan')?'active':''?>"
							href="<?= url_to('dosen/riwayat_peminjaman') ?>">Riwayat Pengajuan Ruangan</a>
					</nav>
				</div>
					<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3"
					aria-expanded="false" aria-controls="collapseLayouts">
					<div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
					Dokumen Pengajuan Dekan
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
					data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link <?=($title == 'List Pengajuan Dekan')?'active':''?>"
							href="<?= url_to('dosen/pengajuan') ?>">Daftar Pengajuan Dekan</a>
					</nav>
				</div>
			</div>
		</div>
		<div class="sb-sidenav-footer">
			<div class="small">Logged in as:</div>
			Dosen
		</div>
	</nav>
</div>
