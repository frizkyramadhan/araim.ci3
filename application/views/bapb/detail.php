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
                                        <a href="<?php echo base_url();?>bapb">Form Berita Acara Peminjaman Barang</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Detail Form Berita Acara Peminjaman Barang</a>
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
							<a href="<?php echo site_url('bapb/print_bapb/'.$no_bapb) ?>" target="_blank" onclick="return confirm('Are you sure to print this form? Press [Ctrl+P] to print the form')"><i class="halflings-icon white print"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                                            <form class="form-inline" role="form" action="" method="post">
						  <fieldset>
<!--                                                      <pre>
                                                          <?php // print_r($detail);?>
                                                          <?php // print_r($submit);?>
                                                          <?php // print_r($receive);?>
                                                      </pre>-->
                                                        
                                                      <table class="table table-condensed">
                                                            <tr>
                                                                <td width="30%"><label><b>BAPB No</b></label></td>
                                                                <td width="3%">:</td>
                                                                <td><?php echo $detail_row->no_reg;?></td>
                                                                <td><div align="right"><?php echo anchor('bapb/edit_bapb/'.$detail_row->no_bapb, '&nbsp;Edit&nbsp;', array('class'=>'btn btn-success'));?></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label><b>Date</b></label></td>
                                                                <td>:</td>
                                                                <td><?php echo $detail_row->date_bapb;?></td>
                                                            </tr>
                                                        </table>
                                                        <table class="table table-condensed">
                                                            <tr><td colspan="3"><label><b>Yang Menyerahkan</b></label></td></tr>
                                                            <tr>
                                                                <td width="30%"><label>Name</label></td>
                                                                <td width="3%">:</td>
                                                                <td><?php echo $submit->nama; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>NIK</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $submit->nik; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Position</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $submit->nama_jabatan; ?></td>
                                                            </tr>
                                                        </table>
                                                      <table class="table table-condensed">
                                                          <tr><td colspan="3"><label><b>Yang Menerima</b></label></td></tr>
                                                            <tr>
                                                                <td width="30%"><label>Name</label></td>
                                                                <td width="3%">:</td>
                                                                <td><?php echo $receive->nama; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>NIK</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $receive->nik; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Position</label></td>
                                                                <td>:</td>
                                                                <td><?php echo $receive->nama_jabatan; ?></td>
                                                            </tr>
                                                        </table>
														<table class="table table-condensed">
                                                            <tr>
                                                                <td width="30%"><label><b>Duration</b></label></td>
                                                                <td width="3%">:</td>
                                                                <td><?php echo $detail_row->duration;?> Days</td>
                                                            </tr>
                                                        </table>
                                                    <div class="control-group">
                                                    <div align="center"><label><b>Asset Detail</b></label></div>
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
                                                                <th>Remarks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php $n=1;?>
                                                                <?php foreach ($detail as $row): ?>
                                                                <td><?php echo $n++; ?></td>
                                                                <td><a href="<?php echo site_url("perbekalan/detail_aset/$row->id_perbekalan")?>"><?php echo $row->no_inv; ?></td>
                                                                <td><?php echo $row->tanggal; ?></td>
                                                                <td><?php echo $row->nama_aset; ?></td>
                                                                <td><?php echo $row->merk;?> / <?php echo $row->model;?></td>
								<td><?php echo $row->sn;?> / <?php echo $row->pn;?></td>
                                                                <td><?php echo $row->remarks; ?></td>
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