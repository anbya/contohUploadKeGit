<?php
      //  Mengakses database
      $konek = new mysqli("localhost", "root", "", "nahm");
      if (!$konek){
      echo "Tidak dapat terhubung dengan database";
      exit();
      }
?>