<?php

include '../connection.php';

$itemID = $_POST['itemID'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$itemtype = $_POST['itemtype'];
$keterangan = $_POST['keterangan'];

$query = "INSERT INTO `temp_order`(`itemID`, `quantity`, `price`, `itemtype`, `keterangan`) VALUES ('$itemID', '$quantity','$price', '$itemtype', '$keterangan')";

$result = mysqli_query($dbc, $query);
//echo $query;
if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
}