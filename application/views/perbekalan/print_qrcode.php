<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title;?></title>
</head>
<body>
    <?php foreach ($qrcode as $row):?>
        <!-- <img src="img/qrcode/<?php echo $row->qrcode?>" style="width:120px"> -->
        
        <img src="<?php echo base_url();?>img/qrcode/<?php echo $row->qrcode?>" width="100">
    <?php endforeach;?>
</body>
</html>