<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'connection.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data admin dengan username dan password yang sesuai
$query="SELECT * FROM users WHERE username='$username' and password=MD5('$password') ";
//echo $query;
$data = mysqli_query($dbc,$query);

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$qry = mysqli_fetch_array($data);
	$_SESSION['status'] = "login";
	$_SESSION['username'] = $username;
    $_SESSION['fullname'] = $qry['fullname'];
    $_SESSION['userID'] = $qry['id'];
    $_SESSION['role'] = $qry['role'];

	header("location:../index");
		
}else{
	header("location:../auth_login?pesan=gagal");
}
?>