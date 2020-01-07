<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-key"></i><a href="#"> Access</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-key"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
                                                        <a href="<?php echo site_url('akses/add') ?>" class="halflings-icon white plus"></a>
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
                                                        <th>Password</th>
                                                        <th>Department</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th><div align="center">Action</div></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php $i = 1 ?>
                                                        <?php foreach ($akses as $row): ?>
                                                        <td><?php echo $i++?></td>
                                                        <td><?php echo $row->nik; ?></td>
                                                        <td><?php echo $row->nama; ?></td>
                                                        <td><?php echo $row->password; ?></td>
                                                        <td><?php echo $row->nama_dept; ?></td>
                                                        <td><?php echo $row->level; ?></td>
                                                        <td><?php echo $row->status; ?></td>
                                                        <td><div align="center"><?php echo anchor('akses/edit/'.$row->id_akses, '&nbsp Edit &nbsp', array('class'=>'btn btn-mini btn-success')) . '  ' . anchor('akses/delete/'.$row->id_akses, 'Delete', array('class'=>'btn btn-mini btn-danger', 'onclick'=>"return confirm('Are you sure to delete this user access?')")); ?></div></td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
	</div><!--/.fluid-container-->