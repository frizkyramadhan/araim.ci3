<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-file-alt"></i><a href="#">  Form Berita Acara Peminjaman Barang</a></li>
			</ul>
                        <?php
                        $nik = $this->session->userdata('nik');
                        $pengguna = $this->login_m->dataPengguna($nik);
                        ?>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-file-alt"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
                                                        <a href="<?php echo site_url('bapb/add') ?>" class="halflings-icon white plus"></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                                            <!--<pre><?php // print_r($bapb)?></pre>-->
						<table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
						  <thead>
                                                    <tr>
                                                        <th style="width: 15px">No</th>
                                                        <th style="width: 150px">Reg. No</th>
                                                        <th>Date</th>
                                                        <th>Who Receive (Yang Menerima)</th>
                                                        <th>Project</th>
														<th>Duration</th>
                                                        <th><div align="center">Action</div></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <?php $i = 1 ?>
                                                        <?php foreach ($bapb as $row): ?>
                                                        <td><?php echo $i++?></td>
                                                        <td><?php echo $row->no_reg; ?></td>
                                                        <td><?php echo $row->date_bapb; ?></td>
                                                        <td><?php echo $row->nama; ?></td>
                                                        <td><?php echo $row->kode_project; ?> - <?php echo $row->nama_project; ?></td>
                                                        <td><div align="right"><?php echo $row->duration; ?> Days</div></td>
														<td>
                                                            <div align="center">
                                                                <?php echo anchor('bapb/detail/'.$row->no_bapb, '&nbsp;Detail&nbsp;', array('class'=>'btn btn-mini btn-success'));?>
                                                                <?php echo anchor('bapb/print_bapb/'.$row->no_bapb, '&nbsp;&nbsp;Print&nbsp;&nbsp;', array('class'=>'btn btn-mini btn-primary', 'onclick'=>"return confirm('Are you sure to print this form? Press [Ctrl+P] to print the form')", 'target'=>'_blank')); ?>
                                                                <?php if ($pengguna->level == "Admin"){
                                                                    echo anchor('bapb/delete/'.$row->no_bapb, 'Delete', array('class'=>'btn btn-mini btn-danger', 'onclick'=>"return confirm('Are you sure to delete this form?')"));
                                                                }?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
	</div><!--/.fluid-container-->