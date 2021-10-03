<?php
//Include file koneksi ke database
include "config/connection.php";
//menerima nilai dari kiriman form input-barang
$itemID=$_POST["itemID"];
$quantity=$_POST["quantity"];
$price=$_POST["price"];
$itemtype=$_POST['itemtype'];
$keterangan=$_POST['keterangan'];
$user=$_POST['username'];
$image="";

//Query input menginput data kedalam tabel barang
$sql="INSERT INTO `temp_order`(`itemID`, `quantity`, `price`, `itemtype`, `keterangan`, `user`, `image`) VALUES ('$itemID', '$quantity', '$price', '$itemtype', '$keterangan', '$user', '$image')";

//Mengeksekusi/menjalankan query diatas
$hasil=mysqli_query($dbc,$sql);
