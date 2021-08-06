<?php

$username = $_SESSION['username'];
$orderID=$_POST['orderID'];
$itemID = $_POST['itemID'];
$productionID = getIDProduction();

$note = "Barang telah di proses";

$query = "";
$query = $query. " INSERT INTO `production`(`productionID`, `orderID`, `itemID`, `dateIn`, `status`) VALUES ('$productionID', '$orderID', '$itemID', NOW(), 'Proses'); ";

$query = $query. " INSERT INTO `timeline`(`productionID`, `note`, `username`, `date`) VALUES ('$productionID', '$note', '$username', NOW()";

echo $query;
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


?>