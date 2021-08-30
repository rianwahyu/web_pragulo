<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT a.*, b.categoryName FROM item a INNER JOIN category b ON a.categoryID = b.categoryID WHERE itemID='$id' ";
$result = mysqli_query($dbc, $query); ?>

<div id="itemDetails">
    <div class="form-group">
        <label>Banyaknya</label>
        <input type="text" class="form-control" name="quantity" />
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" class="form-control" name="keterangan" />
    </div>

</div>