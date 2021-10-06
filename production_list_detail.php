<?php include 'include/head.php'; ?>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'include/header.php'; ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'include/aside.php'; ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <?php
            include 'config/connection.php';

            $productionID = "";
            if (isset($_GET)) {
                $productionID = $_GET['productionID'];
                $status = $_GET['status'];
                $source = $_GET['source'];
            } ?>
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
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
                <a href="<?=$source?>">
                    <button type="button" class="btn waves-effect waves-light btn-warning mt-3">Kembali</button>
                </a>
            </div>

            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <?php
                

                $query = "SELECT a.productionID, a.orderID, b.itemName, a.dateIn, a.dateFinish, a.status, a.type, c.customerName FROM production a INNER JOIN item b ON a.itemID=b.itemID INNER JOIN orders c ON a.orderID=c.orderID WHERE productionID='$productionID' ";

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
                // $rows = mysqli_fetch_array($result2);    
                // //echo $query2;

                // $query3 = "SELECT * FROM payment WHERE orderID='$orderID' ";
                // $result3 = mysqli_query($dbc, $query3);

                // $query4 = "SELECT * FROM installment WHERE orderID='$orderID' GROUP BY id ASC ";
                // $result4 = mysqli_query($dbc, $query4);


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
                                    <button class="btn btn-success text-right" data-toggle="modal" data-target="#myModal">Update Proses</button>
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



                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'include/footer.php'; ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php include 'include/footer_jquery.php'; ?>
</body>

</html>