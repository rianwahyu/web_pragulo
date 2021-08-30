<?php

include '../connection.php';

$id = $_POST['id'];
$quantity = $_POST['quantity'];
$keterangan = $_POST['keterangan'];


$query ="UPDATE `temp_receive` SET `quantity`='$quantity', `keterangan`='$keterangan' WHERE id='$id' ";
$result = mysqli_query($dbc, $query);
if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../receive_add'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../receive_add'>";

}