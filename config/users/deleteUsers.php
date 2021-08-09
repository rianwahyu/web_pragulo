<?php

include '../connection.php';

$userID = $_POST['userID'];

$query = "DELETE FROM `users` WHERE `userID`='$userID'";

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../user_list");
}else{
    echo "<script>alert('Hapus Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../user_list'>";
}

mysqli_close($dbc);