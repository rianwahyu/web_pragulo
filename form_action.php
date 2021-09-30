<?php
//session_start();
include 'koneksi.php';
header('Content-Type: application/json');
//include 'csrf.php';

$id = "";
$itemID = $_POST['itemID'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$itemtype = "tes";
$keterangan = "tes";
$user = "admin";
$image = "tes";

if ($id == "") {
	$query = "INSERT INTO temp_order (itemID, quantity, price, itemtype, keterangan, user, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("sssss", $itemID, $quantity, $price, $itemtype, $keterangan, $user, $image);
	$dewan1->execute();
} /* else {
	$query = "UPDATE tbl_mahasiswa SET nama_mahasiswa=?, alamat=?, jurusan=?, jenis_kelamin=?, tgl_masuk=? WHERE id=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("sssssi", $nama_mahasiswa, $alamat, $jurusan, $jenkel, $tanggal_masuk, $id);
	$dewan1->execute();
} */

echo json_encode(['success' => 'Sukses']);

$db1->close();
?>