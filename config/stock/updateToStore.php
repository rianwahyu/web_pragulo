<?php

include '../connection.php';

$id = $_POST['id'];
$itemID = $_POST['itemID'];
$quantity = $_POST['quantity'];
$itemType = $_POST['itemType'];
$quantityMin = $quantity * -1;

//echo $id."<br>".$itemID."<br>".$quantity."<br>".$itemType;

$query = "";
$query = $query . " UPDATE warehouse_stock SET toStore='1' WHERE id='$id' ;";
$query = $query . " INSERT INTO `warehouse_stock`(`itemID`, `quantity`, `type`, `itemType`, `remark`, `dateStock`) VALUES ('$itemID', '$quantityMin', 'out', '$itemType', 'Stock Keluat Gudang ke Toko', NOW()) ;";
$query = $query . " INSERT INTO `store_stock`(`itemID`, `quantity`, `type`, `itemType`, `remark`, `dateStock`) VALUES ('$itemID', '$quantity', 'in', '$itemType', 'Stok Masuk dari Gudang', NOW() ) ; ";

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../master_gudang?status=true'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../master_gudang?status=false'>";
}
//echo $query;