<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-user"></i><a href="#"> User</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-user"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
                                                        <a href="<?php echo site_url('karyawan/add') ?>" class="halflings-icon white plus"></a>
                                                        <a href="<?php echo site_url('karyawan/add_multiple') ?>" class="halflings-icon white plus-sign"></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
						  <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>NIK</th>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <!--<th>Department</th>-->
                                                        <th>Project</th>
                                                        <th><div align="center">Action</div></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php $i = 1 ?>
                                                        <?php foreach ($karyawan as $row): ?>
                                                        <td><?php echo $i++?></td>
                                                        <td><a href="<?php echo site_url('karyawan/detail/'.$row->nik); ?>"><?php echo $row->nik; ?></a></td>
                                                        <td><?php echo $row->nama; ?></td>
                                                        <td><?php echo $row->nama_jabatan; ?></td>
                                                        <!--<td><?php echo $row->nama_dept; ?></td>-->
                                                        <td><?php echo $row->kode_project; ?></td>
                                                        <td><div align="center"><?php echo anchor('karyawan/detail/'.$row->nik, '&nbsp Detail &nbsp', array('class'=>'btn btn-mini btn-info')). '  ' .anchor('karyawan/edit/'.$row->id_karyawan, '&nbsp Edit &nbsp', array('class'=>'btn btn-mini btn-success')) . '  ' . anchor('karyawan/delete/'.$row->id_karyawan, 'Delete', array('class'=>'btn btn-mini btn-danger', 'onclick'=>"return confirm('Are you sure to delete this employee?')")); ?></div></td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
	</div><!--/.fluid-container-->