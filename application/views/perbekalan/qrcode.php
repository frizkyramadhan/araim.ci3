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
					<a href="#">Asset Detail</a>
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
                    <?php
                    $qrCode = new Endroid\QrCode\QrCode('No. Inventori = '.$qrcode->no_inv.'');
                    $qrCode->writeFile('img/qrcode/qr-'.$qrcode->id_perbekalan.'.png');
                    ?>
					</div>
				</div><!--/span-->

			</div><!--/row-->    

	</div><!--/.fluid-container-->
