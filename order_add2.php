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

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php include 'include/header.php'; ?>

        <?php include 'include/aside.php'; ?>

        <div class="page-wrapper">

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
                </div>
            </div>


            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Data Pesanan</h4>
                                <h6 class="card-subtitle">Mohon mengisi form di bawah ini</h6>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pelanggan</label>
                                            <input type="text" class="form-control" name="customerName" required>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" name="customerAddress">
                                        </div>

                                        <div class="form-group mt-4">
                                            <label>No HP</label>
                                            <input type="text" class="form-control" name="customerPhone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Pesan</label>
                                            <input type="date" class="form-control" name="dateOrder" required>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label>Tanggal Selesai (Estimasi)</label>
                                            <input type="date" class="form-control" name="dateFinish">
                                        </div>

                                        <div class="form-group mt-4">
                                            <label>Metode Pembayaran</label>
                                            <select name="installment" class="form-control">
                                                <option selected disabled>Pilih Metode Pembayaran</option>
                                                <option value="0">Cash</option>
                                                <option value="3">Cicilan 3 Bulan</option>
                                                <option value="6">Cicilan 6 Bulan</option>
                                                <option value="12">Cicilan 12 Bulan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="username" value="<?= $username ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include 'config/connection.php';

                $querys = "SELECT * FROM category ";
                $results = mysqli_query($dbc, $querys);

                ?>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <form method="post" class="form-data" id="form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Form Tambah Barang</h4>
                                    <h6 class="card-subtitle">Tambah pesanan</h6>

                                    <input type="hidden" name="username" value="<?php echo $username ?>" />

                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="itemCat">
                                            <option selected>Pilih Kategori</option>
                                            <option value="mebel">Mebel</option>
                                            <option value="non mebel">Non Mebel</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Jenis Barang</label>
                                        <select class="form-control" name="categoryID" id="categoryID">
                                            <option selected>Pilih Jenis</option>
                                            <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                                <option value="<?= $datas['categoryID'] ?>"><?= $datas['categoryName'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div id="itemID"></div>

                                    <div id="itemDetail"></div>

                                    <div class="form-group">
                                        <button type="button" name="submit" id="Submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-8">
                        <div id="tampil"></div>
                    </div>
                </div>

            </div>

            <!-- <form method="post" class="form-data" id="form-data">
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

              <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
                        <p class="text-danger" id="err_alamat"></p>
                    </div>

                
            </form> -->




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
            $('body').on("change", "#itemIDs", function() {
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

        /* $(document).ready(function() {
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
                    url: "insert.php",
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
        }); */

        $(document).ready(function() {

            $('#tampil').load("tampil.php");

            $("#Submit").click(function() {
                var data = $('#form-data').serialize();
                $.ajax({
                    type: 'POST',
                    url: "insert.php",
                    data: data,
                    cache: false,
                    success: function(data) {
                        $('#tampil').load("tampil.php");
                        //document.getElementById("id").value = "";
                        document.getElementById("form-data").reset();
                        $("#itemDetail").hide();
                        $("#itemID").hide();
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script src="src/customjs.js"></script>
</body>

</html>