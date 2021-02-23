<?php
include("connect.php");
$sql = mysql_query("SELECT * FROM pos_itemtemp");
$result = array();

while($row = mysql_fetch_array($sql))
{
	array_push($result, array('kditem' => $row[0], 'qty' => $row[1], 'grandprice' => $row[2]));
}
echo json_encode(array("result" => $result));
?>