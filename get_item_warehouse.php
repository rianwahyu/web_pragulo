<?php

include 'config/connection.php';

$itemID = $_POST['itemID'];
$type = $_POST['type'];

$query = "SELECT a.price, SUM(COALESCE(b.quantity,0)) as totStock FROM item a LEFT JOIN warehouse_stock b ON a.itemID=b.itemID WHERE a.itemID='$itemID' AND a.type='mebel' GROUP BY a.itemID ";
$result = mysqli_query($dbc, $query);
$rows = mysqli_fetch_array($result); ?>


<div id="itemDetail2">
    <div class="form-group">
        <label>Stok Gudang </label>
        <label><strong><?= $rows['totStock'] ?> Item </strong></label>

    </div>
    <?php if ($type == "jati") {
        if ($rows['totStock'] == 0) { ?>
            <p>Jenis Kayu Jati tidak ada digudang, akan di masukkan ke antrian pembelian</p>
            <input type="hidden" name="toPembelian" value="1" />
        <?php
        } else { ?>
            <input type="hidden" name="toPembelian" value="0" />
    <? }
    }
    ?>

    <div class="form-row">
        <div class="col">
            <label>Harga</label>
            <input type="text" class="form-control" value="<?= $rows['price'] ?>" name="price" onkeypress="return isNumberKey(event)" placeholder="Harga" required>
        </div>
        <div class="col">
            <label>Jumlah</label>
            <input type="text" class="form-control" name="quantity" onkeypress="return isNumberKey(event)" placeholder="Jumlah" required>
        </div>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" class="form-control" name="keterangan" />
    </div>
</div>