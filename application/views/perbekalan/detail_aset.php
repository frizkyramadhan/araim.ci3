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
    		<div class="box span12">
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
    						<!-- <div class="control-group">
    							<label class="control-label">Specification</label>
    							<div class="controls">
    								<textarea class="span8" rows="3" disabled><?php echo $detail->spesifikasi; ?></textarea>
    							</div>
    						</div> -->
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
    	</div>
    	<div class="row-fluid sortable">
    		<!--/span-->
    		<div class="box span12">
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
    				<form role="form" action="" method="post">
    					<input name="id_perbekalan" type="hidden" value="<?php echo $detail->id_perbekalan; ?>" class="medium">
    					<table class="table table-condensed" width=100%>
    						<thead>
    							<tr>
    								<th>Component</th>
    								<th>Description</th>
    								<th>Remarks</th>
    								<?php if ($pengguna->level != "Read Only") : ?>
    									<th style="text-align: center;">Action</th>
    								<?php endif; ?>
    							</tr>
    						</thead>
    						<tbody>
    							<tr>
    								<?php foreach ($spec as $row) : ?>
    									<td><?php echo $row->komponen; ?>
    									<td><?php echo $row->spesifikasi; ?></td>
    									<td><?php echo $row->keterangan; ?></td>
    									<?php if ($pengguna->level != "Read Only") : ?>
    										<td style="text-align: center;">
    											<?php echo anchor('perbekalan/edit_spec/' . $detail->id_perbekalan . '/' . $row->id_spesifikasi, '&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;', array('class' => 'btn btn-small btn-warning')) ?>
    											<?php echo anchor('perbekalan/delete_spec/' . $detail->id_perbekalan . '/' . $row->id_spesifikasi, 'Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure to delete this specification?')")) ?>
    										</td>
    									<?php endif; ?>
    							</tr>
    						<?php endforeach; ?>
    						<tr id="last">
    							<td></td>
    							<td></td>
    							<td></td>
    							<?php if ($pengguna->level != "Read Only") : ?>
    								<td style="text-align: center;">
    									<button type="button" class="btn btn-small btn-success" id="addRow">+ Add</button>
    								</td>
    							<?php endif; ?>
    						</tr>
    						</tbody>
    					</table>
    					<?php if ($pengguna->level != "Read Only") : ?>
    						<div class="form-actions">
    							<button type="submit" class="btn btn-orange">Submit</button>
    							<button type="reset" class="btn btn-grey">Reset</button>
    						</div>
    					<?php endif; ?>
    				</form>
    			</div>
    		</div>
    		<div class="row-fluid sortable">
    			<div class=" box span5">
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
    			<div class="box span6">
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
    <script type="text/javascript">
    	// var count = 0;
    	// $(function() {
    	// 	$("#addRow").click(function() {
    	// 		row = `
    	// 		<tr>
    	// 		<td>
    	// 		<?php
					// 		$conn = mysqli_connect('localhost', 'root', '@rk@*', 'esis');
					// 		$sql = mysqli_query($conn, 'select * from komponen order by komponen asc');
					// 		if (mysqli_num_rows($sql)) {
					// 			$select = "<select name=id_komponen[] style=width:100%>";
					// 			while ($rs = mysqli_fetch_array($sql)) {
					// 				$select .= '<option value="' . $rs["id_komponen"] . '">' . $rs["komponen"] . '</option>';
					// 			}
					// 		}
					// 		$select .= '</select>';
					// 		echo $select;
					// 		
					?>
    	// 		</td>
    	//         <td><input name="spesifikasi_` + count + `" type="text" style="height:24px; width: 100%"></td>
    	//         <td><input name="keterangan_` + count + `" type="text" style="height:24px; width: 100%"></td>
    	//         <td><button type="button" class="del btn btn-small btn-danger">Delete</button></td>
    	//         </tr>`;
    	// 		$(row).insertBefore("#last");
    	// 	});
    	// });
    	var count = 0;
    	$(function() {
    		$("#addRow").click(function() {
    			count += 1;
    			row = `<tr>
    				<input id="id_perbekalan_` + count + `" name="id_perbekalan_` + count + `" type="hidden" style="width: 95%" value="" readonly="TRUE"><input id="rows_` + count + `" name="rows[]" value="` + count + `" type="hidden">
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
    					// console.log(repair);
    					var trHTML = '';
    					trHTML +=
    						`<table style="font-size : 13px;" class="table table-striped table-bordered table-hover">
								<tr>
									<th>Date</th>
									<th>Component</th>
									<th>Damage</th>
									<th>Cost</th>
								</tr>`;
    					$.each(repair, function(i, data) {
    						trHTML +=
    							`<tr>
								<td>` + data.date_repair + `</td>
								<td>` + data.komponen + ` ` + data.spesifikasi + `</td>
								<td>` + data.damage + `</td>
								<td><div align="right">` + data.cost + `</div></td>
							</tr>`;
    					});

    					// get sum of cost damage across all objects in array
    					var total = repair.reduce(function(prev, cur) {
    						return prev + parseInt(cur.cost);
    					}, 0);
    					trHTML += `<tr>
					    			<td colspan="3"><div align="right"><b>Total</b></div></td>
					    			<td><div align="right"><b>` + total + `</b></td>
							</tr>`;
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

    		// function
    	});
    </script>