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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Form Pesanan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Pesanan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Tambah Pesanan</li>
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

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <form method="post" class="form-data" id="form-data">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Item ID</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="itemID" id="itemID" class="form-control" required="true">
                                <p class="text-danger" id="err_itemID"></p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="quantity" id="quantity" class="form-control" required="true">
                                <p class="text-danger" id="err_quantity"></p>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="price" id="price" class="form-control" required="true">
                                <p class="text-danger" id="err_price"></p>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
                        <p class="text-danger" id="err_alamat"></p>
                    </div> -->

                    <div class="form-group">
                        <button type="button" name="simpan" id="simpan" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>

                <div class="data"></div>


            </div>

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <?php
                    include 'config/connection.php';

                    $querys = "SELECT * FROM category ";
                    $results = mysqli_query($dbc, $querys);

                    ?>
                    <form class="mt-2" action="config/order/addTempOrder" method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Tambah Order</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>


                            <div class="modal-body">
                                <input type="hidden" name="username" value="<?php echo $username ?>" />
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="categoryID" id="categoryID">
                                        <option selected>Pilih Kategori</option>
                                        <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                            <option value="<?= $datas['categoryID'] ?>"><?= $datas['categoryName'] ?></option>
                                        <?php } ?>
                                    </select>

                                    <div id="itemID">

                                    </div>

                                    <div id="itemDetail">

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
        // $(document).ready(function() {
        //     $("#itemID").hide();
        //     $('body').on("change", "#categoryID", function() {
        //         var id = $(this).val();
        //         var data = "id=" + id;
        //         $.ajax({
        //             type: 'POST',
        //             url: "get_category.php",
        //             data: data,
        //             success: function(hasil) {
        //                 $("#itemID").html(hasil);
        //                 $("#itemID").show();
        //             }
        //         });
        //     });

        //     $("#itemDetail").hide();
        //     $('body').on("change", "#itemIDs", function() {
        //         var id = $(this).val();
        //         var data = "id=" + id;
        //         $.ajax({
        //             type: 'POST',
        //             url: "get_item.php",
        //             data: data,
        //             success: function(hasil) {
        //                 $("#itemDetail").html(hasil);
        //                 $("#itemDetail").show();
        //             }
        //         });
        //     });
        // });
        $(document).ready(function() {
            $('.data').load("data.php");
            $("#simpan").click(function() {
                var data = $('.form-data').serialize();
                var itemID = document.getElementById("itemID").value;
                var quantity = document.getElementById("quantity").value;
                var price = document.getElementById("price").value;

                if (itemID == "") {
                    document.getElementById("err_itemID").innerHTML = "ITEM ID Harus di isi";
                } else {
                    document.getElementById("err_itemID").innerHTML = "";
                }

                if (quantity == "") {
                    document.getElementById("err_quantity").innerHTML = "QTY Harus di isi";
                } else {
                    document.getElementById("err_quantity").innerHTML = "";
                }

                if (price == "") {
                    document.getElementById("err_price").innerHTML = "price Harus di isi";
                } else {
                    document.getElementById("err_price").innerHTML = "";
                }

                $.ajax({
                    type: 'POST',
                    url: "form_action.php",
                    data: data,
                    success: function() {
                        $('.data').load("data.php");
                        document.getElementById("id").value = "";
                        document.getElementById("form-data").reset();
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });

            });
        });
    </script>
</body>

</html>