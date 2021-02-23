<?php
session_start();
include "koneksi.php";
    session_destroy();
    header('Location: login.php');
    exit();	
?>
