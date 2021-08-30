<?php

include '../connection.php';

$id = $_POST['id'];

$query = "DELETE FROM `temp_receive` WHERE `id`='$id' ";

$result = mysqli_query($dbc, $query);

if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../receive_add'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../receive_add'>";
}