<?php

include '../connection.php';

$test = $_POST['test'];
$orderID = $_POST['orderID'];
$amount = $_POST['amount'];
$sumTotals = $_POST['sumTotals'];
$paid = $_POST['paid'];
$sisa = $_POST['sisa'];


$query = "";
$sql = " SELECT id as idInstallment, orderID FROM installment WHERE orderID='$orderID' AND status='unpaid' ORDER BY id ASC LIMIT $test";
echo $sql;
$result = mysqli_query($dbc, $sql);
while($data = mysqli_fetch_array($result)){
    $query = $query. " UPDATE installment SET status='paid' WHERE id='$data[idInstallment]' ;";
}

for($i=0;$i<$test;$i++){
    $query = $query. "INSERT INTO payment (orderID, amount, status) VALUES ('$orderID', '$amount', 'success') ; ";
}

$totalAmount = $test*$amount + $paid;
// echo $totalAmount;

if($totalAmount >= $sumTotals){
    $query = $query. " UPDATE orders SET statuspembayaran='paid' WHERE orderID='$orderID' ;";
}

//echo $query;
if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../order_list_detail?orderID=".$orderID."&installment=true'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../order_list_detail?orderID=".$orderID."&installment=false'>";
}