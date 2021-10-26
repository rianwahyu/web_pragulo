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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Order Detail</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Pesanan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Daftar Item Order</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <a href="order_list3">
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

                $myArray4 = array();

                $orderID = "";
                if (isset($_GET)) {
                    $orderID = $_GET['orderID'];
                }

                $query = "SELECT a.orderID, b.itemName, a.quantity, a.price, a.itemtype, a.keterangan FROM order_item a INNER JOIN item b ON a.itemID=b.itemID WHERE a.orderID='$orderID' ";

                $query2 = "SELECT * FROM orders WHERE orderID='$orderID' ";
                $result2 = mysqli_query($dbc, $query2);
                $rows = mysqli_fetch_array($result2);

                $result = mysqli_query($dbc, $query);
                //echo $query2;

                $query3 = "SELECT * FROM payment WHERE orderID='$orderID' ";
                $result3 = mysqli_query($dbc, $query3);

                $query4 = "SELECT * FROM installment WHERE orderID='$orderID' GROUP BY id ASC ";
                $result4 = mysqli_query($dbc, $query4);

                $query5 = "SELECT * FROM installment WHERE orderID='$orderID' AND status='unpaid' GROUP BY id ASC ";
                $result5 = mysqli_query($dbc, $query5);

                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Order Data</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['customerName'] ?>" disabled>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">No HP</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['customerPhone'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['customerAddress'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Tanggal Order</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['dateOrder'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['dateFinish'] ?>" disabled>
                                        <small id="name" class="form-text text-muted">Estimasi Selesai</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Status Pembayaran</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['statusPembayaran'] ?>" disabled>

                                    </div>
                                </div>

                                <?php
                                if ($rows['installment'] > 0) { ?>
                                    <div class="form-group row">
                                        <label for="inputHorizontalSuccess" class="col-sm-4 col-form-label">Periode Cicilan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputHorizontalSuccess" value="<?= $rows['installment'] ?> bulan" disabled>

                                        </div>
                                    </div>
                                <?php }
                                ?>

                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order Item List</h4>
                                <h6 class="card-subtitle">Daftar Item Order</h6>
                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>

                                        <form action="config/order/downloadExcelOrderDetail.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <input type="hidden" name="orderID" value="<?= $rows['orderID'] ?>" />
                                            <input type="hidden" name="customerName" value="<?= $rows['customerName'] ?>" />
                                            <input type="hidden" name="customerPhone" value="<?= $rows['customerPhone'] ?>" />
                                            <input type="hidden" name="customerAddress" value="<?= $rows['customerAddress'] ?>" />
                                            <input type="hidden" name="dateOrder" value="<?= $rows['dateOrder'] ?>" />
                                            <input type="hidden" name="dateFinish" value="<?= $rows['dateFinish'] ?>" />
                                            <input type="hidden" name="statusPembayaran" value="<?= $rows['statusPembayaran'] ?>" />
                                            <input type="hidden" name="installment" value="<?= $rows['installment'] ?>" />

                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Tipe Order</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $total = 0;
                                                $sumTotals = 0;
                                                foreach ($myArray as $data) {
                                                    $total = round($data['quantity']) * round($data['price']);
                                                    $sumTotals  = $sumTotals + $total; ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['orderID']; ?></td>
                                                        <td><?= $data['itemName']; ?></td>
                                                        <td><?= $data['itemtype']; ?></td>
                                                        <td><?= $data['keterangan']; ?></td>
                                                        <td class="text-right"><?= round($data['quantity']); ?></td>
                                                        <td class="text-right"><?= rupiah(round($data['price'])); ?></td>
                                                        <td class="text-right"><?= rupiah($total); ?></td>

                                                        <div id="updateItem<?= $data['itemID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <?php
                                                                include 'config/connection.php';

                                                                $querys = "SELECT * FROM category ";
                                                                $results = mysqli_query($dbc, $querys);

                                                                ?>?
                                                                <form class="mt-2" action="config/item/editItem" method="POST">
                                                                    <input type="hidden" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Nama Barang</label>
                                                                                <input type="text" class="form-control" name="itemName" value="<?= $data['itemName'] ?>">
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>Deskripsi Barang</label>
                                                                                <input type="text" class="form-control" name="itemDescription" value="<?= $data['itemDescription'] ?>">
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>Deskripsi Barang</label>
                                                                                <select class="form-control" name="categoryID">
                                                                                    <option selected disabled>Pilih Kategori</option>
                                                                                    <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                                                                        <option value="<?= $datas['categoryID'] ?>" <?php if ($datas['categoryID'] == $data['categoryID']) echo 'selected="selected"'; ?>><?= $datas['categoryName'] ?></option>
                                                                                    <?php } ?>

                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>Harga</label>
                                                                                <input type="number" class="form-control" name="price" value="<?= $data['price'] ?>">
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-success">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>

                                                        <div id="deleteItem<?= $data['itemID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/item/deleteItem" method="POST">
                                                                    <input type="hidden" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                    <div class="modal-content modal-filled bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Hapus Barang
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin menghapus barang terpilih ?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-outline-light">Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>


                                                    </tr>


                                                <?php }
                                                mysqli_close($dbc); ?>

                                                <tr>
                                                    <th class="text-center" colspan="7">Sum Total</th>
                                                    <th class="text-right"><?= rupiah($sumTotals); ?></th>
                                                </tr>
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

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Pembayaran</h4>
                                <h6 class="card-subtitle">Detail Pembayaran</h6>
                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result3) >= 1) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Jumlah Bayar</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $k = 1;
                                                while ($data3 = mysqli_fetch_array($result3)) { ?>
                                                    <tr>
                                                        <td><?= $k++ ?></td>
                                                        <td><?= $data3['orderID'] ?></td>
                                                        <td><?= rupiah(round($data3['amount'])) ?></td>
                                                        <td><?= $data3['status'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo "<h4>Data pembayaran tidak ditemukan</h4>";
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Cicilan</h4>
                                <h6 class="card-subtitle">Detail Pembayaran dengan cicilan</h6>
                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result4) >= 1) {
                                        while ($data4 = mysqli_fetch_array($result4)) {
                                            $myArray4[] = $data4;
                                        }
                                    ?>

                                        <form action="config/order/downloadExcelOrderDetailCicilan.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray4" value="<?php echo htmlentities(serialize($myArray4)); ?>" />
                                            <input type="hidden" name="orderID" value="<?= $rows['orderID'] ?>" />
                                            <input type="hidden" name="customerName" value="<?= $rows['customerName'] ?>" />
                                            <input type="hidden" name="customerPhone" value="<?= $rows['customerPhone'] ?>" />
                                            <input type="hidden" name="customerAddress" value="<?= $rows['customerAddress'] ?>" />
                                            <input type="hidden" name="dateOrder" value="<?= $rows['dateOrder'] ?>" />
                                            <input type="hidden" name="dateFinish" value="<?= $rows['dateFinish'] ?>" />
                                            <input type="hidden" name="statusPembayaran" value="<?= $rows['statusPembayaran'] ?>" />
                                            <input type="hidden" name="installment" value="<?= $rows['installment'] ?>" />

                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <!-- <th scope="col">Order ID</th> -->
                                                    <th scope="col">Tagihan</th>
                                                    <th scope="col">Jatuh Tempo</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $k = 1;
                                                foreach ($myArray4 as $data4) { ?>
                                                    <tr>
                                                        <td><?= $k++ ?></td>
                                                        <!-- <td><?= $data4['orderID'] ?></td> -->
                                                        <td><?= rupiah(round($data4['amount'])) ?></td>
                                                        <td><?= $data4['dueDate'] ?></td>
                                                        <td><?= $data4['status'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <h4 class="card-title">Bayar Cicilan</h4>
                                        <h6 class="card-subtitle">Pembayaran Cicilan</h6>

                                        <form action="config/order/updateInstallment.php" method="POST">
                                            <select name="test" id="test">
                                                <option disabled selected>Pilih Periode Pembayaran</option>
                                                <?php
                                                $l = 1;
                                                while ($data5 = mysqli_fetch_array($result5)) { ?>
                                                    <option value="<?= $l; ?>"><?= $l; ?> Bulan</option>
                                                <?php
                                                    $l++;
                                                }
                                                ?>
                                            </select>
                                            <!-- <label>Total dibayarakan : Rp. </label> -->
                                            <span data-val="<?= round($data4['amount']) ?>"><?= round($data4['amount']) ?></span>

                                            <input type="hidden" name="amount" value="<?= round($data4['amount']) ?>" />
                                            <input type="hidden" name="sumTotals" value="<?= round($sumTotals) ?>" />
                                            <input type="hidden" name="orderID" value="<?= $orderID ?>" />
                                            <button class="btn btn-success" type="submit" name="submit">Update Pembayaran</button>
                                        </form>
                                    <?php } else {
                                        echo "<h4>Tidak ditemukan data cicilan / pembayaran dilakukan secara cash</h4>";
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

    <script type="text/javascript">
        $('#test').change(function() {
            var span = $(this).next('span');
            span.text(span.data('val') * parseInt(this.value, 10))
        })
    </script>

</body>

</html>