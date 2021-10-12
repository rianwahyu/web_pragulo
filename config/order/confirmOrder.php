<?php

include '../connection.php';

$id_order_item = $_POST['id_order_item'];
$itemID = $_POST['itemID'];
$quantity = $_POST['quantity'] * -1;
$price = $_POST['price'];
$orderID = $_POST['orderID'];
$itemType = $_POST['itemType'];

$query = "";

$query = $query. " UPDATE order_item SET finish='1' WHERE id='$id_order_item' ;";
$query = $query. " INSERT INTO `store_stock`(`itemID`, `quantity`, `type`, `itemType`, `remark`, `dateStock`) VALUES ('$itemID', '$quantity ', 'out', '$itemType', 'Item Keluar dengan Order ID : ".$orderID."', NOW() ) ;";

//echo $query;

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../order_list2'>";
} else {
    echo "Gagal";
}