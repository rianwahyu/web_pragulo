<?php


include '../connection.php';

$productionID = $_POST['productionID'];
$orderID = $_POST['orderID'];
$itemID = $_POST['itemID'];
$source = $_POST['source'];

$querys = "SELECT quantity FROM `order_item` WHERE orderID='$orderID' AND itemID='$itemID'";
$results = mysqli_query($dbc, $querys);
$datas = mysqli_fetch_assoc($results);


$query = $query . " UPDATE production SET dateFinish=NOW(), status='Selesai' WHERE productionID='$productionID' ; ";
$query = $query . " INSERT INTO `warehouse_stock`(`itemID`, `quantity`, `type`, `itemType`, `remark`, `dateStock`) VALUES ('$itemID', '$datas[quantity]', 'in', 'mebel', 'Stok masuk dari Produksi ID : $productionID', NOW() ); ";

//echo $query;

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../production_list_detail?productionID=".$productionID."&source=".$source."'>";
} else {
    echo "Gagal";
}
