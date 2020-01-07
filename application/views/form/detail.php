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
					<i class="icon-list-alt"></i>
					<a href="#">Detail Asset Allocation Form</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
							
                                                    <a href="<?php echo site_url('form/print_form/'.$no_form) ?>" target="_blank" onclick="return confirm('Are you sure to print this form? Press [Ctrl+P] to print the form')"><i class="halflings-icon white print"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                                            <form class="form-horizontal" role="form" action="" method="post">
						  <fieldset>
							
                                                        <table class="table table-condensed table-striped">
                                                            <tr>
                                                                <td><label>NIK</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $input_by['nik']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Name</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $input_by['nama']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Project</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $input_by['nama_project']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Position</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $input_by['nama_jabatan']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Department</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $input_by['nama_dept']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </table>
                                                    
                                                    <div class="control-group">
                                                    <div align="center"><label><b>Asset Allocation Detail</b></label></div>
                                                    <br>
                                                    <table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:10px">No.</th>
                                                                <th>No. Inventory</th>
                                                                <th>Date</th>
                                                                <th>Asset</th>
                                                                <th>Merk / Model</th>
                                                                <th>S/N / P/N</th>
                                                                <th><div align="center">PIC</div></th>
                                                                <th>Position</th>
                                                                <th>Project</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php $n=1;?>
                                                                <?php foreach ($detail as $row): ?>
                                                                <td><?php echo $n++; ?></td>
                                                                <td><?php echo $row->no_inv; ?></td>
                                                                <td><?php echo $row->tanggal; ?></td>
                                                                <td><?php echo $row->nama_aset; ?></td>
                                                                <td><?php echo $row->merk;?> / <?php echo $row->model;?></td>
								<td><?php echo $row->sn;?> / <?php echo $row->pn;?></td>
								<td><?php echo $row->nik;?> - <?php echo $row->nama;?></td>
                                                                <td><?php echo $row->nama_jabatan; ?></td>
                                                                <td><?php echo $row->kode_project; ?></td>
                                                            </tr>
                                                            <?php endforeach?>
                                                        </tbody>
                                                    </table>
                                                    </div>
						  </fieldset>
						</form>   
					</div>
				</div><!--/span-->

			</div><!--/row-->    

	</div><!--/.fluid-container-->
       