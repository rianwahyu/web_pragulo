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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Master Gudang</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Persediaan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Master Gudang</li>
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

                $query = "SELECT a.*, b.categoryName, SUM(COALESCE(c.quantity,0)) as jumlah FROM item a INNER JOIN category b ON a.categoryID=b.categoryID LEFT JOIN warehouse_stock c ON a.itemID=c.itemID WHERE 1 GROUP BY a.itemID";

                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Master Gudang</h4>
                                <h6 class="card-subtitle">Daftar Persediaan Barang di Gudang</h6>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Barang</button> -->
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6>


                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>

                                        <form action="config/item/downloadExcelItem.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <!-- <button type="submit" class="btn btn-success float-right">Download Excel</button> -->
                                        </form>
                                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Jenis</th>
                                                    <th scope="col">Jumlah</th>
                                                    <!-- <th scope="col">Harga</th> -->
                                                    <!-- <th scope="col">Opsi</th> -->
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
                                                        <td><?= $data['categoryName']; ?></td>
                                                        <td><?= $data['jumlah']; ?></td>
                                                        <!-- <td><?= rupiah($data['price']); ?></td> -->
                                                        <!-- <td>
                                                            <a href="#" data-toggle="modal" data-target="#updateItem<?= $data['itemID']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> Edit</button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteItem<?= $data['itemID']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> Delete</button>
                                                            </a>
                                                        </td>

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
                                                            </div>
                                                        </div> -->


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

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script src="src/customjs.js"></script>

</body>

</html>