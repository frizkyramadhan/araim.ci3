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
            <a href="#">Edit Specification</a>
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
                        <input name="id_perbekalan" class="span6" value="<?php echo $id_perbekalan; ?>" type="hidden" />
                        <div class="control-group">
                            <label class="control-label">Component</label>
                            <div class="controls">
                                <?= form_dropdown('id_komponen', $comp_options, $select_komp, 'class="span6" data-rel="chosen"'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Specification</label>
                            <div class="controls">
                                <input type="text" class="span6" name="spesifikasi" placeholder="Specification" value="<?php echo $spesifikasi->spesifikasi; ?>" />
                                <span style="color: red"><?php echo form_error("spesifikasi"); ?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <select class="span6" data-rel="chosen" name="is_active">
                                    <option value="1" <?= $spesifikasi->is_active == '1' ? ' selected="selected"' : ''; ?>>Active</option>
                                    <option value="0" <?= $spesifikasi->is_active == '0' ? ' selected="selected"' : ''; ?>>Not Active</option>
                                </select>
                            </div>
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