<?php

include 'config/connection.php';

$itemID = $_POST['itemIDs'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$itemtype = $_POST['itemtype'];
$keterangan = $_POST['keterangan'];
$username = $_POST['username'];

$query = "INSERT INTO `temp_order`(`itemID`, `quantity`, `price`, `itemtype`, `keterangan`, user) VALUES ('$itemID', '$quantity','$price', '$itemtype', '$keterangan', '$username')";
mysqli_query($dbc, $query);