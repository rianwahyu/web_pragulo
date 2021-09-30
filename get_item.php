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
        <label>Jumlah</label>
        <input type="text" class="form-control" name="quantity" onkeypress="return isNumberKey(event)"  />
    </div>

    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" value="<?= $rows['price'] ?>" name="price" onkeypress="return isNumberKey(event)"  />
    </div>

    <div class="form-group">
        <label>Jenis Kayu</label>
        <select class="form-control" name="itemtype">
            <option>Pilih Jenis Barang</option>
            <option value="local">Kayu Local</option>
            <option value="jati">Kayu Jati</option>            
        </select>
    </div>

    <div class="form-group">
        <label>Upload Gambar (Opsional)</label>
        <fieldset class="form-group">
            <input type="file" accept="image/*" name="media" >
        </fieldset>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" class="form-control" name="keterangan" />
    </div>

</div>
