<?php

include '../connection.php';

$itemID = $_POST['itemID'];
$quantity = $_POST['quantity'];
$keterangan = $_POST['keterangan'];
$user = $_POST['username'];

$query = "INSERT INTO `temp_receive`( `itemID`, `quantity`, `keterangan`, `user`) VALUES ('$itemID', '$quantity', '$keterangan', '$user')";

$result = mysqli_query($dbc, $query);
//echo $query;
if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../receive_add'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../receive_add'>";
}