<?php

include 'config/connection.php';

$id = $_POST['id'];

$query = "SELECT SUM(a.quantity) as totStock, b.price as price FROM store_stock a INNER JOIN item b ON a.itemID=b.itemID WHERE a.itemID='$id' GROUP BY a.itemID ";
$result = mysqli_query($dbc, $query);
$rows = mysqli_fetch_array($result);

?>

<div id="itemDetailNon">
    <?php if ($rows['totStock'] == 0) { ?>
        <p>Stok tidak tersedia, barang akan di tambahkan ke Pembelian Barang Non Mebel</p>
        <input type="hidden" name="toPembelian" value="1"/>
        <!-- <div class="form group">
            <label>Stok Tidak tersedia, tambahkan ke pembelian barang</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="inlineCheckbox1" value="1" name="pembelian">
            <label class="form-check-label" for="inlineCheckbox1">Ya</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="inlineCheckbox2" value="0" name="pembelian">
            <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
        </div> -->
    <?php }else{ ?>
        <input type="hidden" name="toPembelian" value="0"/>
    <?php } ?>    
    <div class="form-group">
        <label>Harga</label>
        <input type="number" class="form-control" name="price" onkeypress="return isNumberKey(event)" value=<?= $rows['price']?> />
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" class="form-control" name="quantity" onkeypress="return isNumberKey(event)" />
    </div>  
    
</div>