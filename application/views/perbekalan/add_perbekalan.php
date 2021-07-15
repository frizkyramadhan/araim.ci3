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

	<form class="form-horizontal" role="form" action="" method="post">
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo $subtitle; ?></h2>
					<div class="box-icon">
						<a href="<?php echo base_url('perbekalan/detail/' . $user->nik); ?>"><i class="halflings-icon white chevron-left"></i></a>
						<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input name="id_karyawan" class="span6" value="<?php echo $user->id_karyawan; ?>" type="hidden" />
					<input name="no_inv" class="span6" value="<?php echo date('y');
												echo date('m'); ?><?php echo $no_inv; ?>" type="hidden" />
					<input name="status" class="span6" value="Available" type="hidden" />
					<div class="control-group">
						<label class="control-label">Date</label>
						<div class="controls">
							<input type="text" name="tanggal" class="span6 input-xlarge datepicker" placeholder="Date" value="<?php echo set_value("tanggal") ?>" autocomplete="off" />
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
							<input type="text" class="span6 input-xlarge datepicker" name="ref_date" placeholder="Ref Date" />
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
							<input name="lokasi" class="span6" placeholder="000H Acc Room" type="text" value="<?php echo set_value("lokasi"); ?>" />
							<span style="color: red"><?php echo form_error("lokasi"); ?></span>
						</div>
					</div>
					<!-- <div class="control-group">
							<label class="control-label">Specification</label>
							<div class="controls">
								<textarea class="span6" rows="3" name="spesifikasi" placeholder="Specification"><?php echo set_value("spesifikasi"); ?></textarea>
								<span style="color: red"><?php echo form_error("spesifikasi"); ?></span>
							</div>
						</div> -->
					<div class="control-group">
						<label class="control-label">Remarks</label>
						<div class="controls">
							<textarea class="span6" rows="3" name="remarks" placeholder="Condition, etc..."><?php echo set_value("remarks"); ?></textarea>
							<span style="color: red"><?php echo form_error("remarks"); ?></span>
						</div>
					</div>
				</div>
			</div>
			<!--/span-->

		</div>
		<div class="row-fluid sortable">
			<!--/span-->
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon white cog"></i><span class="break"></span>Specification</h2>
					<div class="box-icon">
						<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">×</button>
						If this asset doesn't have specification, choose <strong>Other</strong> in Component
					</div>
					<table class="table table-condensed" width=100%>
						<thead>
							<tr>
								<th>Component</th>
								<th>Description</th>
								<th>Remarks</th>
								<th style="text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr id="last">
								<td></td>
								<td></td>
								<td></td>
								<td style="text-align: center;">
									<button type="button" class="btn btn-small btn-success" id="addRow">+ Add</button>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<!--/row-->
	</form>
</div>
<!--/.fluid-container-->

<script type="text/javascript">
	var count = 0;
	$(function() {
		$("#addRow").click(function() {
			count += 1;
			row = `<tr>
    				<input id="id_perbekalan_` + count + `" name="id_perbekalan_` + count + `" type="hidden" style="width: 95%" value="" readonly="TRUE">
				<input id="rows_` + count + `" name="rows[]" value="` + count + `" type="hidden">
    				<td style="padding: 5px">
    				<select name="id_komponen_` + count + `" style="width:100%">
    				<option value = "" > --Choose Component-- </option>
    			<?php
				foreach ($komponen as $data) {
					echo "<option value='" . $data->id_komponen . "'>" . $data->komponen . "</option>";
				}
				?>
    				</select></td >
    				<td style="padding: 5px"><input id="spesifikasi_` + count + `" name="spesifikasi_` + count + `" type="text" style="width: 97%"></td>
    				<td style="padding: 5px"><input id="keterangan_` + count + `" name="keterangan_` + count + `" type="text" style="width: 80%"></td>
    				<td style="text-align:center; padding: 5px"><button type="button" class="del btn btn-small btn-danger">Delete</button></td>
    				</tr>`;
			$(row).insertBefore("#last");
			i++;
		});
	});
	$("body").on('click', '.del', function() {
		$(this).parent().parent().remove();
	});
</script>