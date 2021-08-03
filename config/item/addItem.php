<?php

include '../connection.php';

$itemName = $_POST['itemName'];
$itemDescription = $_POST['itemDescription'];
$price = $_POST['price'];
$categoryID = $_POST['categoryID'];

$query = "INSERT INTO `item`(`itemName`, `itemDescription`, `price`, `categoryID`) VALUES ('$itemName', '$itemDescription', '$price', '$categoryID')";

$result = mysqli_query($dbc, $query);

if ($result === TRUE){
    header("location:../../master_item");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../master_item'>";
}

mysqli_close($dbc);