<!-- start: Content -->
			<div id="content" class="span10">
			
			
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
					<a href="#">Add Access</a>
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
                                                              <?=form_dropdown('id_karyawan',$options,'', 'class="span6" id="selectError" data-rel="chosen"');?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Password</label>
							  <div class="controls">
                                                              <input class="span6" placeholder="Password" type="text" name="password">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Level</label>
							  <div class="controls">
                                                              <select name="level" class="span6">
                                                                <option value="Admin">Admin</option>
																<option value="Super User">Super User</option>
                                                                <option value="User" selected="selected">User</option>
                                                                <option value="Read Only">Read Only</option>
                                                            </select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Status</label>
							  <div class="controls">
                                                              <select name="status" class="span6">
                                                                <option value="Enable" selected="selected">Enable</option>
                                                                <option value="Disable">Disable</option>
                                                            </select>
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