<?php include 'include/head.php'; ?>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php include 'include/header.php'; ?>

        <?php include 'include/aside.php'; ?>

        <div class="page-wrapper">
            <?php
            include 'config/connection.php';

            $productionID = "";
            if (isset($_GET)) {
                $productionID = $_GET['productionID'];
                $status = $_GET['status'];
                $source = $_GET['source'];
            } ?>

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Produksi</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Produksi</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Detail Produksi</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <a href="<?= $source ?>">
                    <button type="button" class="btn waves-effect waves-light btn-warning mt-3">Kembali</button>
                </a>
            </div>

            <div class="container-fluid">

                <?php

                $query = "SELECT a.productionID, a.orderID, b.itemName, a.dateIn, a.dateFinish, a.status, a.type, c.customerName, a.itemID 
                FROM production a 
                INNER JOIN item b ON a.itemID=b.itemID 
                INNER JOIN orders c ON a.orderID=c.orderID WHERE productionID='$productionID' ";

                $result = mysqli_query($dbc, $query);
                $rows = mysqli_fetch_array($result);

                $jenisMebel = "";
                if ($rows['type'] == "local") {
                    $jenisMebel = "Kayu Lokal";
                } else {
                    $jenisMebel = "Kayu Jati";
                }

                $query2 = "SELECT * FROM `timeline` WHERE productionID='$productionID' ";
                $result2 = mysqli_query($dbc, $query2);
                $successInsert = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                                    role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Sukses - </strong> update status produksi berhasil
                                </div>';

                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Produksi</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">ID Produksi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['productionID'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">ID Order</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['orderID'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Nama Customer</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['customerName'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Nama Barang</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['itemName'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Jenis Mebel</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $jenisMebel ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['dateIn'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['dateFinish'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="card-footer float-right">
                                    <button class="btn btn-success text-right" data-toggle="modal" data-target="#myModalSelesai" <?php echo ( $rows['status'] == "Selesai") ? 'disabled' : '' ?>>Selesai Produksi</button>
                                    <button class="btn btn-success text-right" data-toggle="modal" data-target="#myModal" <?php echo ($rows['status'] == "Finishing" || $rows['status'] == "Selesai") ? 'disabled' : '' ?>>Update Proses</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Timeline Produksi</h4>
                            </div>

                            <?php
                            if ($status == "true") {
                                echo $successInsert;
                            }
                            ?>

                            <div class="card-body">
                                <?php
                                if (mysqli_num_rows($result2) >= 1) {
                                    while ($data = mysqli_fetch_array($result2)) {
                                        $myArray[] = $data;
                                    } ?>
                                    <div class="table-responsive mt-2">

                                        <form action="config/production/downloadExcelProductionTimeLine.php" method="POST" target="_blank">
                                            <input type="hidden" name="productionID" value="<?= $rows['productionID'] ?>" />
                                            <input type="hidden" name="orderID" value="<?= $rows['orderID'] ?>" />
                                            <input type="hidden" name="customerName" value="<?= $rows['customerName'] ?>" />
                                            <input type="hidden" name="itemName" value="<?= $rows['itemName'] ?>" />
                                            <input type="hidden" name="jenisMebel" value="<?= $jenisMebel ?>" />
                                            <input type="hidden" name="dateIn" value="<?= $rows['dateIn'] ?>" />
                                            <input type="hidden" name="dateFinish" value="<?= $rows['dateFinish'] ?>" />
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <table class="table">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th id="no" class="text-center">#</th>
                                                    <th id="customerName" class="text-center">Pegawai</th>
                                                    <th id="itemName" class="text-center">Tanggal</th>
                                                    <th id="keterangan" class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($myArray as $data) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['username'] ?></td>
                                                        <td><?= $data['date'] ?></td>
                                                        <td><?= $data['note'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else {
                                    echo "<h4>Data tidak ditemukan</h4>";
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="myModalSelesai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="config/production/updateFinishProduction.php" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Selesai Produksi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda ingin mengkonfirmasi proses produksi selesai dan barang akan di kirim ke gudang ?</p>
                                    <input type="hidden" class="form-control" name="productionID" value="<?= $productionID ?>" />
                                    <input type="hidden" class="form-control" name="orderID" value="<?= $rows['orderID'] ?>" />
                                    <input type="hidden" class="form-control" name="itemID" value="<?= $rows['itemID'] ?>" />
                                    <input type="hidden" class="form-control" name="source" value="<?= $source ?>" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="#" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Updata Proses Produksi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label hidden>Item ID</label>
                                        <input type="hidden" class="form-control" name="productionID" value="<?= $productionID ?>" />

                                    </div>
                                    <div class="form-group">
                                        <label>Update Status Produksi</label>
                                        <select class="form-control" name="status">
                                            <option disabled selected>Pilih Status Produksi</option>
                                            <option value="Perakitan">Antrian Perakitan</option>
                                            <option value="Pengamplasan">Antrian Pengamplasan</option>
                                            <option value="Penyemprotan">Antrian Penyemprotan</option>
                                            <option value="Pemasangan Jog">Antrian Pemasangan Jog</option>
                                            <option value="Finishing">Antrian Finishing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Update Proses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <?php include 'include/footer.php'; ?>
        </div>
    </div>
    <?php include 'include/footer_jquery.php'; ?>
</body>

</html>