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
                        <form method="POST" action="config/order/addOrder.php" enctype="multipart/form-data">
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
                                                <select name="payType" class="form-control" id="payType" required>
                                                    <option selected disabled>Pilih Metode Pembayaran</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cicilan">Cicilan</option>
                                                </select>
                                            </div>

                                            <div class="form-row" id="cicilan" style="display: none">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pilih Periode Cicilan</label>
                                                        <input type="text" class="form-control text-rigth" onkeypress="return isNumberKey(event)" placeholder="Periode Cicilan" name="installment" id="installment" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nominal Uang Muka (DP)</label>
                                                        <input type="text" class="form-control text-rigth" onkeypress="return isNumberKey(event)" placeholder="Nominal DP" name="DP" id="DP" />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="username" value="<?= $username ?>" />
                                            <button class="btn btn-success float-rigth" type="submit" name="submit">Submit Data</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                include 'config/connection.php';

                $querys = "SELECT * FROM category ";
                $results = mysqli_query($dbc, $querys);


                $querysNonMebel = "SELECT a.itemID, a.itemName FROM item a LEFT JOIN store_stock b ON a.itemID=b.itemID WHERE b.itemType='non mebel' GROUP BY a.itemID ";
                $resultsNon = mysqli_query($dbc, $querysNonMebel);

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
                                        <select class="form-control" name="itemCat" id="itemCat" required>
                                            <option selected disabled>Pilih Kategori</option>
                                            <option value="mebel">Mebel</option>
                                            <option value="non mebel">Non Mebel</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="jenis_barang_group" name="jenis_barang_group" style="display: none">
                                        <label>Jenis Barang</label>
                                        <select class="form-control" name="categoryID" id="categoryID" required>
                                            <option selected>Pilih Jenis</option>
                                            <?php while ($datas = mysqli_fetch_array($results)) { ?>
                                                <option value="<?= $datas['categoryID'] ?>"><?= $datas['categoryName'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group" id="non_mebel_group" name="non_mebel_group" style="display: none">
                                        <label>Nama Barang</label>
                                        <select class="form-control" name="itemIDNon" id="itemIDNon" required>
                                            <option selected>Nama Barang</option>
                                            <?php while ($datasNon = mysqli_fetch_array($resultsNon)) { ?>
                                                <option value="<?= $datasNon['itemID'] ?>"><?= $datasNon['itemName'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div id="itemID"></div>

                                    <div id="itemDetail"></div>

                                    <div id="itemDetail2"></div>

                                    <div id="itemDetailNon"></div>

                                    <div id="error"></div>

                                    <div class="form-group">
                                        <button type="button" name="submit" id="Submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Tambah Data
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
        $('#itemCat').change(function(e) {
            //$('#jenis_barang_group').hide();
            var selectedVal = $("#itemCat option:selected").val();
            if (selectedVal == 'mebel') {
                $('#jenis_barang_group').show();
                $('#non_mebel_group').hide();
                $("#categoryID").prop('required', true);
                $('#itemDetailNon').hide();
            } else if (selectedVal == 'non mebel') {
                $('#jenis_barang_group').hide();
                $('#non_mebel_group').show();
                $("#itemIDNon").prop('required', true);
                $('#itemID').hide();
                $('#itemDetail').hide();
            }
        });

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

            $("#itemDetail2").hide();
            $('body').on("change", "#itemtypes", function() {
                var type = $(this).val();
                var itemID = $("#itemIDs").val();
                //var data = "id=" + id;
                $.ajax({
                    type: 'POST',
                    url: "get_item_warehouse.php",
                    data: {
                        type: type,
                        itemID: itemID
                    },
                    success: function(hasil) {
                        $("#itemDetail2").html(hasil);
                        $("#itemDetail2").show();
                    }
                });
            });


            $("#itemID").hide();
            $('body').on("change", "#itemIDNon", function() {
                var id = $(this).val();
                var data = "id=" + id;
                $.ajax({
                    type: 'POST',
                    url: "get_itemNon.php",
                    data: data,
                    success: function(hasil) {
                        $("#itemDetailNon").html(hasil);
                        $("#itemDetailNon").show();
                    }
                });
            });
        });

        $('#payType').change(function(e) {
            $("#cicilan").hide();
            var selectedVal = $("#payType option:selected").val();
            if (selectedVal == 'Cash') {                
                $('#cicilan').hide();
            }else{
                $('#cicilan').show();
                $("#installment").prop('required', true);
                $("#DP").prop('required', true);
            }
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
                        $("#itemDetailNon").hide();
                        $("#jenis_barang_group").hide();
                        $("#non_mebel_group").hide();

                        // $("#error").html(data);
                        // $("#error").show();
                    },
                    error: function(data) {
                        $("#error").html(data);
                        $("#error").show();
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