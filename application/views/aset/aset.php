<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-gift"></i><a href="#"> Asset</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-gift"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
                                                        <a href="<?php echo site_url('aset/add') ?>" class="halflings-icon white plus"></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
						  <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Asset Name</th>
                                                        <th>Category</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php $i = 1 ?>
                                                        <?php foreach ($aset as $row): ?>
                                                        <td><?php echo $i++?></td>
                                                        <td><?php echo $row->nama_aset; ?></td> 
                                                        <td><?php echo $row->nama_kategori; ?></td>
                                                        <td><?php echo anchor('aset/edit/'.$row->id_aset, '&nbsp Edit &nbsp', array('class'=>'btn btn-mini btn-success')) . '  ' . anchor('aset/delete/'.$row->id_aset, 'Delete', array('class'=>'btn btn-mini btn-danger', 'onclick'=>"return confirm('Are you sure to delete this item?')")); ?></td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
	</div><!--/.fluid-container-->