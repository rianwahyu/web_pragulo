<?php 

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set('Asia/Jakarta');
$dbc = mysqli_connect("localhost","rige4492_root","8umx9E5#RyNepdda","rige4492_pragulo");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error($dbc);
}

?>