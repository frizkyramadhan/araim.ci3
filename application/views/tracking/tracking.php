<!-- start: Content -->
			<div id="content" class="span10">
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-search"></i><a href="#"> Tracking</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-search"></i><span class="break"></span><?php echo $subtitle;?></h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<div class="control-group">
								<div class="alert alert-warning">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Attention!</strong> Type the Inventory Number or Serial Number or Part Number, and then press Enter
								</div>
								<label class="control-label">Search</label>
								<div class="controls">
									<!--<input name="cari" class="span6" type="text" placeholder="No Inventory, S/N, P/N"/>-->
									<input name="cari" type="text" class="span6 typeahead" id="typeahead"  placeholder="No Inventory, S/N, P/N, PO, Ref No" data-provide="typeahead" data-items="8" 
									data-source='<?php $this->tracking_m->get();?>'>
								</div>
                            </div>
                        </form>
                        <?php 
                        $cari=isset($_GET['cari'])?($_GET['cari']):"";
                        if($cari!=''){
							$list=$this->db->query("
								SELECT * FROM perbekalan p, aset a, karyawan k, project j WHERE
                                p.id_karyawan = k.id_karyawan AND
                                p.id_aset = a.id_aset AND
                                k.id_project = j.id_project AND
                                ((p.no_inv LIKE '$cari') OR (p.sn LIKE '$cari') OR (p.pn LIKE '$cari') OR (p.po LIKE '$cari') OR (p.ref_no LIKE '$cari') OR (a.nama_aset LIKE '$cari'))
                                AND
                                ((p.no_inv LIKE '$cari') OR (p.sn LIKE '$cari') OR (p.pn LIKE '$cari') OR (p.po LIKE '$cari') OR (p.ref_no LIKE '$cari') OR (a.nama_aset LIKE '$cari'))
                                ORDER BY p.id_perbekalan DESC
                                ")->result();
                        }
                        ?>
                                            
                                        <div class="priority low"><span>Inventory List</span></div>
                                        <?php if(is_array($list)): ?>
					<?php foreach ($list as $result):?>
					<div class="task low">
						<div class="desc">
                                                    <div class="title"><?php echo $result->no_inv; echo " - "; echo $result->nama_aset?></div>
							<div><?php echo $result->nik; echo " - ";echo $result->nama; echo " | ";echo $result->kode_project; echo " - "; echo $result->nama_project; ?></div>
							<div><?php echo $result->merk; echo " - ";echo $result->model; echo " | ";echo $result->sn; echo " - "; echo $result->pn; echo " | ";echo $result->remarks ?></div>
						</div>
						<div class="time">
							<div class="date"><?php echo $result->tanggal?></div>
							<div> 
                                                            <?php if ($result->status == 'Available'):?>
                                                            <span class="label label-success"><?php echo $result->status; ?></span>
                                                            <?php elseif ($result->status == 'Mutated'):?>
                                                            <span class="label label-default"><?php echo $result->status; ?></span>
															<?php elseif ($result->status == 'Broken'):?>
															<span class="label label-important"><?php echo $result->status; ?></span>
															<?php elseif ($result->status == 'Discarded'):?>
															<span class="label label-inverse"><?php echo $result->status; ?></span>
                                                            <?php endif;?>
                                                        </div>
                                                        <div> <a href="<?php echo site_url("perbekalan/detail_aset/".$result->id_perbekalan)?>" class="btn btn-mini btn-primary" target="blank">Detail</a></div>
						</div>
					</div>
                                        <?php endforeach;?>
                                        <?php endif; ?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
	</div><!--/.fluid-container-->