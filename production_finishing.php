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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Produksi</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Lit Produksi</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Proses Finishing</li>
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
                                    <strong>Sukses - </strong> Sukses mengubah status produksi
                                </div>'; ?>

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php

                if (isset($_GET)) {
                    // $key = $_GET['key'];
                    $status = $_GET['status'];
                }
                ?>
                <div class="row">

                    <?php
                    include 'config/connection.php';

                    $query = "SELECT a.timelineID, b.orderID, a.productionID, b.itemID, c.itemName, e.fullname, a.note, DATE_FORMAT(a.date, '%Y-%m-%d') as date, DATE_FORMAT(a.dateFinish, '%Y-%m-%d') as dateFinish, a.prodStat
                    FROM timeline a 
                    INNER JOIN production b ON a.productionID=b.productionID 
                    INNER JOIN item c ON b.itemID = c.itemID
                    INNER JOIN orders d ON b.orderID = d.orderID
                    INNER JOIN users e ON a.username=e.username
                    WHERE a.status='Finishing' ";
                    $result = mysqli_query($dbc, $query);

                    ?>

                    <div class="col-sm-12 col-md-10 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Proses Produksi</h4>
                                <h6 class="card-subtitle">Proses Finishing</h6>

                                <?php
                                if ($status == "true") {
                                    echo $successInsert;
                                }
                                ?>

                                <?php if (mysqli_num_rows($result) > 0) {  ?>
                                    <div class="table-responsive mt-4">
                                        <table id="zero_config" class="table table-striped table-bordered no-wrap" style="width: 100%;">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">ID Order</th>
                                                    <th class="text-center">Id Produksi</th>
                                                    <th class="text-center">Nama Barang</th>
                                                    <th class="text-center">Nama Tukang</th>
                                                    <th class="text-center">Tgl Proses</th>
                                                    <th class="text-center">Tgl Finishing</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($data = mysqli_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $data['orderID']; ?></td>
                                                        <td><?= $data['productionID']; ?></td>
                                                        <td><?= $data['itemName']; ?></td>
                                                        <td><?= $data['fullname']; ?></td>
                                                        <td><?= $data['date']; ?></td>
                                                        <td><?= $data['dateFinish']; ?></td>
                                                        <td><?php echo ($data['prodStat'] == 1) ? 'Selesai' : 'Dikerjakan'; ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#confirmProduction<?= $i; ?>">
                                                                <button type="button" class="btn btn-success btn-rounded btn-sm"><i class="fas fa-check"></i>Selesai</button>
                                                            </a>
                                                        </td>

                                                        <div id="confirmProduction<?= $i ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">

                                                                <form class="mt-2" action="config/production/updateProduction.php" method="POST">

                                                                    <input type="hidden" value="<?= $username ?>" name="username" />
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">Konfirmasi Proses Produksi</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda ingin mengkonfirmasi proses <strong>Pemasangan Jog</strong> selesai dan melanjutkan ke proses selanjutnya ?</p>

                                                                            <input type="hidden" class="form-control" name="itemID" value="<?= $data['itemID'] ?>" />

                                                                            <input type="hidden" class="form-control" name="orderItemID" value="<?= $data['orderItemID'] ?>" />

                                                                            <?php
                                                                            $query2 = "SELECT username, fullname FROM users WHERE role='karyawan' ";
                                                                            $result2 = mysqli_query($dbc, $query2);
                                                                            ?>

                                                                            <div class="form-group">
                                                                                <label>Pilih Tukang</label>
                                                                                <select class="form-control" name="tukang" required>
                                                                                    <option selected disabled>Pilih Nama Tukang</option>
                                                                                    <?php while ($datas = mysqli_fetch_array($result2)) { ?>

                                                                                        <option value="<?= $datas['username'] ?>"><?= $datas['fullname'] ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Pilih Proses</label>
                                                                                <select class="form-control" name="proses" required>
                                                                                    <option value="Finishing">Finishing</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Keterangan Proses</label>
                                                                                <textarea style="width:100%; height:80px;" cols="42" rows="5" name="note"></textarea>
                                                                            </div>

                                                                            <input type="hidden" name="itemID" value="<?= $data['itemID'] ?>" />
                                                                            <input type="hidden" name="orderID" value="<?= $data['orderID'] ?>" />
                                                                            <input type="hidden" name="productionID" value="<?= $data['productionID'] ?>" />
                                                                            <input type="hidden" name="timelineID" value="<?= $data['timelineID'] ?>" />

                                                                            <input type="hidden" name="pageName" value="production_pemasangan_jog" />


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </tr>
                                                <?php }


                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                } else {
                                    echo "<h4>Tidak ada Data</h4>";
                                }
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