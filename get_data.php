

<?php
//file get_data.php

//-- melakukan koneksi ke database --
$subcat=$_POST['subcat'];
$conn=mysql_connect("localhost", "root" ,""); // dbhost, dbuser, dbpsw
mysql_select_db("omega");
//--- membaca data ----
$sql="SELECT * FROM mastersubcategory where KdCategory = '$subcat' ";
$hs=mysql_query($sql);
echo '<div style=" background-color:#eeeeee;"><table width="100%" border="0" cellpadding="0">
<tr>
<td bgcolor="#0099CC">email</td>
<td bgcolor="#0099CC">name</td>
<td bgcolor="#0099CC">address</td>
<td bgcolor="#0099CC">Action</td>
</tr>';
while($rs=mysql_fetch_array($hs)){
echo'<tr>
<td bgcolor="white">'.$rs['email'].'</td>
<td bgcolor="white">'.$rs['name'].'</td>
<td bgcolor="white">'.$rs['address'].'</td>
<td bgcolor="white"><button>Edit</button></td>
</tr>';
}
echo'</table></div>';
?>
