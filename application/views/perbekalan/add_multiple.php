<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-barcode"></i>
                                        <a href="<?php echo base_url();?>perbekalan">Inventories</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Inventories</a>
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
							  <label class="control-label">Select User</label>
							  <div class="controls">
                                                              <?=form_dropdown('nik',$nik,'','class="span6" id="selectError" data-rel="chosen"');?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Qty of Items</label>
							  <div class="controls">
                                                              <input name="banyak_data" class="span6" type="text" value="<?php echo set_value('banyak_data'); ?>"/>
                                                                <span class="help-inline">1, 2, 3, ...</span>
                                                                <span style="color: red"><?php echo form_error("banyak_data");?></span>
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