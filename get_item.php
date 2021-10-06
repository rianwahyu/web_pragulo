<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT a.itemID,a.itemName, a.itemDescription, a.price, SUM(COALESCE(b.quantity,0)) as totStock FROM item a LEFT JOIN store_stock b ON a.itemID=b.itemID WHERE a.itemID='$id' AND a.type='mebel' GROUP BY a.itemID ";
$result = mysqli_query($dbc, $query);
$rows = mysqli_fetch_array($result); ?>

<div id="itemDetail">
    <div class="form-group mt-4">
        <label>Deskripsi</label>
        <textarea style="width: 100%;" disabled>
        <?= $rows['itemDescription'] ?>
        </textarea>

    </div>

    <div class="form-group">
        <label>Stok Toko </label>
        <label><strong><?= $rows['totStock'] ?> Item </strong></label>

    </div>

    <?php if ($rows['totStock'] == 0) {  ?>
        <h6>Stok barang tidak ada di toko dan memerlukan pengecekan di gudang, silahkan memilih jenis kayu</h6>
        <div class="form-group">
            <label>Jenis Kayu</label>
            <select class="form-control" name="itemtype" id="itemtypes" required>
                <option selected disabled>Pilih Jenis Barang</option>
                <option value="local">Kayu Local</option>
                <option value="jati">Kayu Jati</option>
            </select>
        </div>
    <?php } else { ?>
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
    <?php }
    ?>

    <!--  -->

</div>