<?php

include '../connection.php';

$username = $_POST['username'];
$installment = $_POST['installment'];
$customerName = $_POST['customerName'];
$customerAddress = $_POST['customerAddress'];
$customerPhone = $_POST['customerPhone'];
$dateOrder = $_POST['dateOrder'];
$dateFinish = $_POST['dateFinish'];
$payType = $_POST['payType'];
$DP = $_POST['DP'];

$myArray = array();


$orderID = getIDOrder();
$type = "";
$statusPembayaran = "";

if ($payType == "Cicilan") {    
    $statusPembayaran = "unpaid";
} else {    
    $statusPembayaran = "paid";
}

$query = "";

$query = $query . " INSERT INTO `orders`(`orderID`, `type`, `installment`, `status`, `customerName`, `customerAddress`, `customerPhone`, `dateOrder`, `dateFinish`, statusPembayaran) VALUES ('$orderID', '$payType', '$installment', 'Proses', '$customerName', '$customerAddress', '$customerPhone', '$dateOrder', '$dateFinish','$statusPembayaran'); ";

$query = $query . "INSERT INTO `order_item`(`orderID`, `itemID`, `quantity`, `price`, `itemtype`, `keterangan`, image, itemCat, pembelian) VALUES ";

$sumTotal = 0;
$total = 0;
$i = 0;
$query2 = "SELECT * FROM temp_order WHERE user='$username'";
$result2 = mysqli_query($dbc, $query2);
if (mysqli_num_rows($result2)) {
    while ($data2 = mysqli_fetch_array($result2)) {
        $myArray[] = $data2;        
    }
}

foreach($myArray as $data2){
    if ($i != 0)
            $query .= ", ";
        $query = $query . "('$orderID', '" . $data2['itemID'] . "', '" . $data2['quantity'] . "', '" . $data2['price'] . "', '" . $data2['itemtype'] . "', '" . $data2['keterangan'] . "', '".$data2['image']."', '".$data2['itemCat']."', '".$data2['pembelian']."' ) ";
        $i++;

        $total = round($data2['quantity']) * round($data2['price']);

        $sumTotal = $sumTotal + $total;        
}

$query = $query . " ; ";

foreach($myArray as $data22){
    if($data22['pembelian']=="1"){
        $query = $query . " INSERT INTO purchase (itemID, quantity, type, status, datePurchase,remark, orderID) VALUES ('".$data22['itemID']."', '".$data22['quantity']."', '".$data22['itemCat']."', 'Pending', NOW(), 'Pembelian dari Proses Order', '$orderID') ; ";
    }
}


if ($installment != 0) {
    $customDate = 0;
    $dueDate = "";
    $amount = 0;
    $query = $query . " INSERT INTO `installment`(`orderID`, `amount`, `dueDate`, `status`) VALUES ";
    $j = 0;
    $amount = ($sumTotal-$DP) / $installment;
    $amount = number_format((float)$amount, 2, '.', '');;    
    for ($k = 0; $k < $installment; $k++) {

        $customDate++;
        $customDates = "+" . $customDate . " month ";

        $dueDate = date('Y-m-d', strtotime($customDates, strtotime($dateOrder))) . PHP_EOL;

        if ($k != 0)
            $query .= ", ";
        $query = $query . "('$orderID', '" . $amount . "', '" . $dueDate . "', 'unpaid' ) ";
        
    }

    $query = $query . " ; ";

    $query = $query. "INSERT INTO `payment`(`orderID`, `amount`, `status`) VALUES ('$orderID', '$DP', 'success') ;";
}else{
    $query = $query. "INSERT INTO `payment`(`orderID`, `amount`, `status`) VALUES ('$orderID', '$sumTotal', 'success') ;";
}


$query = $query . " DELETE FROM `temp_order` WHERE user='$username' ; ";

echo $query;

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../order_list2'>";
} else {
    echo "Gagal";
}

function getIDOrder()
{
    include '../connection.php';
    $kode = "ORD";
    $orderID = "";
    $sql = "SELECT orderID	FROM orders ORDER BY orderID DESC LIMIT 1 ";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        $orderID = $kode . "0000001";
    } else {
        $id = $data["orderID"];
        $id = substr($id, 3);

        $orderID = $kode . str_pad($id + 1, 7, 0, STR_PAD_LEFT);
    }

    return $orderID;
}
