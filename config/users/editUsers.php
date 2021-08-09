<?php

include '../connection.php';

$userID = $_POST['userID'];
$fullname = $_POST['fullname'];


$query = "UPDATE `users` SET `fullname`='$fullname' WHERE userID='$userID' ";

$result = mysqli_query($dbc, $query);

if ($result === TRUE){
    header("location:../../user_list");
}else{
    echo "<script>alert('Edit Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../user_list'>";
}

mysqli_close($dbc);