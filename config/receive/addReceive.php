<?php
include '../connection.php';


$user = $_POST['username'];
$receiveID = getIDOrder();
$curYear = date('Y');

$query = "";

$query = $query . " INSERT INTO `receive`(`receiveID`, `user`, `dateReceive`, `year`) VALUES ('$receiveID', '$user', NOW(), '$curYear'); ";

$query2 = "SELECT * FROM temp_receive WHERE user='$user' ";
$result2 = mysqli_query($dbc, $query2);
$result3 = mysqli_query($dbc, $query2);

if (mysqli_num_rows($result2) >=1) {

    $i = 0;
    $j = 0;

    $query = $query . " INSERT INTO `receive_item`(`receiveID`, `itemID`, `quantity`, `keterangan`) VALUES ";
    while ($data2 = mysqli_fetch_array($result2)) {

        if ($i != 0)
            $query .= ", ";
        $query = $query . "('$receiveID', '" . $data2['itemID'] . "', '" . $data2['quantity'] . "', '" . $data2['keterangan'] . "' ) ";
        $i++;
    }
    $query = $query . " ; ";


    $query = $query . " INSERT INTO `item_stock`(`itemID`, `type`, `qty`, receiveID) VALUES ";

    while ($data3 = mysqli_fetch_array($result3)) {

        if ($j != 0)
        $query .= ", ";
        $query = $query . "('" . $data3['itemID'] . "', 'in' ,'" . $data3['quantity'] . "', '$receiveID') ";
        $j++;
    }
    $query = $query . " ; ";
}


$query = $query . " DELETE FROM `temp_receive` WHERE user='$user' ; ";
//echo $query;

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../receive'>";
} else {
    echo "Gagal";
}


function getIDOrder()
{
    include '../connection.php';
    $kode = "RC";
    $curYear = date('y');
    $receiveID = "";
    $sql = "SELECT receiveID FROM receive ORDER BY receiveID DESC LIMIT 1 ";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        $receiveID = $kode.$curYear. "0000001";
    } else {
        $id = $data["receiveID"];
        $id = substr($id, 4);

        $receiveID = $kode . $curYear . str_pad($id + 1, 6, 0, STR_PAD_LEFT);
    }

    return $receiveID;
}
