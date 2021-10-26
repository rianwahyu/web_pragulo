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
                    <div class="col-md-6 col-sm-12 col-lg-6 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Category</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Pragulo</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Category</li>
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

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="config/category/addCategory" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <h6>Masukkan Nama Kategori</h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="categoryName">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <?php
                include 'config/connection.php';

                $query = "SELECT * FROM `category` WHERE 1";

                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kategori</h4>
                                <h6 class="card-subtitle">Daftar Kategori</h6>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Kategori</button>
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>
                                        <!-- <form action="config/category/downloadExcelCategory.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form> -->


                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Kategori</th>
                                                    <th scope="col">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($myArray as $data) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['categoryName']; ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#updateCategory<?= $data['categoryID']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> Edit</button>
                                                            </a>
                                                            <!-- <a href="#" data-toggle="modal" data-target="#deleteCategory<?= $data['categoryID']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> Delete</button>
                                                            </a> -->
                                                        </td>

                                                        <div id="updateCategory<?= $data['categoryID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form class="mt-2" action="config/category/editCategory" method="POST">
                                                                    <input type="hidden" name="categoryID" value="<?= $data['categoryID'] ?>" />
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">Edit Kategori</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h6>Masukkan Nama Kategori</h6>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" name="categoryName" value="<?= $data['categoryName'] ?>">
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

                                                        <div id="deleteCategory<?= $data['categoryID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/category/deleteCategory" method="POST">
                                                                    <input type="hidden" name="categoryID" value="<?= $data['categoryID'] ?>" />
                                                                    <div class="modal-content modal-filled bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Hapus Kategori
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin menghapus kategori terpilih ?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="button" class="btn btn-outline-light">Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>


                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>



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