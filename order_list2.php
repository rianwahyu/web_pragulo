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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Order / Pesanan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Pesanan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Daftar Order</li>
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

                $query = "SELECT a.id, a.orderID, b.dateOrder, b.dateFinish, b.customerName, b.customerAddress, b.customerPhone, a.itemID, c.itemName, a.quantity, a.price, a.keterangan, a.finish, a.itemCat, COALESCE(SUM(d.quantity),0) as totalStock 
                FROM order_item a 
                INNER JOIN orders b ON a.orderID=b.orderID 
                INNER JOIN item c ON a.itemID=c.itemID 
                LEFT JOIN store_stock d ON a.itemID = d.itemID
                WHERE a.finish='0' GROUP BY a.orderID";

                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-12">
                        <?php

                        if (isset($_GET)) {
                            $status = $_GET['status'];

                            if ($status == "lowerStock") {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Stok Kurang - </strong> Stok Persediaan toko kurang atau kosong, barang tidak bisa di antar ke customer
                            </div>';
                            }
                        }
                        ?>
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title">Daftar Pesanan</h4>
                                <h6 class="card-subtitle">Pesanan</h6>
                                <p>Halaman ini berisi daftar penjulanan yang belum di antar / diterima oleh customer. Halaman ini terhubung dengan stok toko. Jadi ketika ada barang produksi dengan status selesai produksi dan tombol antar belum tersedia. Maka mohon melakukan cek di menu Persediaan - Gudang</p>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>
                                        <form action="config/order/downloadExcelOrderList.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <button type="submit" class="btn btn-success float-right" hidden>Download Excel</button>
                                        </form>
                                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Tgl Order</th>
                                                    <th scope="col">Nama Customer</th>
                                                    <th scope="col">Nama Item </th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Stok Toko</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($myArray as $data) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['orderID']; ?></td>
                                                        <td><?= $data['dateOrder']; ?></td>
                                                        <td><?= $data['customerName']; ?></td>
                                                        <td><?= $data['itemName']; ?></td>
                                                        <td class="text-right"><?= $data['quantity']; ?></td>
                                                        <td class="text-right"><?= $data['totalStock']; ?></td>
                                                        <td class="text-right"><?= rupiah($data['price']); ?></td>
                                                        <td><?= $data['keterangan']; ?></td>
                                                        <td><?php echo ($data['finish'] == 1) ? 'Diterima Customer' : 'Menunggu Konfirmasi'; ?></td>
                                                        <td>
                                                            <?php if ($data['totalStock'] != "0") { ?>
                                                                <a href="#" data-toggle="modal" data-target="#finishItem<?= $data['id']; ?>">
                                                                    <button type="button" class="btn btn-success btn-rounded btn-sm" <?php echo ($data['finish'] == 1) ? 'disabled' : ''; ?>> Antar</button>
                                                                </a>
                                                            <?php } ?>

                                                            <a href="#" data-toggle="modal" data-target="#editCustomer<?= $data['orderID']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded btn-sm" <?php echo ($data['finish'] == 1) ? 'disabled' : ''; ?>> Edit</button>
                                                            </a>
                                                        </td>

                                                        <div id="editCustomer<?= $data['orderID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form class="mt-2" action="#" method="POST">
                                                                    <input type="hidden" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">Data Customer</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Nama Customer</label>
                                                                                <input type="text" class="form-control" name="itemName" value="<?= $data['customerName'] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Alamat Customer</label>
                                                                                <input type="text" class="form-control" name="itemName" value="<?= $data['customerAddress'] ?>">
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>No Handphone</label>
                                                                                <input type="text" class="form-control" name="itemDescription" value="<?= $data['customerPhone'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-success">Edit Data</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>

                                                        <div id="finishItem<?= $data['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-info-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/order/confirmOrder.php" method="POST">
                                                                    <input type="hidden" name="id_order_item" value="<?= $data['id'] ?>" />
                                                                    <input type="hidden" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                    <input type="hidden" name="quantity" value="<?= $data['quantity'] ?>" />
                                                                    <input type="hidden" name="price" value="<?= $data['price'] ?>" />
                                                                    <input type="hidden" name="orderID" value="<?= $data['orderID'] ?>" />

                                                                    <input type="hidden" name="itemType" value="<?= $data['itemCat'] ?>" />
                                                                    <div class="modal-content modal-filled bg-info">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Konfirmasi Stok Keluar
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin mengonfirmasi stok keluar dari toko ke Customer ? </p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-outline-light">Ya</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>


                                                    </tr>
                                                <?php }


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