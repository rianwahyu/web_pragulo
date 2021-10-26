<?php

include '../connection.php';

$id_order_item = $_POST['id_order_item'];
$itemID = $_POST['itemID'];
$quantityReal = $_POST['quantity'];
$quantity = $_POST['quantity'] * -1;
$price = $_POST['price'];
$orderID = $_POST['orderID'];
$itemType = $_POST['itemType'];

$totStock = 0;
$finalStock = 0;

$sql = "SELECT SUM(quantity) as totStock FROM store_stock WHERE itemID='$itemID' GROUP BY itemID";
$res = mysqli_query($dbc, $sql);
$row = mysqli_fetch_array($res);
if(!empty($row)){
    $totStock = $row['totStock'];    
}else{
    $totStock = 0;
}

$finalStock = $totStock + $quantity;

if($totStock >= $quantityReal){
    $query = "";
    $query = $query. " UPDATE order_item SET finish='1' WHERE id='$id_order_item' ;";
    $query = $query. " INSERT INTO `store_stock`(`itemID`, `quantity`, `type`, `itemType`, `remark`, `dateStock`) VALUES ('$itemID', '$quantity ', 'out', '$itemType', 'Item Keluar dengan Order ID : ".$orderID."', NOW() ) ;";    
    if (mysqli_multi_query($dbc, $query)) {
        echo "<meta http-equiv='refresh' content='1 url=../../order_list2'>";
    } else {
        echo "<meta http-equiv='refresh' content='1 url=../../order_list2?status=false'>";
    }
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../order_list2?status=lowerStock'>";
}

//echo $query;

