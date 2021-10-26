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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Master Barang</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Pragulo</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Master Barang</li>
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
                        <?php
                        include 'config/connection.php';

                        $query = "SELECT * FROM category ";
                        $result = mysqli_query($dbc, $query);

                        ?>
                        <form class="mt-2" action="config/item/addItem" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Tambah Barang</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" name="itemName">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Deskripsi Barang</label>
                                        <input type="text" class="form-control" name="itemDescription">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Jenis Barang</label>
                                        <select class="form-control js-example-basic-single" name="categoryID" style="width: 100%;">

                                            <?php while ($data = mysqli_fetch_array($result)) { ?>
                                                <option value="<?= $data['categoryID'] ?>"><?= $data['categoryName'] ?> (Mebel) </option>

                                            <?php } ?>

                                            <option value="0">Non Mebel</option>

                                        </select>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" name="price" id="rupiah1" required>
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

                $query = "SELECT * FROM (SELECT a.*, b.categoryName FROM `item` a 
                INNER JOIN category b ON a.categoryID=b.categoryID 
                UNION ALL 
                SELECT *, 'Non Mebel' as categoryName FROM item WHERE categoryID='0' ) a GROUP BY itemID ";

                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Master Barang</h4>
                                <h6 class="card-subtitle">Daftar Master Barang</h6>
                                <p>Master Barang di sini sangat berpengaruh ke seluruh transaksi pada sistem ini jadi mohon untuk memperhatikan lagi dalam memilih jenis barang dan juga kategori barang tersebut.</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Barang</button>
                                <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i></h6>


                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>

                                        <form action="config/item/downloadExcelItem.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">Jenis Barang</th>
                                                    <th scope="col">Harga</th>
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
                                                        <td><?= $data['type']; ?></td>
                                                        <td><?= $data['categoryName']; ?></td>
                                                        <td class="text-right"><?= rupiah($data['price']); ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#updateItem<?= $data['itemID']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i></button>
                                                            </a>

                                                            <?php
                                                            if ($data['active'] == "1") { ?>
                                                                <a href="#" data-toggle="modal" data-target="#deleteItem<?= $data['itemID']; ?>">
                                                                    <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-eye-slash"></i></button>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="#" data-toggle="modal" data-target="#unHideItem<?= $data['itemID']; ?>">
                                                                    <button type="button" class="btn btn-primary btn-rounded"><i class="fas fa-eye"></i></button>
                                                                </a>
                                                            <?php }
                                                            ?>


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

                                                                                    <option value="0" <?php if ($data['categoryID'] == "0") echo 'selected="selected"'; ?>>Non Mebel</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group mt-2">
                                                                                <label>Harga</label>
                                                                                <input type="text" class="form-control" name="price" value="<?= $data['price'] ?>" > 
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
                                                                <form action="config/item/hideItem.php" method="POST">
                                                                    <input type="hidden" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                    <div class="modal-content modal-filled bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Sembunyikan Barang
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin menyembunyikan barang terpipih ?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-outline-light">Sembunyikan</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>

                                                        <div id="unHideItem<?= $data['itemID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="config/item/unHideItem.php" method="POST">
                                                                    <input type="hidden" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                    <div class="modal-content modal-filled bg-primary">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="fill-danger-modalLabel">Tamplikan Barang
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin menampilkan barang terpipih ?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-outline-light">Tampilkan</button>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script src="src/customjs.js"></script>
    <script src="src/customRupiah.js"></script>

    <script>
        $(document).ready(function() {
            var rupiah = document.getElementById("rupiah");
            rupiah.addEventListener("keyup", function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, "Rp. ");
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
            }

        })
    </script>

</body>

</html>