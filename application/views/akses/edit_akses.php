<!-- start: Content -->
			<div id="content" class="span10">
			<?php
            $opt_level = array ('Admin'=>'Admin','Super User'=>'Super User','User'=>'User','Read Only'=>'Read Only');
			$opt_status = array ('Enable'=>'Enable', 'Disable'=>'Disable');
			?>
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-key"></i>
                                        <a href="<?php echo base_url();?>akses">Access</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Access</a>
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
					<div class="box-content">
                                            <form class="form-horizontal" role="form" action="" method="post">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label">Name</label>
							  <div class="controls">
                                                              <input value="<?php echo $akses->nama; ?>" class="input-xlarge disabled span6" id="disabledInput" disabled="" type="text">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Password</label>
							  <div class="controls">
                                                              <input class="span6" placeholder="Password" type="text" name="password" value="<?php echo $akses->password; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Level</label>
							  <div class="controls">
                                                              <?=form_dropdown('level',$opt_level,$select_level, 'class="span6"');?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Status</label>
							  <div class="controls">
                                                              <?=form_dropdown('status',$opt_status,$select_status, 'class="span6"');?>
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