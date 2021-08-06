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
                <a href="production_list">
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
                include 'config/connection.php';

                $productionID = "";
                if (isset($_GET)) {
                    $productionID = $_GET['productionID'];
                }

                $query = "SELECT a.productionID, a.orderID, b.itemName, a.dateIn, a.dateFinish, a.status FROM production a INNER JOIN item b ON a.itemID=b.itemID WHERE productionID='$productionID' ";

                $result = mysqli_query($dbc, $query);
                $rows = mysqli_fetch_array($result);

                $query2 = "SELECT * FROM `timeline` WHERE productionID='$productionID' ";
                $result2 = mysqli_query($dbc, $query2);
                // $rows = mysqli_fetch_array($result2);    
                // //echo $query2;

                // $query3 = "SELECT * FROM payment WHERE orderID='$orderID' ";
                // $result3 = mysqli_query($dbc, $query3);

                // $query4 = "SELECT * FROM installment WHERE orderID='$orderID' GROUP BY id ASC ";
                // $result4 = mysqli_query($dbc, $query4);

                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Produksi</h4>
                            </div>
                            <div class="card-body">
                                <form class="mt-3 form-horizontal">
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
                                        <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Nama Barang</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['itemName'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Jenis Mebel</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['itemName'] ?>" disabled>
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

                                    <div class="card_footer">
                                        <button class="btn btn-success text-right">Update Proses</button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Timeline Produksi</h4>
                            </div>

                            <div class="card-body">
                                <?php
                                if (mysqli_num_rows($result2) >= 1) { ?>
                                    <div class="table-responsive mt-4">
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
                                                while($data = mysqli_fetch_array($result2)) { ?>
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