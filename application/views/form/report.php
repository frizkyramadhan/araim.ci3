<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asset Allocation Form #<?php echo $no_form; ?> - Arkananta Asset Inventory Management</title>
<style type="text/css">

.kop {float:none;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
width: 1000px;
font-size: 14px;
border: 2px solid black;
}
.no {float:inherit;
margin-top:5px;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
width: 1000px;
font-size: 14px;
border: 2px solid black;
}
.emp {float:inherit;
margin-top:5px;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
width: 1000px;
font-size: 14px;
border: 2px solid black;
}
.inv {float:inherit;
margin-top:5px;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
width: 1000px;
font-size: 14px;
border: 1px solid black;
border-bottom: 2px solid black;
}
.inv th {border:solid 1px #000000;
}
.inv td {border-left:solid 1px #000000;
border-right:solid 1px #000000;}
.inv tr {border:none;}
.inv tr:last-child{border-bottom:solid 2px #000000;}

.sign {float:inherit;
margin-top:5px;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
width: 1000px;
font-size: 14px;
border: 2px solid black;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" class="kop">
  <tr>
    <td width="257"><div align="center"><img src="<?php echo base_url();?>img/logo3.png" width="225" height="55" /></div></td>
    <td width="464"><div align="center" class="style1">ASSET ALLOCATION FORM</div></td>
    <td width="269"><div align="right" class="style2">PT. Arkananta Apta Pratista</div>
      <div align="right" class="style3">Jl. MT. Haryono No 131-133<br>
      Balikpapan 76126 Indonesia<br>
      Phone : (+62-542) 7212700<br>
    Fax : (+62-542) 7212730</div></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" class="no">
  <tr>
    <td bgcolor="#CCCCCC" class="style2"><b>ASSET ALLOCATION FORM NUMBER : <?php echo $no_form;?></b></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" class="emp">
  <th colspan="10" bgcolor="#CCCCCC" style="border-bottom:solid 2px #000000;">
    <div align="left" class="style2">EMPLOYEE DETAIL    </div></th>
  <tr>
    <td width="50" class="style3">NIK</td>
    <td width="6" class="style3">:</td>
    <td width="217" class="style3"><?php echo $input_by['nik']; ?></td>
    <td width="83" class="style3">Position</td>
    <td width="7" class="style3">:</td>
    <td width="305" class="style3"><?php echo $input_by['nama_jabatan']; ?></td>
    <td width="50" class="style3">Project</td>
    <td width="10" class="style3">:</td>
    <td width="250" class="style3"><?php echo $input_by['kode_project']; ?> - <?php echo $input_by['nama_project']; ?></td>
  </tr>
  <tr>
    <td class="style3">Name</td>
    <td class="style3">:</td>
    <td class="style3"><?php echo $input_by['nama']; ?></td>
    <td class="style3">Department</td>
    <td class="style3">:</td>
    <td class="style3"><?php echo $input_by['nama_dept']; ?></td>
    <td class="style3">Date</td>
    <td class="style3">:</td>
    <td class="style3"><?php echo $input_by['date']; ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" class="inv">
  <th colspan="9" bgcolor="#CCCCCC" class="style2">
    <div align="left">ASSET ALLOCATION DETAIL  </div>
    </th>
  <tr>
    <th class="style3" style="border-bottom: solid 2px black">No.</th>
    <th class="style3" style="border-bottom: solid 2px black">Inventory No.</th>
    <th class="style3" style="border-bottom: solid 2px black">Date</th>
    <th class="style3" style="border-bottom: solid 2px black">Asset</th>
    <th class="style3" style="border-bottom: solid 2px black">S/N</th>
    <th class="style3" style="border-bottom: solid 2px black">PIC</th>
    <th class="style3" style="border-bottom: solid 2px black">Position</th>
    <th class="style3" style="border-bottom: solid 2px black">Project</th>
  </tr>
  <tr>
	<?php $i = 1 ?>
    <?php foreach ($detail as $row): ?>
    <td class="style3"><div align="center"><?php echo $i++; ?></div></td>
    <td class="style3"><?php echo $row->no_inv; ?></td>
    <td class="style3"><?php echo $row->tanggal; ?></td>
    <td class="style3"><?php echo $row->nama_aset; ?></td>
    <td class="style3"><?php echo $row->sn; ?></td>
    <td class="style3"><?php echo $row->nik; ?> - <?php echo $row->nama; ?></td>
    <td class="style3"><?php echo $row->nama_jabatan; ?></td>
    <td class="style3"><?php echo $row->kode_project; ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<table width="100%" border="0" cellspacing="0" class="sign">
  <tr>
    <td width="300" class="style3"><div align="center">
      <strong>Proposed by</strong>
        <br><br><br><br><br><br><br>
      <?php echo $input_by['nama'];?>
    </div></td>
    <td width="229" class="style3">&nbsp;</td>
    <td width="159" class="style3">&nbsp;</td>
    <td width="300" class="style3"><div align="center">
		<strong>Acknowledge by</strong>
        <br><br><br><br><br><br><br>
        RACHMAN YULIKISWANTO
    </div></td>
  </tr>
</table>


</body>
</html>
