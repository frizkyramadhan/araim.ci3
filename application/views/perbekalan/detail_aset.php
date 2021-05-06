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
    			<a href="#">Asset Detail</a>
    		</li>
    	</ul>
    	<!-- <pre><?php echo print_r($detail) ?></pre> -->
    	<div class="row-fluid sortable">
    		<div class="box span7">
    			<div class="box-header" data-original-title>
    				<h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo $subtitle; ?></h2>
    				<div class="box-icon">

    					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
    					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
    				</div>
    			</div>
    			<div class="box-content">
    				<?php
					$nik = $this->session->userdata('nik');
					$pengguna = $this->login_m->dataPengguna($nik);
					?>
    				<form class="form-horizontal" role="form" action="" method="post">
    					<fieldset>
    						<div class="control-group">
    							<label class="control-label">Date</label>
    							<div class="controls">
    								<input class="span6 input-xlarge datepicker" placeholder="Date" type="text" value="<?php echo $detail->tanggal ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">

    							<label class="control-label">Inv No.</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->no_inv; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Asset</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->nama_aset; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Merk</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->merk; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Model</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->model; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Serial Number</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->sn; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Part Number</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->pn; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">PO Number</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->po; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Ref Number</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->ref_no; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Ref Date</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->ref_date; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Qty</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->jumlah; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Location</label>
    							<div class="controls">
    								<input type="text" class="span6" value="<?php echo $detail->lokasi; ?>" disabled />
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Specification</label>
    							<div class="controls">
    								<textarea class="span8" rows="3" disabled><?php echo $detail->spesifikasi; ?></textarea>
    							</div>
    						</div>
    						<div class="control-group">
    							<label class="control-label">Remark</label>
    							<div class="controls">
    								<textarea class="span8" rows="3" disabled><?php echo $detail->remarks; ?></textarea>
    							</div>
    						</div>

    						<?php if ($pengguna->level != "Read Only") : ?>
    							<div class="form-actions">
    								<?php echo anchor('perbekalan/edit/' . $detail->nik . '/' . $detail->id_perbekalan, '&nbsp&nbsp&nbsp Edit &nbsp&nbsp&nbsp', array('class' => 'btn btn-success')); ?>
    								<?php if ($detail->status != "Mutated") {
										echo anchor('perbekalan/transfer/' . $detail->no_inv . '/' . $detail->id_perbekalan, '&nbsp Transfer &nbsp', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure to transfer this inventory?')"));
									}
									?>
    							</div>
    						<?php endif; ?>

    					</fieldset>
    				</form>
    			</div>
    		</div>
    		<!--/span-->
    		<div class="box span4">
    			<div class="box-header" data-original-title>
    				<h2><i class="halflings-icon white cog"></i><span class="break"></span>Specification</h2>
    				<div class="box-icon">
    					<?php if ($pengguna->level == "Admin") : ?>
    						<a href="<?php echo site_url('perbekalan/add_spec/' . $detail->id_perbekalan) ?>" class="halflings-icon white plus"></a>
    					<?php endif; ?>
    					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
    					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
    				</div>
    			</div>
    			<div class="box-content">
    				<table class="table table-condensed" width=100%>
    					<thead>
    						<tr>
    							<th>No</th>
    							<th>Component</th>
    							<th>Description</th>
    							<th>Status</th>
    							<th style="width: 25%;">Act</th>
    						</tr>
    					</thead>
    					<tbody>
    						<tr>
    							<?php $i = 1; ?>
    							<?php if (empty($spec)) : ?>
    								<td colspan="5" style="text-align: center;">No Data Available</td>
    							<?php else : ?>
    								<?php foreach ($spec as $row) : ?>
    									<td><?php echo $i++; ?></td>
    									<td><?php echo anchor('perbekalan/edit_spec/' . $detail->id_perbekalan . '/' . $row->id_spesifikasi, $row->komponen) ?>
    									<td><?php echo $row->spesifikasi; ?></td>
    									<td>
    										<?php if ($row->is_active == 1) {
												echo '<span class="label label-success">Active</span>';
											} else {
												echo '<span class="label label-important">Inactive</span>';
											} ?>
    									</td>
    									<td>
    										<?php echo anchor('perbekalan/delete_spec/' . $detail->id_perbekalan . '/' . $row->id_spesifikasi, '<i class="icon-trash"></i>', array('class' => 'btn btn-mini btn-danger', 'onclick' => "return confirm('Are you sure to delete this specification?')")) ?>
    									</td>
    						</tr>
    					<?php endforeach; ?>
    				<?php endif; ?>
    					</tbody>
    				</table>
    			</div>
    		</div>

    		<div class=" box span4">
    			<div class="box-header" data-original-title>
    				<h2><i class="halflings-icon white qrcode"></i><span class="break"></span>QR Code</h2>
    				<div class="box-icon">
    					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
    					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
    				</div>
    			</div>
    			<div class="box-content" align="center">
    				<?php if (empty($detail->qrcode)) : ?>
    				<?php else : ?>
    					<img src="<?php echo base_url(); ?>img/qrcode/<?php echo $detail->qrcode ?>" width="400">
    					<br>
    					<?php echo anchor('perbekalan/print_qrcode_id/' . $detail->id_perbekalan, '<i class="halflings-icon white qrcode"></i> Print', array('class' => 'btn btn-success', 'target' => 'blank')); ?>
    				<?php endif; ?>
    			</div>
    		</div>

    		<div class="box span4">
    			<div class="box-header" data-original-title>
    				<h2><i class="halflings-icon white tags"></i><span class="break"></span>Repair History</h2>
    				<div class="box-icon">

    					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
    					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
    				</div>
    			</div>
    			<div class="box-content" id="repair-history">
    			</div>
    		</div>
    	</div>
    	<div id="repair-detail">
    	</div>
    	<!--/row-->
    	<div class="modal hide fade" id="myModal">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal">×</button>
    			<h3>Settings</h3>
    		</div>
    		<div class="modal-body">
    			<p>Here settings can be configured...</p>
    		</div>
    		<div class="modal-footer">
    			<a href="#" class="btn" data-dismiss="modal">Close</a>
    			<a href="#" class="btn btn-primary">Save changes</a>
    		</div>
    	</div>
    </div>
    <!--/.fluid-container-->

    <script>
    	$(document).ready(function() {
    		$('#repair-history').html('');
    		$.ajax({
    			url: 'http://localhost/arka-rest-server/api/repair',
    			type: 'get',
    			datatype: 'json',
    			data: {
    				'arka-key': 'arka123',
    				'id_perbekalan': <?php echo $detail->id_perbekalan ?>
    			},
    			success: function(result) {
    				if (result.status == true) {
    					let repair = result.data;
    					console.log(repair);
    					var trHTML = '';
    					trHTML +=
    						`<table style="font-size : 13px;" class="table table-striped table-bordered table-hover">
								<tr>
									<th>Date</th>
									<th>Damage</th>
									<th>Cost</th>
								</tr>`
    					$.each(repair, function(i, data) {
    						trHTML +=
    							`<tr>
									<td>` + data.date_repair + `</td>
									<td>` + data.damage + `</td>
									<td>` + data.cost + `</td>
								</tr>`;
    					});
    					trHTML += `</table>`;
    					$('#repair-history').append(trHTML);
    				} else {
    					$('#repair-history').html(`
						<div>
							<h4 class="text-center">` + result.message + `</h4>
						</div>`);
    				}
    			}
    		});
    	});
    </script>