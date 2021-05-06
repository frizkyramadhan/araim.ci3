<!-- start: Content -->
<div id="content" class="span10">


	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="<?php echo base_url(); ?>">Home</a>
			<i class="icon-angle-right"></i>
		</li>
		<li><i class="icon-barcode"></i><a href="#"> Inventories</a></li>
	</ul>
	<?php
	$nik = $this->session->userdata('nik');
	$pengguna = $this->login_m->dataPengguna($nik);
	?>

	<div class="row-fluid">

		<div class="box span12">
			<div class="box-header">
				<h2><i class="icon-barcode"></i><span class="break"></span><?php echo $subtitle; ?></h2>
				<div class="box-icon" align="left">

				</div>
			</div>
			<div class="box-content">
				<ul class="nav tab-menu nav-tabs" id="myTab">
					<li><a href="#custom">List by Employee</a></li>
					<li class="active"><a href="#messages">List by Asset</a></li>
				</ul>

				<div id="myTabContent" class="tab-content">
					<div class="tab-pane" id="custom">
						<?php if ($pengguna->level != "Read Only") : ?>
							<div align="right"><?php echo anchor('perbekalan/add_multiple', '&nbsp Add &nbsp', array('class' => 'btn btn-primary')); ?></div>
						<?php endif; ?>
						<table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
							<thead>
								<tr>
									<th>NIK</th>
									<th>Name</th>
									<th>Project</th>
									<th>Position</th>
									<th>Total Assets</th>
									<th>
										<div align="center">Action</div>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php foreach ($perbekalan as $row) : ?>
										<td><?php echo $row->nik; ?></td>
										<td><?php echo $row->nama; ?></td>
										<td><?php echo $row->kode_project; ?></td>
										<td><?php echo $row->nama_jabatan; ?></td>
										<td><?php $count = $this->db->query("select * from perbekalan, karyawan where perbekalan.id_karyawan = karyawan.id_karyawan and karyawan.nik = " . $row->nik . " and perbekalan.status = 'Available'")->num_rows();
											echo $count; ?></td>
										<td>
											<div align="center">
												<?php echo anchor('perbekalan/detail/' . $row->nik, 'Detail', array('class' => 'btn btn-mini btn-success')) ?>
												<?php if ($pengguna->level == "Admin") {
													echo anchor('perbekalan/delete/' . $row->nik, 'Delete', array('class' => 'btn btn-mini btn-danger', 'onclick' => "return confirm('Are you sure to delete this inventories?')"));
												}
												?>
											</div>
										</td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="messages">
						<div align="right"><?php echo anchor('perbekalan/export', '&nbsp Export &nbsp', array('class' => 'btn btn-primary')); ?></div>
						<table id="example" class="table table-striped table-bordered table-condensed bootstrap-datatable datatable" cellspacing="0" width="100%" style="display: block; overflow-x: auto">
							<thead>
								<tr>
									<th>No</th>
									<th>Inventory No.</th>
									<th>Date</th>
									<th>Asset</th>
									<th>Merk/Model</th>
									<th>S/N</th>
									<th>PO Number</th>
									<th>Ref Number</th>
									<th>Ref Date</th>
									<th>PIC</th>
									<th>Project</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php $i = 1; ?>
									<?php foreach ($list as $row1) : ?>
										<td><?php echo $i++; ?></td>
										<td><?php echo anchor('perbekalan/detail_aset/' . $row1->id_perbekalan, $row1->no_inv); ?></td>
										<td><?php echo $row1->tanggal; ?></td>
										<td><?php echo $row1->nama_aset; ?></td>
										<td><?php echo $row1->merk; ?> / <?php echo $row1->model; ?></td>
										<td><?php echo $row1->sn; ?></td>
										<td><?php echo $row1->po; ?></td>
										<td><?php echo $row1->ref_no; ?></td>
										<td><?php echo $row1->ref_date; ?></td>
										<td><?php echo $row1->nama; ?></td>
										<td><?php echo $row1->nama_project; ?></td>
										<td>
											<div align="center">
												<?php if ($row1->status == "Available") : ?>
													<span class="label label-success"><?php echo $row1->status; ?></span>
												<?php elseif ($row1->status == "Mutated") : ?>
													<span class="label"><?php echo $row1->status; ?></span>
												<?php elseif ($row1->status == "Broken") : ?>
													<span class="label label-important"><?php echo $row1->status; ?></span>
												<?php elseif ($row1->status == "Discarded") : ?>
													<span class="label label-inverse"><?php echo $row1->status; ?></span>
												<?php endif; ?>
											</div>
										</td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--/span-->

	</div>
	<!--/row-->
	<?php //echo anchor('perbekalan/execute', "GO!");
	?>
</div>
<!--/.fluid-container-->