<?php

//include '../../include/head.php';
include '../connection.php';


$orderItemID = $_POST['orderItemID'];
$username = $_POST['username'];
$orderID=$_POST['orderID'];
$itemID = $_POST['itemID'];
$type = $_POST['type'];
$productionID = getIDProduction();

$note = "Barang telah di konfirmasi";
$curDate = date('Y-m-d H:i:s');

$query = "";
$query = $query. " INSERT INTO `production`(`productionID`, `orderID`, `itemID`, `dateIn`, `status`, `type`) VALUES ('$productionID', '$orderID', '$itemID', '$curDate', 'Dikonfirmasi', '$type'); ";

$query = $query. " INSERT INTO `timeline`(`productionID`, `note`, `username`, `date`) VALUES ('$productionID', '$note', '$username', '$curDate'); ";

$query = $query. " UPDATE order_item SET prod='1' WHERE id='$orderItemID' ;";
echo $query;
if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../production_add?key=".$orderID."&status=true'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../production_add?key=".$orderID."&status=false'>";
}

function getIDProduction()
{
    include '../connection.php';
    $kode = date('ym');
    $productionID = "";
    $sql = "SELECT productionID	FROM production ORDER BY productionID DESC LIMIT 1 ";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        // $productionID = $kode . "0000001";
        $productionID = $kode . "001";
    } else {
        $id = $data["productionID"];
        $id = substr($id, 4);

        $productionID = $kode . str_pad($id + 1, 3, 0, STR_PAD_LEFT);
    }

    return $productionID;
}