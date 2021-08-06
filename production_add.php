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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Form Produksi</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Produksi</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Tambah Prouduksi</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            <?php
            $successInsert = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                                    role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Sukses - </strong> Sukses menambahkan barang ke proses produksi
                                </div>'; ?>

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php
                include 'config/connection.php';

                if (isset($_GET)) {
                    $key = $_GET['key'];
                    $status = $_GET['status'];
                }
                ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cari Data Order</h4>
                                <h6 class="card-subtitle">Cari berdasarkan ID Order</h6>
                                <form class="mt-4" method="GET" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="key" value="<?= $key ?>" />
                                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <?php

                    $query = "SELECT a.id as orderItemID, a.orderID, a.itemID, c.itemName, a.quantity, a.price, a.keterangan, b.customerName FROM order_item a INNER JOIN orders b ON a.orderID=b.orderID  INNER JOIN item c ON a.itemID=c.itemID WHERE a.itemtype='onOrder' AND a.prod='0' ";
                    $result = mysqli_query($dbc, $query);

                    ?>

                    <div class="col-sm-12 col-md-10 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar</h4>
                                <h6 class="card-subtitle">Data barang yang akan di proses ke produksi</h6>

                                <?php
                                if ($status == "true") {echo $successInsert;}
                                ?>

                                <?php if (mysqli_num_rows($result3) >= 1) {  ?>
                                    <div class="table-responsive mt-4">
                                        <table class="table" style="width: 100%;">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th id="no" class="text-center">#</th>
                                                    <th id="idOrder" class="text-center">ID Order</th>
                                                    <th id="customerName" class="text-center">Nama Customer</th>
                                                    <th id="itemName" class="text-center">Nama Barang</th>
                                                    <th id="quantity" class="text-center">Jumlah</th>
                                                    <th id="harga" class="text-center">Harga Satuan</th>
                                                    <th id="keterangan" class="text-center">Keterangan</th>
                                                    <th id="opsi" class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($data = mysqli_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['orderID'] ?></td>
                                                        <td><?= $data['customerName'] ?></td>
                                                        <td><?= $data['itemName'] ?></td>
                                                        <td class="text-right"><?= Round($data['quantity']) ?></td>
                                                        <td class="text-right"><?= rupiah(Round($data['price'])) ?></td>
                                                        <!-- <td class="text-right"><?= rupiah($data['quantity'] * $data['price']) ?></td> -->
                                                        <td><?= $data['keterangan'] ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#confirmProduction<?= $i; ?>">
                                                                <button type="button" class="btn btn-success btn-rounded"><i class="fas fa-check"></i> Confirm</button>
                                                            </a>

                                                            <div id="confirmProduction<?= $i ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">

                                                                    <form class="mt-2" action="config/production/addProduction.php" method="POST">

                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Konfirmasi Produksi</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>ID Order</label>
                                                                                    <input type="textbox" class="form-control" name="orderID" value="<?= $data['orderID'] ?>" readonly />
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Nama Customer</label>
                                                                                    <input type="text" class="form-control" name="customerName" value="<?= $data['customerName'] ?>" readonly />
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label hidden>Item ID</label>
                                                                                    <input type="hidden" class="form-control" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label hidden>Item ID</label>
                                                                                    <input type="hidden" class="form-control" name="orderItemID" value="<?= $data['orderItemID'] ?>" />
                                                                                </div>

                                                                                <div class="form-group">
                                                                                <label>Jenis Mebel</label>
                                                                                <select class="form-control" name="type">
                                                                                    <option selected disabled>Pilh Jenis Mebe</option>
                                                                                    <option value="local">Kayu Lokal</option>
                                                                                    <option value="jati">Kayu Jati</option>
                                                                                </select>
                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }

                                                function rupiah($angka)
                                                {

                                                    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                                                    return $hasil_rupiah;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }else{
                                    echo "<h4>Tidak ada Data</h4>";
                                } ?>

                            </div>
                        </div>
                    </div>
                </div>

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
    <?php include 'include/footer_jquery.php' ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#itemDetail").hide();
            $('body').on("change", "#itemID", function() {
                var id = $(this).val();
                var data = "id=" + id;
                $.ajax({
                    type: 'POST',
                    url: "get_item.php",
                    data: data,
                    success: function(hasil) {
                        $("#itemDetail").html(hasil);
                        $("#itemDetail").show();
                    }
                });
            });
        });
    </script>
</body>

</html>