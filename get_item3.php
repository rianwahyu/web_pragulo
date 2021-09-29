<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT * FROM item WHERE itemID='$id' ";
$result = mysqli_query($dbc, $query);
$rows = mysqli_fetch_array($result);

?>

<div id="itemDetails">
    <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" class="form-control" value="<?= $rows['itemDescription']?>" disabled />
    </div>
    <div class="form-group">
        <label>Banyaknya</label>
        <input type="number" class="form-control" name="quantity" onkeypress="return isNumberKey(event)" />
    </div>
</div>