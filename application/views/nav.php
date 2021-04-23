<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
	<div class="nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<?php
			$nik = $this->session->userdata('nik');
			$pengguna = $this->login_m->dataPengguna($nik);
			?>
			<?php if ($pengguna->level != "Admin") : ?>
				<li><a href="<?php echo base_url(); ?>"><i class="icon-dashboard"></i><span class="hidden-tablet"> Dashboard</span></a></li>
				<li><a href="<?php echo base_url(); ?>perbekalan"><i class="icon-barcode"></i><span class="hidden-tablet"> Inventories</span></a></li>
				<li><a href="<?php echo base_url(); ?>form"><i class="icon-file-alt"></i><span class="hidden-tablet"> Form</span></a></li>
				<li><a href="<?php echo base_url(); ?>tracking"><i class="icon-search"></i><span class="hidden-tablet"> Tracking</span></a></li>
			<?php else : ?>
				<li><a href="<?php echo base_url(); ?>"><i class="icon-dashboard"></i><span class="hidden-tablet"> Dashboard</span></a></li>
				<li><a href="<?php echo base_url(); ?>perbekalan"><i class="icon-barcode"></i><span class="hidden-tablet"> Inventories</span></a></li>
				<li><a href="<?php echo base_url(); ?>form"><i class="icon-file-alt"></i><span class="hidden-tablet"> Form</span></a></li>
				<li>
					<a class="dropmenu" href="#"><i class="halflings-icon white chevron-right"></i><span class="hidden-tablet"> &nbsp; Berita Acara</span></a>
					<ul>
						<li><a class="submenu" href="<?php echo base_url(); ?>bast"><i class="icon-file-alt"></i><span class="hidden-tablet"> &nbsp; Serah Terima</span></a></li>
						<li><a class="submenu" href="<?php echo base_url(); ?>bapb"><i class="icon-file-alt"></i><span class="hidden-tablet"> &nbsp; Peminjaman</span></a></li>
					</ul>
				</li>
				<li><a href="<?php echo base_url(); ?>tracking"><i class="icon-search"></i><span class="hidden-tablet"> Tracking</span></a></li>
				<li><a href="<?php echo base_url(); ?>aset"><i class="icon-gift"></i><span class="hidden-tablet"> Assets</span></a></li>
				<li><a href="<?php echo base_url(); ?>komponen"><i class="icon-cog"></i><span class="hidden-tablet"> Components</span></a></li>
				<li><a href="<?php echo base_url(); ?>kategori"><i class="icon-reorder"></i><span class="hidden-tablet"> Categories</span></a></li>
				<li>
					<a class="dropmenu" href="#"><i class="halflings-icon white chevron-right"></i><span class="hidden-tablet"> &nbsp; Users</span></a>
					<ul>
						<li><a class="submenu" href="<?php echo base_url(); ?>karyawan"><i class="icon-user"></i><span class="hidden-tablet"> &nbsp; Users</span></a></li>
						<li><a class="submenu" href="<?php echo base_url(); ?>jabatan"><i class="icon-briefcase"></i><span class="hidden-tablet"> &nbsp; Positions</span></a></li>
						<li><a class="submenu" href="<?php echo base_url(); ?>departemen"><i class="icon-group"></i><span class="hidden-tablet"> &nbsp; Departments</span></a></li>
						<li><a class="submenu" href="<?php echo base_url(); ?>akses"><i class="icon-key"></i><span class="hidden-tablet"> &nbsp; Access</span></a></li>
					</ul>
				</li>
				<li><a href="<?php echo base_url(); ?>project"><i class="icon-globe"></i><span class="hidden-tablet"> Project</span></a></li>
			<?php endif; ?>

		</ul>
	</div>
</div>
<!-- end: Main Menu -->

<noscript>
	<div class="alert alert-block span10">
		<h4 class="alert-heading">Warning!</h4>
		<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
	</div>
</noscript>