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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Penerimaan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Transaksi</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Tambah Receive / Penerimaan</li>
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
                <form action="config/receive/addReceive.php" method="POST">
                    <div class="row">


                        <?php

                        include 'config/connection.php';
                        $query = "SELECT a.*, b.itemName FROM temp_receive a INNER JOIN item b ON a.itemID=b.itemID WHERE a.user='$username'";
                        //echo $query;
                        $result = mysqli_query($dbc, $query);

                        ?>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daftar Barang</h4>
                                    <h6 class="card-subtitle">Daftar barang pesanan</h6>

                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">Tambah Barang</button>

                                    <div class="table-responsive mt-4">
                                        <table class="table table-bordered" style="width: 100%;">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Nama Barang</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($data = mysqli_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>

                                                        <td><?= $data['itemName'] ?></td>
                                                        <td class="text-right"><?= Round($data['quantity']) ?></td>
                                                        <td><?= $data['keterangan'] ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#updateOrder<?= $data['id']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> Edit</button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteOrder<?= $data['id']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> Delete</button>
                                                            </a>

                                                            <div id="updateOrder<?= $data['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">

                                                                    <form class="mt-2" action="config/receive/editTempReceive.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Banyaknya</label>
                                                                                    <input type="text" class="form-control" name="quantity" value="<?= round($data['quantity']) ?>" />
                                                                                </div>


                                                                                <div class="form-group">
                                                                                    <label>Keterangan</label>
                                                                                    <input type="text" class="form-control" name="keterangan" value="<?= $data['keterangan'] ?>" />
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

                                                            <div id="deleteOrder<?= $data['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form action="config/receive/deleteTempReceive.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?= $data['id'] ?>" />
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
                                                            </div>

                                                        </td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <input type="hidden" value="<?= $username?>" name="username"/>
                                <div class="card-footer">
                                    <div class="col text-right mt-8">
                                        <button type="submit float-right" class="btn btn-primary">Simpan Receive</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <?php
                    include 'config/connection.php';

                    $querys = "SELECT * FROM category ";
                    $results = mysqli_query($dbc, $querys);

                    ?>
                    <form class="mt-2" action="config/receive/addTempReceive.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Daftar Barang</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>


                            <div class="modal-body">
                                <input type="hidden" name="username" value="<?php echo $username ?>" />
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select class="form-control" name="categoryID" id="categoryID">
                                        <option selected>Pilih Kategori</option>
                                        <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                            <option value="<?= $datas['categoryID'] ?>"><?= $datas['categoryName'] ?></option>
                                        <?php } ?>
                                    </select>

                                    <div id="itemID">

                                    </div>

                                    <div id="itemDetails">

                                    </div>
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
                    url: "get_item2.php",
                    data: data,
                    success: function(hasil) {
                        $("#itemDetails").html(hasil);
                        $("#itemDetails").show();
                    }
                });
            });

        });
    </script>
</body>

</html>