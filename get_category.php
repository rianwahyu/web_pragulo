<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT * FROM `item` WHERE `categoryID`='$id' ";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) >= 1) { ?>
<div id="itemID">
    <div class="form-group mt-4">
        <label>Pilih Barang</label>

        <select class="form-control" name="itemID" id="itemID">
            <option selected>Pilih Barang</option>

            <?php
            while ($datas = mysqli_fetch_array($result)) {
            ?>
                <option value="<?= $datas['itemID'] ?>"><?= $datas['itemName'] ?></option>

            <?php
            } ?>
        </select>
    </div>
</div>
<?php } ?>

