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
    			<a href="#">Edit Inventories</a>
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
    				<!-- <pre><?php echo print_r($perbekalan) ?></pre> -->
    				<form class="form-horizontal" role="form" action="" method="post">
    					<fieldset>
    						<div class="control-group">
    							<label class="control-label">Date</label>
    							<div class="controls">
    								<input name="tanggal" class="span6 input-xlarge datepicker" placeholder="Date" type="text" value="<?php echo $perbekalan->tanggal ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Asset</label>
    							<div class="controls">
    								<?= form_dropdown('id_aset', $aset_options, $select_aset, 'class="span6" id="selectError" data-rel="chosen"'); ?>
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Merk</label>
    							<div class="controls">
    								<input type="text" class="span6" name="merk" value="<?php echo $perbekalan->merk; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Model</label>
    							<div class="controls">
    								<input type="text" class="span6" name="model" value="<?php echo $perbekalan->model; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Serial Number</label>
    							<div class="controls">
    								<input type="text" class="span6" name="sn" value="<?php echo $perbekalan->sn; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Part Number</label>
    							<div class="controls">
    								<input type="text" class="span6" name="pn" value="<?php echo $perbekalan->pn; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">PO Number</label>
    							<div class="controls">
    								<input type="text" class="span6" name="po" value="<?php echo $perbekalan->po; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Ref Number</label>
    							<div class="controls">
    								<input type="text" class="span6" name="ref_no" placeholder="Ref Number (TA / BA)" value="<?php echo $perbekalan->ref_no; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Ref Date</label>
    							<div class="controls">
    								<input type="text" class="span6 input-xlarge datepicker" name="ref_date" placeholder="Ref Date" value="<?php echo $perbekalan->ref_date; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Qty</label>
    							<div class="controls">
    								<input type="text" class="span6" name="jumlah" value="<?php echo $perbekalan->jumlah; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Location</label>
    							<div class="controls">
    								<input type="text" class="span6" name="lokasi" value="<?php echo $perbekalan->lokasi; ?>" />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Specification</label>
    							<div class="controls">
    								<textarea class="span8" rows="3" name="spesifikasi"><?php echo $perbekalan->spesifikasi; ?></textarea>
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Remark</label>
    							<div class="controls">
    								<textarea class="span8" rows="3" name="remarks"><?php echo $perbekalan->remarks; ?></textarea>
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Status</label>
    							<div class="controls">
    								<?php if ($perbekalan->status == 'Mutated') : ?>
    									<input type="text" class="span6" value="<?php echo $perbekalan->status; ?>" readonly="TRUE" />
    								<?php else : ?>
    									<?php
										$status_options = array(
											'Available' => 'Available',
											'Broken' => 'Broken',
											'Discarded' => 'Discarded'
										);
										echo form_dropdown('status', $status_options, $select_status, 'class=span6');
										?>
    								<?php endif; ?>
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