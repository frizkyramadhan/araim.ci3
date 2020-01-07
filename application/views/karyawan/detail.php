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
                                        <a href="#">User</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-list-alt"></i>
					<a href="#">Detail User</a>
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
                                                            <label class="control-label">NIK</label>
							  <div class="controls">
                                                              <input type="text" class="input-xlarge disabled span6" id="disabledInput" disabled="" name="nik" value="<?php echo $detail->nik ?>"/>
							  </div>
							</div>
							<div class="control-group">
                                                            <label class="control-label">Name</label>
							  <div class="controls">
                                                              <input type="text" class="input-xlarge disabled span6" id="disabledInput" disabled="" name="nama" value="<?php echo $detail->nama ?>"/>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Position</label>
							  <div class="controls">
                                                              <input type="text" class="input-xlarge disabled span6" id="disabledInput" disabled="" name="nama" value="<?php echo $detail->nama_jabatan ?>"/>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Project</label>
							  <div class="controls">
                                                              <input type="text" class="input-xlarge disabled span6" id="disabledInput" disabled="" name="nama" value="<?php echo $detail->nama_project ?>"/>
							  </div>
							</div>
                                                        <div class="control-group">
                                                            <label class="control-label">Email</label>
							  <div class="controls">
                                                              <input type="text" class="input-xlarge disabled span6" id="disabledInput" disabled="" name="email" value="<?php echo $detail->email ?>"/>
							  </div>
							</div>
							<div class="form-actions">
                                                            <?php echo anchor('karyawan/edit/'.$detail->id_karyawan, '&nbsp Edit &nbsp', array('class'=>'btn btn-primary'))?>
							</div>
						  </fieldset>
						</form>   
					</div>
				</div><!--/span-->

			</div><!--/row-->    

	</div><!--/.fluid-container-->