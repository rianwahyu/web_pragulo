<?php

include '../connection.php';

$itemID = $_POST['itemIDs'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$itemtype = $_POST['itemtype'];
$keterangan = $_POST['keterangan'];
$username = $_POST['username'];

$filename = $_FILES['media']['name'];
$valid_ext = array('png', 'jpeg', 'jpg');
$location = "../../storage/order/" . $filename;
$loc = "../../storage/order/";
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

//echo $location;

if (empty($filename)) {
    echo "tdk ada";
    $query = "INSERT INTO `temp_order`(`itemID`, `quantity`, `price`, `itemtype`, `keterangan`, user) VALUES ('$itemID', '$quantity','$price', '$itemtype', '$keterangan', '$username')";
    $result = mysqli_query($dbc, $query);
    if ($result == true) {
        echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
    } else {
        echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
    }
} else {
    //echo "ada";
    if (in_array($file_extension, $valid_ext)) {
        $media  = $_FILES["media"];
        list($txt, $ext) = explode(".", $media["name"]);
        $image_name = time() . "." . $ext;
        compressImage($media["tmp_name"], $loc . $image_name, 80);
        $query = "INSERT INTO `temp_order`(`itemID`, `quantity`, `price`, `itemtype`, `keterangan`, user, image ) VALUES ('$itemID', '$quantity','$price', '$itemtype', '$keterangan', '$username', '$image_name')";
        //echo $query;
        $result = mysqli_query($dbc, $query);

        if ($result == true) {
            echo "<meta http-equiv='refresh' content='1 url=../../order_add?status=true'>";
        } else {
            echo "<meta http-equiv='refresh' content='1 url=../../order_add?status=false'>";
        }
    }
}


function compressImage($source, $destination, $quality)
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);
}
