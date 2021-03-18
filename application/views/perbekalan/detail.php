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
            <i class="icon-list-alt"></i>
            <a href="#">Inventories Detail</a>
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

                        $nik = $this->session->userdata('nik');
                        $pengguna = $this->login_m->dataPengguna($nik);

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
                                <td><?php echo $departemen->nama_dept; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>

                        <div class="control-group">
                            <div align="center"><label><b>Existing Assets</b></label></div>
                            <?php if ($pengguna->level != "Read Only") : ?>
                                <div align="right">
                                    <?php echo anchor('perbekalan/print_qrcode/' . $data_pengguna->nik, '<i class="halflings-icon white qrcode"></i> Print', array('class' => 'btn btn-success', 'target' => 'blank')); ?>
                                    <?php echo anchor('perbekalan/add/' . $data_pengguna->nik, '&nbsp Add &nbsp', array('class' => 'btn btn-primary')); ?>
                                </div>
                            <?php endif; ?>
                            <br>
                            <?php // echo form_open('perbekalan');
                            ?>
                            <table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
                                <thead>
                                    <tr>
                                        <!--<th style="width: 20px"></th>-->
                                        <th>No.</th>
                                        <th>Inventory No.</th>
                                        <th>Date</th>
                                        <th>Asset</th>
                                        <th>Merk / Model</th>
                                        <th>S/N / P/N</th>
                                        <th>PO No.</th>
                                        <th>
                                            <div align="center">QR Code</div>
                                        </th>
                                        <th>
                                            <div align="center">Status</div>
                                        </th>
                                        <th>
                                            <div align="center">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php $n = 1; ?>
                                        <?php foreach ($detail as $row) : ?>
                                            <!--<td><?php // echo form_checkbox('check[]',$row->id_perbekalan);
                                                        ?></td>-->
                                            <td><?php echo $n++; ?></td>
                                            <td>
                                                <div align="center">
                                                    <?php echo $row->no_inv; ?><br>
                                                    <?php echo anchor('perbekalan/qrcode/' . $data_pengguna->nik . '/' . $row->id_perbekalan, 'Generate QRCode', array('class' => 'btn btn-mini btn-primary')) ?>
                                                </div>
                                            </td>
                                            <td><?php echo $row->tanggal; ?></td>
                                            <td><?php echo $row->nama_aset; ?></td>
                                            <td><?php echo $row->merk; ?> / <?php echo $row->model; ?></td>
                                            <td><?php echo $row->sn; ?> / <?php echo $row->pn; ?></td>
                                            <td><?php echo $row->po; ?></td>
                                            <td>
                                                <div align="center">
                                                    <?php if (empty($row->qrcode)) : ?>
                                                    <?php else : ?>
                                                        <img src="<?php echo base_url(); ?>img/qrcode/<?php echo $row->qrcode ?>" width="100"><br>
                                                        <?php echo anchor('perbekalan/delete_qrcode/' . $data_pengguna->nik . '/' . $row->id_perbekalan, 'X', array('onclick' => "return confirm('Are you want to delete this qrcode?')")) ?>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="center">
                                                    <?php if ($row->status == "Available") : ?>
                                                        <span class="label label-success"><?php echo $row->status; ?></span>
                                                    <?php elseif ($row->status == "Mutated") : ?>
                                                        <span class="label"><?php echo $row->status; ?></span>
                                                    <?php elseif ($row->status == "Broken") : ?>
                                                        <span class="label label-important"><?php echo $row->status; ?></span>
                                                    <?php elseif ($row->status == "Discarded") : ?>
                                                        <span class="label label-inverse"><?php echo $row->status; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="center">
                                                    <?php echo anchor('perbekalan/detail_aset/' . $row->id_perbekalan, 'Detail', array('class' => 'btn btn-mini btn-primary')) ?>
                                                    <?php if ($pengguna->level != "Read Only") : ?>
                                                        <?php echo anchor('perbekalan/edit/' . $row->nik . '/' . $row->id_perbekalan, '&nbspEdit&nbsp', array('class' => 'btn btn-mini btn-success')); ?>
                                                    <?php endif; ?>
                                                    <?php if ($pengguna->level == "Admin") : ?>
                                                        <?php echo anchor('perbekalan/delete_perbekalan/' . $row->nik . '/' . $row->id_perbekalan, 'Delete', array('class' => 'btn btn-mini btn-danger')); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>

                            <?php // echo form_submit('submit','Submit');
                            ?>
                            <?php // echo form_close();
                            ?>
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