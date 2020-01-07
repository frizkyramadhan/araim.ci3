<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-file-alt"></i>
                                        <a href="<?php echo base_url();?>form">Asset Allocation Form</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Form</a>
				</li>
			</ul>
			<?php
                        $nik = $this->session->userdata('nik');
                        $pengguna = $this->login_m->dataPengguna($nik);
                        ?>
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
							  <label class="control-label">Form No.</label>
							  <div class="controls">
                                                              <span class="input-xlarge uneditable-input"><?php echo $no_form; ?></span>
                                                              <input type="hidden" class="span6" name="no_form" value="<?php echo $no_form; ?>"/>
							  </div>
							</div>
                                                        <div class="control-group">
							  <label class="control-label">Date</label>
							  <div class="controls">
                                                              <span class="input-xlarge uneditable-input"><?php echo date('Y-m-d')?></span>
                                                              <input type="hidden" class="span6 datepicker" name="date" value="<?php echo date('Y-m-d')?>"/>
							  </div>
							</div>
                                                        <input type="hidden" class="span6" name="input_by" value="<?php echo $pengguna->id_karyawan; ?>"/>
							<div class="control-group">
                                                            <div class="alert alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                                    <i class="halflings-icon arrow-down"></i> Your inventories must be in one page, please select the appropriate numbers (10, 25, 50, 100) below to make your inventories in one page.
                                                            </div>
                                                            <span style="color: red"><?php echo form_error("id_perbekalan");?></span>
                                                            <table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable" style="font-size: 10pt">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 20px"></th>
                                                                        <th>Inventory No.</th>
                                                                        <th>Asset</th>
                                                                        <th>Merk / Model</th>
                                                                        <th>S/N / P/N</th>
                                                                        <th>Date</th>
                                                                        <th><div align="center">Status</div></th>
                                                                        <th><div align="center">PIC</div></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php $n=1;?>
                                                                        <?php foreach ($perbekalan as $row): ?>
                                                                        <td><?php echo form_checkbox('id_perbekalan[]',$row->id_perbekalan);?></td>
                                                                        <td><?php echo $row->no_inv; ?></td>
                                                                        <td><?php echo $row->nama_aset; ?></td>
                                                                        <td><?php echo $row->merk;?> / <?php echo $row->model;?></td>
                                                                        <td><?php echo $row->sn;?> / <?php echo $row->pn;?></td>
                                                                        <td><?php echo $row->tanggal; ?></td>
                                                                        <td><div align="center">
                                                                            <?php if($row->status == "Available"):?>
                                                                            <span class="label label-success"><?php echo $row->status;?></span>
                                                                            <?php elseif($row->status == "Mutated"):?>
                                                                            <span class="label"><?php echo $row->status;?></span>
                                                                            <?php else:?>
                                                                            <span class="label label-important"><?php echo $row->status;?></span>
                                                                            <?php endif;?>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo $row->nik; ?> - <?php echo $row->nama; ?></td>
                                                                    </tr>
                                                                    <?php endforeach;?>
                                                                </tbody>
                                                            </table>
                                                        </div>
							<div class="form-actions">
                                                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure to submit this form?')">Submit</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   
					</div>
				</div><!--/span-->

			</div><!--/row-->    

	</div><!--/.fluid-container-->