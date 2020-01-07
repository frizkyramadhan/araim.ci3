<!-- start: Content -->
			<div id="content" class="span10">
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
                                        <a href="<?php echo base_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><i class="icon-dashboard"></i><a href="#">Dashboard</a></li>
			</ul>
                            <?php
                            $nik = $this->session->userdata('nik');
                            $pengguna = $this->login_m->dataPengguna($nik);
                            ?>
                            <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header">
						<h2><i class="icon-dashboard"></i><span class="break"></span><?php echo $subtitle;?></h2>
					</div>
					<div class="box-content">
						  <div class="page-header">
                                                      <div align="center"><h1>Welcome to Arkananta Asset Inventory Management</h1></div>
						  </div>     
						  <div class="row-fluid">            
							  <div class="span12">
                                                              <p>Welcome <b><?php echo $pengguna->nama;?></b>, you're logged in as <b><?php echo $pengguna->level;?></b> on site <b><?php echo $pengguna->kode_project;?></b></p>
                                                              
								<div class="tooltip-demo well">
								  <p style="margin-bottom: 0;">
                                                                      <b>Legend:</b>
                                                                  <table>
                                                                      <tr>
                                                                          <td><i class="icon-barcode"></i></td>
                                                                          <td>Inventories</td>
                                                                          <td>: Menu Inventories digunakan untuk melakukan input data inventori.</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td><i class="icon-file-alt"></i></td>
                                                                          <td>Form</td>
                                                                          <td>: Menu Form digunakan untuk mencetak Asset Allocation Form.</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td><i class="icon-search"></i></td>
                                                                          <td>Tracking</td>
                                                                          <td>: Menu Tracking digunakan untuk mencari histori inventori berdasarkan Inventory Number, Serial Number, atau Part Number.</td>
                                                                      </tr>
                                                                  </table>
                                                                </p>
								</div>
                                                              <div align='right'><p class="footer"><h6>Page rendered in <strong>{elapsed_time}</strong> seconds</p></h6></div>
							  </div>
						  </div>	 
					  </div>
				</div><!--/span-->			
			</div><!--/row-->
<!--			<div class="row-fluid">	

				<a class="quick-button metro yellow span2">
					<i class="icon-group"></i>
					<p>Users</p>
					<span class="badge">
                                            <?php
//                                            $count = $this->db->query("select * from karyawan")->num_rows();
//                                            echo $count;
                                            ?>
                                        </span>
				</a>
                                <a class="quick-button metro pink span2">
					<i class="icon-briefcase"></i>
					<p>Positions</p>
					<span class="badge">
                                            <?php
//                                            $count = $this->db->query("select * from jabatan")->num_rows();
//                                            echo $count;
                                            ?>
                                        </span>
				</a>
				<a class="quick-button metro red span2">
					<i class="icon-gift"></i>
					<p>Assets</p>
					<span class="badge">
                                            <?php
//                                            $count = $this->db->query("select * from aset")->num_rows();
//                                            echo $count;
                                            ?>
                                        </span>
				</a>
				<a class="quick-button metro blue span2">
					<i class="icon-reorder"></i>
					<p>Categories</p>
					<span class="badge">
                                            <?php
//                                            $count = $this->db->query("select * from kategori")->num_rows();
//                                            echo $count;
                                            ?>
                                        </span>
				</a>
				<a class="quick-button metro green span2">
					<i class="icon-barcode">
                                            <span class="badge">
                                            <?php
//                                            $count = $this->db->query("select * from perbekalan where status = 'Available'")->num_rows();
//                                            echo $count;
                                            ?>
                                            </span>
                                        </i>
					<p>Inventories</p>
				</a>
				<a class="quick-button metro black span2">
					<i class="icon-globe"></i>
					<p>Projects</p>
                                        <span class="badge">
                                            <?php
//                                            $count = $this->db->query("select * from project")->num_rows();
//                                            echo $count;
                                            ?>
                                            </span>
				</a>
				
				<div class="clearfix"></div>
								
			</div>/row-->
			<?php
//                        $nik = $this->session->userdata('nik');
//                        $pengguna = $this->login_m->dataPengguna($nik);
//                        echo $pengguna->nama;
//                        echo "<br>";
//                        echo $pengguna->nama_dept;
//                        ?>
       

	</div><!--/.fluid-container-->