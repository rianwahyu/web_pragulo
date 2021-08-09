<?php

include '../connection.php';

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$role = $_POST['role'];
$password = MD5($username);
//$username = $_POST['username'];
// echo $username;
// echo getUsername($username);


if ($username == getUsername($username)) {
    //echo "mbuh1";
    echo "<meta http-equiv='refresh' content='1 url=../../user_list?username=used'>";
}else{
    //echo "mbuh";
    $querys = "INSERT INTO `users`(`fullname`, `username`, `password`, `role`) VALUES ('$fullname', '$username', '$password', '$role')";
    //echo $querys;
    $results = mysqli_query($dbc, $querys);
    if ($results === TRUE){
        header("location:../../user_list");
    }else{
        echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
        echo "<meta http-equiv='refresh' content='2 url=../../master_item'>";
    }
}

function getUsername($username)
{
    include '../connection.php';

	$sql = "SELECT username FROM users WHERE username='$username' ";
    //return $sql;
	$res  = mysqli_query($dbc, $sql);
	$data = mysqli_fetch_assoc($res);
	if (mysqli_num_rows($res) < 1) {
		return "not found";
	} else {
		return $data['username'];
	}
	mysqli_close($dbc);
}