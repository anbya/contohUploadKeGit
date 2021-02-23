<?php
        // Memanggil koneksi database
	include 'connect_db.php';
	
        //Menampilkan isi tabel identitas dalam database php_phplearn_db
	$queryResult = $konek->query("select * from pos_itemtemp");
	$result	 = array();
	while($fethData = $queryResult->fetch_assoc()){
		$result[] = $fethData;
	}
	echo json_encode($result);
?>