<!-- start: Content -->
<div id="content" class="span10">


	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="<?php echo base_url(); ?>">Home</a>
			<i class="icon-angle-right"></i>
		</li>
		<li>
			<i class="icon-barcode"></i>
			<a href="<?php echo base_url(); ?>perbekalan">Inventories</a>
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
				<h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo $subtitle; ?></h2>
				<div class="box-icon">

					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" role="form" action="" method="post">
					<fieldset>
						<input name="id_karyawan" class="span6" value="<?php echo $user->id_karyawan; ?>" type="hidden" />
						<input name="no_inv" class="span6" value="<?php echo date('y');
																	echo date('m'); ?><?php echo $no_inv; ?>" type="hidden" />
						<input name="status" class="span6" value="Available" type="hidden" />
						<div class="control-group">
							<label class="control-label">Date</label>
							<div class="controls">
								<input type="text" name="tanggal" class="span6 input-xlarge datepicker" placeholder="Date" value="<?php echo set_value("tanggal") ?>" />
								<span style="color: red"><?php echo form_error("tanggal"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Asset</label>
							<div class="controls">
								<?= form_dropdown('id_aset', $aset_options, '', 'class="span6" id="selectError" data-rel="chosen"'); ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Merk</label>
							<div class="controls">
								<input type="text" class="span6" name="merk" placeholder="Merk" value="<?php echo set_value("merk"); ?>" />
								<span style="color: red"><?php echo form_error("merk"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Model</label>
							<div class="controls">
								<input type="text" class="span6" name="model" placeholder="Model" value="<?php echo set_value("model"); ?>" />
								<span style="color: red"><?php echo form_error("model"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Serial Number</label>
							<div class="controls">
								<input type="text" class="span6" name="sn" placeholder="Serial Number" value="<?php echo set_value("sn"); ?>" />
								<span style="color: red"><?php echo form_error("sn"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Part Number</label>
							<div class="controls">
								<input type="text" class="span6" name="pn" placeholder="Part Number" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">PO Number</label>
							<div class="controls">
								<input type="text" class="span6" name="po" placeholder="PO Number" value="<?php echo set_value("po"); ?>" />
								<span style="color: red"><?php echo form_error("po"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Ref Number</label>
							<div class="controls">
								<input type="text" class="span6" name="ref_no" placeholder="Ref Number (TA / BA)" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Ref Date</label>
							<div class="controls">
								<input type="text" class="span6 input-xlarge datepicker" name="ref_no" placeholder="Ref Date" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Qty</label>
							<div class="controls">
								<input name="jumlah" class="span6" placeholder="Qty" type="text" value="<?php echo set_value("jumlah"); ?>" />
								<span style="color: red"><?php echo form_error("jumlah"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Location</label>
							<div class="controls">
								<input name="lokasi" class="span6" placeholder="Detail Location" type="text" value="<?php echo set_value("lokasi"); ?>" />
								<span style="color: red"><?php echo form_error("lokasi"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Specification</label>
							<div class="controls">
								<textarea class="span6" rows="3" name="spesifikasi" placeholder="Specification"><?php echo set_value("spesifikasi"); ?></textarea>
								<span style="color: red"><?php echo form_error("spesifikasi"); ?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Remarks</label>
							<div class="controls">
								<textarea class="span6" rows="3" name="remarks" placeholder="Condition, etc..."><?php echo set_value("remarks"); ?></textarea>
								<span style="color: red"><?php echo form_error("remarks"); ?></span>
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