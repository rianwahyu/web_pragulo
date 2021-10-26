<?php
//Include file koneksi ke database
include "config/connection.php";
//menerima nilai dari kiriman form input-barang

$itemCat = $_POST['itemCat'];
$toPembelian = $_POST['toPembelian'];

$itemIDNon = $_POST['itemIDNon'];

$itemID = $_POST["itemID"];
$quantity = $_POST["quantity"];
$price = $_POST["price"];
$itemtype = $_POST['itemtype'];
$keterangan = $_POST['keterangan'];
$user = $_POST['username'];
$image = "";

//Query input menginput data kedalam tabel barang

$sql = "";

if ($itemCat == "non mebel") {    
    // if ($toPembelian == 1) {
    //     $sql = $sql . " INSERT INTO `purchase`(`itemID`, `quantity`, `type`, `status`, `datePurchase`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6]) ; ";
    // }    
    $sql = $sql . " INSERT INTO `temp_order`(`itemID`, `quantity`, `price`, `itemtype`, `keterangan`, `user`, `image`, itemCat, pembelian) VALUES ('$itemIDNon', '$quantity', '$price', '-', '$keterangan', '$user', '$image', '$itemCat', '$toPembelian') ;";
} else {
    $sql = $sql . "INSERT INTO `temp_order`(`itemID`, `quantity`, `price`, `itemtype`, `keterangan`, `user`, `image`, itemCat) VALUES ('$itemID', '$quantity', '$price', '$itemtype', '$keterangan', '$user', '$image', '$itemCat')";
}


//Mengeksekusi/menjalankan query diatas
//$hasil=mysqli_query($dbc,$sql);
$hasil = mysqli_multi_query($dbc, $sql);

?>

<!-- <div id="error"><?php echo $sql ?></div> -->