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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Pembelian</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Pembelian</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Barang Non Mebel</li>
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

                $query = "SELECT a.id, a.itemID, b.itemName, b.itemDescription, a.quantity, a.status, a.datePurchase, a.type, c.categoryName 
                FROM purchase a 
                INNER JOIN item b ON a.itemID=b.itemID  
                INNER JOIN category c ON b.categoryID = c.categoryID
                WHERE a.type='non mebel'  ";

                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pembelian</h4>
                                <h6 class="card-subtitle">Pembelian Barang Non Mebel</h6>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Pembelian</button>
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>
                                        <form action="config/order/downloadExcelOrderList.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <button type="submit" class="btn btn-success float-right" disabled>Download Excel</button>
                                        </form>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Jenis Barang</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($myArray as $data) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['itemName']; ?></td>
                                                        <td><?= $data['itemDescription']; ?></td>
                                                        <td><?= $data['quantity']; ?></td>
                                                        <td><?= $data['status']; ?></td>
                                                        <td><?= $data['datePurchase']; ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#checkItem<?= $data['id']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded" <?php if ($data['status'] == "Available") {
                                                                                                                            echo 'disabled';
                                                                                                                        } ?>><i class="fas fa-check"></i>Sudah Ada</button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#updateItem<?= $data['id']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded" <?php if ($data['status'] == "Available") {
                                                                                                                            echo 'disabled';
                                                                                                                        } ?>><i class="fas fa-check"></i>Edit</button>
                                                            </a>
                                                        </td>

                                                        <div id="checkItem<?= $data['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/purchase/purchaseConfirmation.php" method="POST">
                                                                    <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                                                    <div class="modal-content modal-filled bg-info">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Konfirmasi Barang
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin konfirmasi ketersediaan barang yang sudah di beli akan di teruskan ke Gudang ?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-outline-light">Konfirmasi</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>

                                                        <div id="updateItem<?= $data['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form class="mt-2" action="config/purchase/updatePurchase.php" method="POST">
                                                                    <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                                                    <input type="hidden" name="type" value="<?= $data['type'] ?>" />
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">Edit & Detail Pembelian</h4>
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
                                                                                <label>Jumlah</label>
                                                                                <input type="number" class="form-control" name="quantity" value="<?= $data['quantity'] ?>" onkeypress="return isNumberKey(event)">
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

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <?php
                    include 'config/connection.php';

                    $querys = "SELECT categoryID, categoryName FROM category ";
                    $results = mysqli_query($dbc, $querys);

                    ?>
                    <form class="mt-2" action="config/purchase/addPurchase.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Tambah Pembelian</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="username" value="<?php echo $username ?>" />

                                <div class="form-group">
                                    <label>Jenis Barang</label>
                                    <select class="js-example-basic-single2" name="categoryID" id="categoryID" style="width: 100%;">
                                        <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                            <option value="<?= $datas['categoryID'] ?>"><?= $datas['categoryName'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div id="itemID">

                                </div>

                                <div id="itemDetail">

                                </div>

                                <input type="hidden" name="type" value="non mebel" />


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Simpan Pembelian</button>
                            </div>
                        </div>
                    </form>

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
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php include 'include/footer_jquery.php'; ?>

    <script type="text/javascript">
        $("#itemID").hide();
        $('body').on("change", "#categoryID", function() {
            var id = $(this).val();
            var data = "id=" + id;
            $.ajax({
                type: 'POST',
                url: "get_category.php",
                data: data,
                success: function(hasil) {
                    $("#itemID").html(hasil);
                    $("#itemID").show();
                }
            });
        });
        $("#itemDetail").hide();
        $('body').on("change", "#itemID", function() {
            var id = $(this).val();
            var data = "id=" + id;
            $.ajax({
                type: 'POST',
                url: "get_item3.php",
                data: data,
                success: function(hasil) {
                    $("#itemDetail").html(hasil);
                    $("#itemDetail").show();
                }
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $(document).ready(function() {
            $('.js-example-basic-single2').select2();
        });
    </script>

    <script src="src/customjs.js"></script>
</body>

</html>