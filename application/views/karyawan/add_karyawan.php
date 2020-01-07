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
							<div class="control-group">
                                                            <label class="control-label">NIK</label>
							  <div class="controls">
                                                              <input type="text" class="span6" name="nik"/>
							  </div>
							</div>
							<div class="control-group">
                                                            <label class="control-label">Name</label>
							  <div class="controls">
                                                              <input type="text" class="span6" name="nama"/>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Position</label>
							  <div class="controls">
                                                              <?=form_dropdown('id_jabatan',$jabatan,'','class="span6" data-rel="chosen"');?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Project</label>
							  <div class="controls">
                                                              <?=form_dropdown('id_project',$project,'','class="span6" data-rel="chosen"');?>
							  </div>
							</div>
                                                        <div class="control-group">
                                                            <label class="control-label">Email</label>
							  <div class="controls">
                                                              <input type="text" class="span6" name="email"/>
							  </div>
							</div>
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