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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Laporan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Laporan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Stok Toko</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
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

                if (isset($_GET)) {
                    $start = $_GET['start']. " 00:00:00";
                    $end = $_GET['end']. " 23:59:00";
                }

                $query = "SELECT DATE_FORMAT(a.dateStock, '%Y-%m-%d') as tglStock, a.itemID, b.itemName, a.quantity, a.remark FROM store_stock a INNER JOIN item b ON a.itemID=b.itemID WHERE a.dateStock BETWEEN '$start' AND '$end' ORDER BY a.dateStock ASC ";

                $result = mysqli_query($dbc, $query);

                //echo $query;
                ?>



                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Periode Laporan Stok Toko</h4>
                                <h6 class="card-subtitle">Pilih Periode Stok tanggal awal dan akhir</h6>

                                <form class="form-inline" action="" method="GET">
                                    <div class="input-group">
                                        <input type="date" class="form-control" placeholder="Tgl Awal" name="start" value="<?= $start ?>">
                                        <label>s/d</label>
                                        <input type="date" class="form-control " placeholder="Tgl Akhir" name="end" value="<?= $end ?>">

                                        <button type="submit" class="btn btn-outline-primary" type="button">Cari</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Toko</h4>
                                <h6 class="card-subtitle">List Stok Toko</h6>


                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        $grandTotal = 0;
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>
                                        <form action="config/report/downloadStoreStock.php" method="POST" target="_blank" class="mb-4">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <input type="hidden" name="start" value="<?= $start ?>" />
                                            <input type="hidden" name="end" value="<?= $end ?>" />
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <table class="table mt-4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tgl Stok</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($myArray as $data) {
                                                    $i++; ?>
                                                    <tr>
                                                        <td><?= $data['tglStock']; ?></td>
                                                        <td><?= $data['itemName']; ?></td>
                                                        <td class="text-right"><?= $data['quantity']; ?></td>
                                                        <td><?= $data['remark']; ?></td>
                                                    </tr>
                                                <?php
                                                    //$grandTotal = $grandTotal + $data['total'];

                                                    // echo $grandTotal;
                                                }


                                                mysqli_close($dbc); ?>
                                            </tbody>

                                           

                                        </table>
                                    <?php }

                                    function rupiah($angka)
                                    {
                                        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                                        return $hasil_rupiah;
                                    }
                                    ?>



                                </div>

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