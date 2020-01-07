<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-user"></i>
                                        <a href="<?php echo base_url();?>karyawan">User</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add User</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
                                        <div class="box-content alerts">
						<div class="alert alert-block ">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<h4 class="alert-heading">Warning!</h4>
							<p>If your position doesn't exist, please contact IT Officer HO Balikpapan!</p>
						</div>
					</div>
					<div class="box-content">
                                            <form class="form-horizontal" role="form" action="" method="post">
						  <fieldset>
							<table class="table">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>NIK</th>
                                                                <th>Name</th>
                                                                <th>Position</th>
                                                                <th>Project</th>
                                                                <th>Email</th>
                                                            </tr>
                                                            <?php $n=1;?>
                                                            <?php for($i=1;$i<=$banyak_data;$i++): ?>
                                                            <tr>
                                                                <td><?php echo $n++; ?></td>
                                                                <td><input name="data[<?php echo $i ?>][nik]" class="span12" size="6"/></td>
                                                                <td><input name="data[<?php echo $i ?>][nama]" class="span12" size="50"/></td>
                                                                <td><?=form_dropdown("data[$i][id_jabatan]",$jabatan,'','class="span12" data-rel="chosen"');?></td>
                                                                <td><?=form_dropdown("data[$i][id_project]",$project,'','class="span12" data-rel="chosen"');?></td>
                                                                <td><input name="data[<?php echo $i ?>][email]" class="span12" size="50"/></td>
                                                            </tr>
                                                            <?php endfor ?>
                                                        </table>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Submit</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   
					</div>
				</div><!--/span-->

			</div><!--/row-->    

	</div><!--/.fluid-container-->