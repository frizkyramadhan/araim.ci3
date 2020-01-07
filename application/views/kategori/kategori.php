<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-reorder"></i><a href="#"> Category</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-reorder"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
                                                        <a href="<?php echo site_url('kategori/add') ?>" class="halflings-icon white plus" alt="Add Category"></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
						  <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Category Name</th>
                                                        <th><div align="center">Action</div></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <?php $i = 1 ?>
                                                        <?php foreach ($kategori as $row): ?>
                                                        <td><?php echo $i++?></td>
                                                        <td><?php echo $row->nama_kategori; ?></td>
                                                        <td><div align="center"><?php echo anchor('kategori/edit/'.$row->id_kategori, '&nbsp;&nbsp;Edit&nbsp;&nbsp;', array('class'=>'btn btn-mini btn-success')) . '  ' . anchor('kategori/delete/'.$row->id_kategori, 'Delete', array('class'=>'btn btn-mini btn-danger', 'onclick'=>"return confirm('Are you sure to delete this category?')")); ?></div></td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
	</div><!--/.fluid-container-->