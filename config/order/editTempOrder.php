<?php

include '../connection.php';

$id = $_POST['id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$itemtype = $_POST['itemtype'];
$keterangan = $_POST['keterangan'];
$username = $_POST['username'];


$query ="UPDATE `temp_order` SET `quantity`='$quantity',`price`='$price',`itemtype`='$itemtype',`keterangan`='$keterangan' WHERE id='$id' AND user='$username' ";
$result = mysqli_query($dbc, $query);
if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";

}