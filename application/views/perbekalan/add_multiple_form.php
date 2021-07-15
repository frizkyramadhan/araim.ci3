<!--<script src="<?php echo base_url(); ?>datepicker/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>datepicker/js/jquery-ui-1.10.4.custom.js"></script>-->
<?php // for($i=1;$i<=$banyak_data;$i++): 
?>
<!--<script>
$(document).ready(function(){
$('#tanggal<?php echo $i ?>').datepicker({
	dateFormat  : "yy-mm-dd",
});
});
</script>-->
<?php // endfor;
?>

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
            <a href="#">Add Inventory Data</a>
        </li>
    </ul>

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
                <form class="form-horizontal" role="form" action="" method="post">
                    <fieldset>
                        <?php
                        $data_pengguna = $this->karyawan_m->select_by_nik($nik);
                        $id_karyawan = $data_pengguna->id_karyawan;
                        $departemen = $this->karyawan_m->select_dept($id_karyawan);

                        ?>

                        <table class="table table-condensed">
                            <tr>
                                <td><label>NIK</label></td>
                                <td>:</td>
                                <td><?php echo $data_pengguna->nik; ?></td>
                            </tr>
                            <tr>
                                <td><label>Name</label></td>
                                <td>:</td>
                                <td><?php echo $data_pengguna->nama; ?></td>
                            </tr>
                            <tr>
                                <td><label>Project</label></td>
                                <td>:</td>
                                <td><?php echo $data_pengguna->kode_project; ?></td>
                            </tr>
                            <tr>
                                <td><label>Position</label></td>
                                <td>:</td>
                                <td><?php echo $data_pengguna->nama_jabatan; ?></td>
                            </tr>
                            <tr>
                                <td><label>Department</label></td>
                                <td>:</td>
                                <td><?php echo $data_pengguna->nama_dept; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <div class="control-group">
                            <div align="center"><label><b>Existing Assets</b></label></div>
                            <br>
                            <table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Inventory No.</th>
                                        <th>Date</th>
                                        <th>Asset</th>
                                        <th>Merk / Model</th>
                                        <th>S/N / P/N</th>
                                        <th>PO No.</th>
                                        <th>Ref No.</th>
                                        <th>Ref Date</th>
                                        <th>Remarks</th>
                                        <th>
                                            <div align="center">Status</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr> <?php $i = 1; ?>
                                        <?php foreach ($detail as $row) : ?> <td><?php echo $i++; ?></td>
                                            <td><?php echo $row->no_inv; ?></td>
                                            <td><?php echo $row->tanggal; ?></td>
                                            <td><?php echo $row->nama_aset; ?></td>
                                            <td><?php echo $row->merk;
                                                echo " / ";
                                                echo $row->model; ?></td>
                                            <td><?php echo $row->sn;
                                                echo " / ";
                                                echo $row->pn; ?></td>
                                            <td><?php echo $row->po; ?></td>
                                            <td><?php echo $row->ref_no; ?></td>
                                            <td><?php echo $row->ref_date; ?></td>
                                            <td><?php echo $row->remarks; ?></td>
                                            <td>
                                                <div align="center">
                                                    <?php if ($row->status == "Available") : ?>
                                                        <span class="label label-success"><?php echo $row->status; ?></span>
                                                    <?php elseif ($row->status == "Mutated") : ?>
                                                        <span class="label"><?php echo $row->status; ?></span>
                                                    <?php else : ?>
                                                        <span class="label label-important"><?php echo $row->status; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        $y = date('y');
                        $m = date('m');
                        $nik = $this->session->userdata('nik');
                        $pengguna = $this->login_m->dataPengguna($nik);
                        ?>
                        <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning!</strong> If your asset doesn't exist, please contact IT Officer HO Balikpapan!
                        </div>
                        <!--<div class="row-fluid">-->
                        <?php $n = 1; ?>
                        <?php for ($i = 1; $i <= $banyak_data; $i++) : ?>
                            <div class="row-fluid">
                                <div class="box span4" onTablet="span6" onDesktop="span4">
                                    <div class="box-header">
                                        <h2><i class="halflings-icon barcode white"></i><span class="break"></span>Asset Detail (<?php echo $n++; ?>)</h2>
                                        <div class="box-icon">
                                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>

                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <input name="data[<?php echo $i ?>][id_karyawan]" value="<?php echo $id_karyawan ?>" type="hidden" />

                                        <input name="data[<?php echo $i ?>][no_inv]" value="<?php echo $y;
                                                                                            echo $m; ?><?php echo str_pad($no_inv++, 6, "0", STR_PAD_LEFT) ?>" type="hidden" />

                                        <div class="control-group">
                                            <label class="control-label-widget">Date</label>
                                            <div class="controls-widget">
                                                <input type="text" name="data[<?php echo $i ?>][tanggal]" class="span12 datepicker" placeholder="Date" value="<?php echo set_value("data[$i][tanggal]") ?>" />
                                                <span style="color: red"><?php echo form_error("data[$i][tanggal]"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">Asset</label>
                                            <div class="controls-widget">
                                                <?= form_dropdown("data[$i][id_aset]", $aset_options, '', 'class="span12" data-rel="chosen"'); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">Merk</label>
                                            <div class="controls-widget">
                                                <input type="text" class="span12" name="data[<?php echo $i ?>][merk]" placeholder="Merk" value="<?php echo set_value("data[$i][merk]"); ?>" />
                                                <span style="color: red"><?php echo form_error("data[$i][merk]"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">Model</label>
                                            <div class="controls-widget">
                                                <input type="text" class="span12" name="data[<?php echo $i ?>][model]" placeholder="Model" value="<?php echo set_value("data[$i][model]"); ?>" />
                                                <span style="color: red"><?php echo form_error("data[$i][model]"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">S/N</label>
                                            <div class="controls-widget">
                                                <input type="text" class="span12" name="data[<?php echo $i ?>][sn]" placeholder="Serial Number" value="<?php echo set_value("data[$i][sn]"); ?>" />
                                                <span style="color: red"><?php echo form_error("data[$i][sn]"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">P/N</label>
                                            <div class="controls-widget">
                                                <input type="text" class="span12" name="data[<?php echo $i ?>][pn]" placeholder="Part Number" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">PO No.</label>
                                            <div class="controls-widget">
                                                <input type="text" class="span12" name="data[<?php echo $i ?>][po]" placeholder="PO Number" value="<?php echo set_value("data[$i][po]"); ?>" />
                                                <span style="color: red"><?php echo form_error("data[$i][po]"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">Ref No.</label>
                                            <div class="controls-widget">
                                                <input type="text" class="span12" name="data[<?php echo $i ?>][ref_no]" placeholder="Ref Number (TA / BA)" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">Ref Date</label>
                                            <div class="controls-widget">
                                                <input type="text" name="data[<?php echo $i ?>][ref_date]" class="span12 datepicker" placeholder="Ref Date" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">Qty</label>
                                            <div class="controls-widget">
                                                <input type="text" name="data[<?php echo $i ?>][jumlah]" class="span12" value="<?php echo set_value("data[$i][jumlah]"); ?>" />
                                                <span style="color: red"><?php echo form_error("data[$i][jumlah]"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label-widget">Location</label>
                                            <div class="controls-widget">
                                                <input type="text" name="data[<?php echo $i ?>][lokasi]" class="span12" placeholder="000H Acc Room" value="<?php echo set_value("data[$i][lokasi]"); ?>" />
                                                <span style="color: red"><?php echo form_error("data[$i][lokasi]"); ?></span>
                                            </div>
                                        </div>
                                        <!-- <div class="control-group">
                                                                                <label class="control-label-widget">Spec</label>
                                                                                <div class="controls-widget">
                                                                                    <textarea class="span12" rows="3" name="data[<?php echo $i ?>][spesifikasi]" placeholder="Specification"><?php echo set_value("data[$i][spesifikasi]"); ?></textarea>
                                                                                    <span style="color: red"><?php echo form_error("data[$i][spesifikasi]"); ?></span>
                                                                                </div>
                                                                              </div> -->
                                        <div class="control-group">
                                            <label class="control-label-widget">Remarks</label>
                                            <div class="controls-widget">
                                                <textarea class="span12" rows="3" name="data[<?php echo $i ?>][remarks]" placeholder="Condition, etc..."><?php echo set_value("data[$i][remarks]"); ?></textarea>
                                                <span style="color: red"><?php echo form_error("data[$i][remarks]"); ?></span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="data[<?php echo $i ?>][input_by]" class="span12" value="<?php echo $pengguna->id_karyawan; ?>" />
                                        <input type="hidden" name="data[<?php echo $i ?>][status]" class="span12" value="Available" />
                                    </div>
                                </div>
                                <!--/span-->
                            <?php endfor; ?>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn">Cancel</button>
                            </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

</div>
<!--/.fluid-container-->