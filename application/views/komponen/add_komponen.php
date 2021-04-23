<!-- start: Content -->
<div id="content" class="span10">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="<?php echo base_url(); ?>">Home</a>
			<i class="icon-angle-right"></i>
		</li>
		<li>
			<i class="icon-cog"></i>
			<a href="<?php echo base_url(); ?>komponen">Component</a>
			<i class="icon-angle-right"></i>
		</li>
		<li>
			<i class="icon-edit"></i>
			<a href="#">Add Component</a>
		</li>
	</ul>

	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo $subtitle; ?></h2>
				<div class="box-icon">

					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" role="form" action="" method="post">
					<fieldset>
						<div class="control-group">
							<label class="control-label">Component Name</label>
							<div class="controls">
								<input type="text" class="span6" name="komponen" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Status</label>
							<div class="controls">
								<select class="span6" id="selectError" data-rel="chosen" name="is_active">
									<option value="1">Active</option>
									<option value="0">Not Active</option>
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
		</div>
		<!--/span-->

	</div>
	<!--/row-->

</div>
<!--/.fluid-container-->