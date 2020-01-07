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
                                                      <div class="span12">
                                                      
                                                      <table class="table table-condensed">
                                                          <tr>
                                                              <td width="20%"><b>Detail Asset</b></td>
                                                              <td></td>
                                                              <td></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>Asset</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->nama_aset?></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>Merk</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->merk?></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>Model</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->model?></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>Serial No.</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->sn?></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>Part No.</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->pn?></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>Qty</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->jumlah?></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td><b>Previous User</b></td>
                                                              <td></td>
                                                              <td></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>NIK</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->nik?></td>
                                                          <tr>                                                          
                                                          <tr>
                                                              <td>Name</td>
                                                              <td>:</td>
                                                              <td><?php echo $transfer->nama?></td>
                                                          <tr>                                                                                                                   
                                                          <tr>
                                                              <td><b>New User</b></td>
                                                              <td></td>
                                                              <td></td>
                                                          <tr>                                                                                                                   
                                                          <tr>
                                                              <td>NIK</td>
                                                              <td>:</td>
                                                              <td><?=form_dropdown('id_karyawan',$nik_options,'','class="span6" id="selectError" data-rel="chosen"');?></td>
                                                          <tr>                                                                                                                   
                                                          <tr>
                                                              <td>Date</td>
                                                              <td>:</td>
                                                              <td><input name="tanggal" class="span6 datepicker" placeholder=" Date" value="<?php echo set_value("tanggal");?>"/>
                                                              <span style="color: red"><?php echo form_error("tanggal");?></span></td>
                                                          <tr>                                                                                                                   
                                                          <tr>
                                                              <td>Remarks</td>
                                                              <td>:</td>
                                                              <td><textarea class="span6" rows="3" name="remarks" placeholder="Condition, Spesification, etc..."><?php echo $transfer->remarks;?></textarea>
                                                              <span style="color: red"><?php echo form_error("remarks");?></span></td>
                                                          <tr>                                                                                                                   
                                                      </table>
                                                      
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->no_inv;?>" name="no_inv" />
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->id_aset;?>" name="id_aset" placeholder="Aset"/>
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->merk;?>" name="merk" placeholder="Merk"/>
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->model;?>" name="model" placeholder="Model"/>
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->sn;?>" name="sn" placeholder="Serial No."/>
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->pn;?>" name="pn" placeholder="Part No."/>
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->jumlah;?>" name="jumlah" placeholder="Qty"/>
                                                      <input type="hidden" class="span6" value="<?php echo $transfer->input_by;?>" name="input_by" placeholder="Input"/>
                                                        
														
                                                        
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Submit</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
							</div>
						  </fieldset>
						</form>   
					</div>
				</div><!--/span-->

			</div><!--/row-->    

	</div><!--/.fluid-container-->