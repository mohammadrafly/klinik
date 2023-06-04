		<div class="dlabnav">
            <div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="dropdown header-profile">
						<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
							<img src="<?= base_url('assets/images/profile/pic1.jpg') ?>" width="20" alt=""/>
							<div class="header-info ms-3">
								<span class="font-w600 ">Hi,<b><?= session()->get('name') ?></b></span>
								<small class="text-end font-w400"><?= session()->get('email') ?></small>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:void(0);" onclick="signOut()" class="dropdown-item ai-icon">
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ms-2">Logout </span>
							</a>
						</div>
					</li>
                    <li><a href="<?= base_url('dashboard') ?>" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
					<?php if(session()->get('role') == 'resepsionis'): ?>
					<li><a href="<?= base_url('dashboard/antrian') ?>" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Antrian</span>
						</a>
					</li>
					<?php endif ?>
					<?php if (session()->get('role') == 'dokter'): ?>
					<li><a href="<?= base_url('dashboard/kunjungan') ?>" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Kunjungan</span>
						</a>
					</li>
					<?php endif ?>
					<li><a href="<?= base_url('dashboard/transaksi') ?>" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Transaksi</span>
						</a>
					</li>
					<?php if (session()->get('role') == 'admin'): ?>
                    <li><a href="<?= base_url('dashboard/users') ?>" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Data Users</span>
						</a>
					</li>
                    <li><a href="<?= base_url('dashboard/obats') ?>" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Data Obat</span>
						</a>
					</li>
					<li><a href="<?= base_url('dashboard/rekam-medis') ?>" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Rekam Medis</span>
						</a>
					</li>
					<?php endif ?>
                </ul>
			</div>
        </div>