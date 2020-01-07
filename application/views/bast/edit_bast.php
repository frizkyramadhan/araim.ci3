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
                                        <a href="<?php echo base_url();?>bast">Form Berita Acara Serah Terima</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Form Berita Acara Serah Terima</a>
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
                                            <form class="form-inline" role="form" action="" method="post">
						  <fieldset>
                                                      <input type="hidden" class="span6" name="no_bast" value="<?php echo $no_bast; ?>"/>
                                                      <input type="hidden" class="span6" name="no_reg" value="<?php echo $no_bast;?>/BAST/ITY/<?php echo date('m')?>/<?php echo date('Y')?>"/>
                                                      <input type="hidden" class="span6" name="who_receive" value="<?php echo $receive->id_karyawan;?>"/>
                                                        <div class="control-group">
                                                            <label class="control-label"><b>Date</b></label>
							  <div class="controls">
                                                              <input name="date_bast" class="span6 input-xlarge datepicker" placeholder="" value="<?php echo $detail_row->date_bast; ?>"/>
							  </div>
							</div>
                                                        <table class="table table-condensed">
                                                            <tr><td colspan="3"><label><b>Yang Menyerahkan</b></label></td></tr>
                                                            <tr>
                                                                <td width="30%"><label>Name</label></td>
                                                                <td width="3%">:</td>
                                                                <td><?=form_dropdown('who_submit', $select_submit, $option_submit,'class="span7" id="selectError" data-rel="chosen"');?></td>
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
							<div class="control-group">
                                                            <div class="alert alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                                    <i class="halflings-icon arrow-down"></i> Your inventories must be in one page, please select the appropriate numbers (10, 25, 50, 100) below to make your inventories in one page.
                                                            </div>
                                                            <table class="table table-striped table-bordered table-condensed" style="font-size: 10pt">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 20px">No</th>
                                                                        <th>Inventory No.</th>
                                                                        <th>Asset</th>
                                                                        <th>Merk / Model</th>
                                                                        <th>S/N / P/N</th>
                                                                        <th>Date</th>
                                                                        <th><div align="center">Status</div></th>
                                                                        <th><div align="center">Action</div></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php $n=1;?>
                                                                        <?php foreach ($perbekalan as $row): ?>
                                                                        <td><?php echo $n++;?></td>
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
                                                                        <td><div align="center"><?php echo anchor('bast/delete_row/'.$row->no_bast.'/'.$row->id_bast, 'Delete', array('class'=>'btn btn-mini btn-danger', 'onclick'=>"return confirm('Are you sure to delete this row?')"));?></div></td>
                                                                    </tr>
                                                                    <?php endforeach;?>
                                                                    <tr id="last">
                                                                        <td colspan="7"></td>
                                                                        <td><div align='center'><button type="button" id="addRow" class='btn btn-small btn-success'>Add</button></div></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
<!--                                                      <pre><?php // print_r($list);?></pre>
                                                      <pre><?php // print_r($select_list);?></pre>
                                                      -->
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
        
<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>        
<script type="text/javascript">
var i = 1;
$(function(){
	$("#addRow").click(function(){
		row = 
                    '<tr>'+
                        '<td></td>'+
                        '<td><?php
                              $sql=mysql_query('select * from karyawan k, perbekalan p, aset a where k.id_karyawan = p.id_karyawan and p.id_aset = a.id_aset and k.nik = "'. $receive->nik.'" order by p.tanggal desc');
                                if(mysql_num_rows($sql)){
                                $select= '<select name="id_perbekalan[]" class="span12">';
                                while($rs=mysql_fetch_array($sql)){
                                      $select.='<option value='.$rs['id_perbekalan'].'>'.$rs['no_inv'].' - '.$rs['nama_aset'].' - '.$rs['merk'].' - '.$rs['sn'].' - '.$rs['nama'].'</option>';
                                  }
                                }
                                $select.='</select>';
                                echo $select;
                              ?></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td style="text-align:center"><button type="button" id="del" class="btn btn-mini btn-danger">Delete</button></td>'+
                    '</tr>';
		$(row).insertBefore("#last");
		i++;
		});
	});
	$("#del").live('click', function(){
		$(this).parent().parent().remove();
	});
</script>