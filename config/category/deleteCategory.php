<?php

include '../connection.php';

$categoryID = $_POST['categoryID'];

$query = "DELETE FROM `category` WHERE `categoryID`='$categoryID'";

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../category");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../category'>";
}

mysqli_close($dbc);