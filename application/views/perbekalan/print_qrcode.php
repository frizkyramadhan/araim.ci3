<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        @media print {

            html,
            body {
                align-content: center;
                width: 2.35cm;
                height: 1.5cm;
                margin-top: 0px;
                margin-left: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
            }
        }
    </style>
</head>

<body>
    <!-- <?php print_r($this->db->last_query()); ?>
<pre><?php echo print_r($qrcode); ?></pre> -->
    <?php foreach ($qrcode as $row) : ?>
        <table width="320" border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td width="146" rowspan="4">
                    <div align="center"><img src="<?php echo base_url(); ?>img/qrcode/<?php echo $row->qrcode ?>" width="146"></div>
                </td>
                <td width="174">
                    <div align="center"><img src="<?php echo base_url(); ?>img/logo-bw.jpg" width="100"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="center"><?php echo $row->no_inv; ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="center">
                        <?php echo $row->nama_aset;
                        echo " ";
                        echo $row->merk;
                        echo " ";
                        echo $row->model ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td height="26">
                    <div align="center">
                        <?php echo $row->nik;
                        echo " - ";
                        echo $row->nama; ?>
                    </div>
                </td>
            </tr>
        </table>
        <div style="margin-bottom: 3mm;"></div>
    <?php endforeach; ?>
</body>

</html>