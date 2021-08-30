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
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Pembayaran Lunas</li>
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

                if(isset($_GET)){
                    $start = $_GET['start'];
                    $end = $_GET['end'];
                }

                $query = "SELECT a.* , SUM(b.quantity * b.price ) as total FROM `orders` a INNER JOIN order_item b ON a.orderID=b.orderID WHERE statusPembayaran='paid' AND a.dateOrder BETWEEN '$start' AND '$end' GROUP BY a.orderID  ";

                $result = mysqli_query($dbc, $query);

                //echo $query;
                ?>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Periode Order</h4>
                                <h6 class="card-subtitle">Pilih Periode tanggal awal dan akhir</h6>

                                <form class="form-inline" action="" method="GET">
                                    <div class="input-group">
                                        <input class="mr-2" type="date" class="form-control" placeholder="Tgl Awal" name="start" value="<?= $start?>">
                                        <label> s/d </label>
                                        <input class="ml-2" type="date" class="form-control" placeholder="Tgl Akhir" name="end" value="<?= $end?>">

                                        <button type="submit" class="btn btn-outline-secondary ml-4" type="button">Cari</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pembayaran Lunas</h4>
                                <h6 class="card-subtitle">Daftar Order dengan pembayaran lunas</h6>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Barang</button>
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6> -->


                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        $grandTotal = 0;
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>
                                        <form action="config/order/downloadExcelOrderPaid.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <input type="hidden" name="start" value="<?= $start?>"/>
                                            <input type="hidden" name="end" value="<?= $end?>"/>
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Nama Customer</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">No HP</th>
                                                    <th scope="col">Tanggal Order</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($myArray as $data) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['orderID']; ?></td>
                                                        <td><?= $data['customerName']; ?></td>
                                                        <td><?= $data['customerAddress']; ?></td>
                                                        <td><?= $data['customerPhone']; ?></td>
                                                        <td><?= $data['dateOrder']; ?></td>
                                                        <td><?= $data['statusPembayaran']; ?></td>
                                                        <td class="text-right"><?= rupiah(round($data['total'])); ?></td>
                                                    </tr>
                                                <?php
                                                    $grandTotal = $grandTotal + $data['total'];
                                                }


                                                mysqli_close($dbc); ?>
                                            </tbody>

                                            <tfoot>
                                                <th class="text-center" colspan="7">Grand Total</th>
                                                <th class="text-right"> <?= rupiah(round($data['total'])); ?> </th>
                                            </tfoot>
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