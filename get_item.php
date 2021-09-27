<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT a.*, b.categoryName FROM item a INNER JOIN category b ON a.categoryID = b.categoryID WHERE itemID='$id' ";
$result = mysqli_query($dbc, $query);
$rows = mysqli_fetch_array($result); ?>

<div id="itemDetails">
    <div class="form-group mt-4">
        <label>Deskripsi</label>
        <input type="text" class="form-control" value="<?= $rows['itemDescription'] ?>" disabled />
    </div>
    <div class="form-group">
        <label>Banyaknya</label>
        <input type="text" class="form-control" name="quantity" />
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" class="form-control" name="keterangan" />
    </div>

    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" value="<?= $rows['price'] ?>" name="price" />
    </div>

    <div class="form-group">
        <label>Jenis Barang</label>
        <select class="form-control" name="itemtype">
            <option>Pilih Jenis Barang</option>
            <option value="onStock">Barang Stok (Stock) </option>
            <option value="onStore">Barang Siap Jual (On Store)</option>
            <option value="onOrder">Barang Pesanan</option>
            <option value="onOther">Barang Non Jati</option>
        </select>
    </div>

    <div class="form-group">
        <label>Upload Gambar (Opsional)</label>
        <fieldset class="form-group">
            <input type="file" accept="image/*" name="media" >
        </fieldset>
    </div>


</div>

<!-- <div id="itemDetail">

    <?php
    while ($d = mysqli_fetch_array($result)) {
    ?>
        <div class="form-group mt-4">
            <label>Deskripsi</label>
            <input type="text" class="form-control" value="<?= $d['itemDescription'] ?>" disabled />
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <input type="text" class="form-control" value="<?= $d['categoryName'] ?>" disabled />
        </div>

        <div class="form-group">
            <label>Banyaknya</label>
            <input type="text" class="form-control" name="quantity" />
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" value="<?= $d['price'] ?>" name="price" />
        </div>

        <div class="form-group">
            <label>Jenis Barang</label>
            <select class="form-control" name="itemtype">
                <option>Pilih Jenis Barang</option>
                <option value="onStock">Barang Stok (Stock) </option>
                <option value="onStore">Barang Siap Jual (On Store)</option>
                <option value="onOrder">Barang Pesanan</option>
                <option value="onOther">Barang Non Jati</option>                
            </select>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control"  name="keterangan" />
        </div>
        

    <?php
    } ?>

</div> -->