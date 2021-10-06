<?php 

include '../connection.php';

$timelineID = $_POST['timelineID'];
$pageName = $_POST['pageName'];
$note = $_POST['note'];
$tukang = $_POST['tukang'];

$query = "";
$query = $query . " UPDATE timeline SET date=NOW(), queue='1', note='$note', username='$tukang' WHERE timelineID='$timelineID' ; ";

// $query = $query. " INSERT INTO `timeline`(`productionID`, `note`, `username`, `date`, status) VALUES ('$productionID', '$note', '$tukang', NOW(), '$proses'); ";

// $query = $query . " UPDATE production SET status='$proses' WHERE productionID='$productionID' ; ";

echo $query;

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../".$pageName."?statusQueue=true'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../".$pageName."?statusQueue=false'>";
}

