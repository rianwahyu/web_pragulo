<?php

include '../connection.php';

$installment = $_POST['installment'];
$customerName = $_POST['customerName'];
$customerAddress = $_POST['customerAddress'];
$customerPhone = $_POST['customerPhone'];
$dateOrder = $_POST['dateOrder'];
$dateFinish = $_POST['dateFinish'];

$orderID = getIDOrder();
$type = "";
$statusPembayaran = "";

if ($installment != 0) {
    $type = "Cicilan";
    $statusPembayaran = "unpaid";
} else {
    $type = "Cash";
    $statusPembayaran = "paid";
}



$query = "";

$query = $query . " INSERT INTO `orders`(`orderID`, `type`, `installment`, `status`, `customerName`, `customerAddress`, `customerPhone`, `dateOrder`, `dateFinish`, statusPembayaran) VALUES ('$orderID', '$type', '$installment', 'Proses', '$customerName', '$customerAddress', '$customerPhone', '$dateOrder', '$dateFinish','$statusPembayaran'); ";

$query = $query . "INSERT INTO `order_item`(`orderID`, `itemID`, `quantity`, `price`, `itemtype`, `keterangan`) VALUES ";

$sumTotal = 0;
$total = 0;
$i = 0;
$query2 = "SELECT * FROM temp_order WHERE 1";
$result2 = mysqli_query($dbc, $query2);
if (mysqli_num_rows($result2)) {
    while ($data2 = mysqli_fetch_array($result2)) {

        if ($i != 0)
            $query .= ", ";
        $query = $query . "('$orderID', '" . $data2['itemID'] . "', '" . $data2['quantity'] . "', '" . $data2['price'] . "', '" . $data2['itemtype'] . "', '" . $data2['keterangan'] . "' ) ";
        $i++;

        $total = round($data2['quantity']) * round($data2['price']);

        $sumTotal = $sumTotal + $total;
    }
}
$query = $query . " ; ";


if ($installment != 0) {
    $customDate=0;
    $dueDate="";
    $amount=0;
    $query = $query . " INSERT INTO `installment`(`orderID`, `amount`, `dueDate`, `status`) VALUES ";
    $j = 0;
    $amount = $sumTotal / $installment;
    $amount = number_format((float)$amount, 2, '.', '');;
    //echo abs($amount);
    for ($k=0; $k < $installment; $k++) {
        
        $customDate++;
        $customDates = "+".$customDate. " month ";

        //echo $customDates;

        $dueDate = date('Y-m-d',strtotime($customDates, strtotime($dateOrder))) . PHP_EOL;

        if ($k != 0)
        $query .= ", ";
        $query = $query . "('$orderID', '".$amount."', '".$dueDate."', 'unpaid' ) ";
        //$j++;
    }

    $query = $query . " ; ";
}


//echo $query;

$query = $query . " DELETE FROM `temp_order` WHERE 1 ; ";

//echo $query;
if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../order_list'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../order_list'>";
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