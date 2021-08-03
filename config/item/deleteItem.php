<?php

include '../connection.php';

$itemID = $_POST['itemID'];

$query = "DELETE FROM `item` WHERE `itemID`='$itemID'";

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../master_item");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../master_item'>";
}

mysqli_close($dbc);