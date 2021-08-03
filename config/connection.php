<?php 

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// $dbc = mysqli_connect("localhost","root","","pragulo");
$dbc = mysqli_connect("localhost","id17063857_rian","Ri4nw@hyu1711","id17063857_pragulo");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>