<?php

include '../connection.php';

$id = $_POST['id'];
$query = "SELECT * FROM purchase WHERE id='$id' ";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
if (!empty($row)) {
    $querys = "";
    $querys = $querys . "UPDATE purchase SET status='Available' WHERE id='$id' ;";
    if ($row['type'] == "mebel") {
        $querys = $querys . "INSERT INTO `warehouse_stock`(`itemID`, `quantity`, `type`, `remark`, `dateStock`) VALUES ('" . $row['itemID'] . "', '" . $row['quantity'] . "', 'in', 'Stok dari Pembelian ID :  $id ', NOW() ) ; ";
    }else{
        $querys = $querys . "INSERT INTO `store_stock`(`itemID`, `quantity`, `type`, `remark`, `dateStock`) VALUES ('" . $row['itemID'] . "', '" . $row['quantity'] . "', 'in', 'Stok dari Pembelian Non Mebel ID :  $id ', NOW() ) ; ";
    }
    

    if (mysqli_multi_query($dbc, $querys)) {
        if ($row['type'] == "mebel") {
            header("location:../../purchase_furniture");
        } else {
            header("location:../../purchase_non_furniture");
        }
    } else {
        echo "Gagal";
    }
}
