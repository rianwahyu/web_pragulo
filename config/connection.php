<?php 

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set('Asia/Jakarta');
// $dbc = mysqli_connect("localhost","root","","pragulo");
$dbc = mysqli_connect("localhost","pustakah_root","Samsung001","pustakah_pragulo");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>