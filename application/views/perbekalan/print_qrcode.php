<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title;?></title>
    <style>
		body {font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-size:11px;}
		@media print {
  html, body {
    width: 2.35cm;
    height: 1.5cm;
	margin-top::15;
  }
}
    </style>
</head>
<body>
<!-- <?php print_r($this->db->last_query());?> -->
<!--<pre><?php echo print_r($qrcode);?></pre>-->
    <?php foreach ($qrcode as $row):?>
        <table width="320" border="1" cellspacing="0" cellpadding="3">
            <tr>
                <td width="120" rowspan="4"><div align="center"><img src="<?php echo base_url();?>img/qrcode/<?php echo $row->qrcode?>" width="120"></div></td>
                <td width="182"><div align="center"><img src="<?php echo base_url();?>img/logo-bw.jpg" width="100"></div></td>
            </tr>
            <tr>
                <td><?php echo $row->no_inv;?></td>
            </tr>
            <tr>
                <td><?php echo $row->nama_aset; echo " "; echo $row->merk; echo " "; echo $row->model?></td>
            </tr>
            <tr>
                <td height="26"><?php echo $row->nik; echo " - "; echo $row->nama;?></td>
            </tr>
        </table>
        <br>       
    <?php endforeach;?>
</body>
</html>