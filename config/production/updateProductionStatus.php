<?php


include '../connection.php';

$productionID = $_POST['productionID'];
$note = $_POST['note'];
$prosesBy = $_POST['prosesBy'];
$status = $_POST['status'];

$dateFinish = "";
if($status == "finishing"){
    $dateFinish = date('Y-m-d');
}

$curDate = date('Y-m-d H:i:s');

$query = "";
$query = $query. " INSERT INTO `timeline`(`productionID`, `note`, `username`, `date`) VALUES ('$productionID', '$note', '$prosesBy', '$curDate') ; " ;
if($status == "finishing"){
    $query = $query. " UPDATE production SET status='$status', dateFinish='$dateFinish' WHERE productionID='$productionID' ;";
}else{
    $query = $query. " UPDATE production SET status='$status' WHERE productionID='$productionID' ;";
}

 

//echo $query;

if (mysqli_multi_query($dbc, $query)) {
    //echo "Sukses";
    echo "<meta http-equiv='refresh' content='1 url=../../production_list_detail?productionID=".$productionID."&status=true'>";
}else{
    //echo "Gagal";
    echo "<meta http-equiv='refresh' content='1 url=../../production_list_detail?productionID=".$productionID."&status=false'>";
}

//mysqli_close($dbc);

?>