<?php 

include '../connection.php';

$timelineID = $_POST['timelineID'];
$proses = $_POST['proses'];
// $tukang = $_POST['tukang'];
$orderID=$_POST['orderID'];
$itemID = $_POST['itemID'];
// $note = $_POST['note'];
$productionID = $_POST['productionID'];
$pageName = $_POST['pageName'];
$curentStat = $_POST['curentStat'];

$query = "";
$query = $query . " UPDATE timeline SET dateFinish=NOW(), prodStat='1' WHERE timelineID='$timelineID' ; ";

if($curentStat !="Finishing"){
    $query = $query. " INSERT INTO `timeline`(`productionID`, status) VALUES ('$productionID', '$proses'); ";
    $query = $query . " UPDATE production SET status='$proses' WHERE productionID='$productionID' ; ";
}

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../".$pageName."?status=true'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../".$pageName."?status=false'>";
}

