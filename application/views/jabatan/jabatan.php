<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-briefcase"></i><a href="#"> Position</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-reorder"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
                                                        <a href="<?php echo site_url('jabatan/add') ?>" class="halflings-icon white plus"></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
						  <thead>
                                                    <tr>
                                                    <th>No</th>
                                                    <th>Position Name</th>
                                                    <th>Department</th>
                                                    <th><div align="center">Action</div></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php $i = 1 ?>
                                                        <?php foreach ($jabatan as $row): ?>
                                                        <td><?php echo $i++?></td>
                                                        <td><?php echo $row->nama_jabatan; ?></td>
                                                        <td><?php echo $row->nama_dept; ?></td>
                                                        <td><div align="center"><?php echo anchor('jabatan/edit/'.$row->id_jabatan, '&nbsp Edit &nbsp', array('class'=>'btn btn-mini btn-success')) . '  ' . anchor('jabatan/delete/'.$row->id_jabatan, 'Delete', array('class'=>'btn btn-mini btn-danger', 'onclick'=>"return confirm('Are you sure to delete this position?')")); ?></div></td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
	</div><!--/.fluid-container-->