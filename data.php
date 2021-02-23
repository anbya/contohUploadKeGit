<?php
include "koneksi.php";
$itemtemp=mysql_query("SELECT * FROM pos_itemtemp");
while($hitemtemp = mysql_fetch_array($itemtemp)) 
{
?>
<?php
$kditem=$hitemtemp['kditem'];
$itemdet=mysql_query("SELECT * FROM pos_item where kditem = $kditem");
$hitemdet = mysql_fetch_array($itemdet);
$price=$hitemtemp['grandprice'];
?>
<tr>
    <td width="40%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;"><?php echo $hitemdet['nmitem'];?></td>
    <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;"><?php echo $hitemtemp['qty'];?></td>
    <td width="30%" style="border-width: 1px; border-style: solid;border-color: #000000; padding-left: 10px; font-weight: bold;"><?php echo number_format("$price");?></td>
</tr>
<?php
}
?>