<?php

include '../connection.php';

$id = $_POST['id'];
$quantity = $_POST['quantity'];
$type = $_POST['type'];

$query = "UPDATE purchase SET quantity='$quantity' WHERE id='$id' ";
$result = mysqli_query($dbc, $query);
if ($result === TRUE) {
    if ($type == "mebel") {
        header("location:../../purchase_furniture");
    } else {
        header("location:../../purchase_non_furniture");
    }
} else {
    if ($type == "mebel") {
        echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
        echo "<meta http-equiv='refresh' content='2 url=../../purchase_furniture'>";
    } else {
        echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
        echo "<meta http-equiv='refresh' content='2 url=../../purchase_non_furniture'>";
    }
}
