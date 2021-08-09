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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Hasil Kerja Karyawan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Karyawan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Hasil Kerja</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>

                <a href="user_list">
                    <button type="button" class="btn waves-effect waves-light btn-warning mt-3">Kembali</button>
                </a>
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

                if(isset($_GET)){
                    $usernameID = $_GET['usernameID'];
                    $fullname = $_GET['fullname'];
                }

                $query = " SELECT DATE_FORMAT(a.date, '%d %m %Y') as date, a.note, a.productionID,  b.fullname, d.itemName FROM timeline a INNER JOIN users b ON a.username = b.username INNER JOIN production c on a.productionID=c.productionID INNER JOIN item d ON c.itemID=d.itemID WHERE a.username='$usernameID' ";

                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Hasil Kerja Karyawan</h4>
                                <h5 class="card-subtitle">Nama Karyawan : <strong><?= $fullname?></strong></h5>
                                
                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            $myArray[] = $data;
                                        } ?>

                                        <form action="config/users/downloadExcelUserJobDesk.php" method="POST" target="_blank">
                                            <input type="hidden" name="myArray" value="<?php echo htmlentities(serialize($myArray)); ?>" />
                                            <input type="hidden" name="usernameID" value="<?= $usernameID ?>" />
                                            <input type="hidden" name="fullname" value="<?= $fullname ?>" />
                                            <button type="submit" class="btn btn-success float-right">Download Excel</button>
                                        </form>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">ID Produksi</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $jenisMebel="";
                                                $i = 1;
                                                foreach($myArray as $data) {
                                                    
                                                    ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['date']; ?></td>
                                                        <td><?= $data['productionID']; ?></td>
                                                        <td><?= $data['itemName']; ?></td>
                                                        <td><?= $data['note']; ?></td>
                                                        <td>
                                                            <!-- <a href="production_list_detail?productionID=<?= $data['productionID'] ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="fas fa-eye"></i> Detail</button>
                                                            </a> -->
                                                        </td>
                                                    </tr>
                                                <?php }

                                                mysqli_close($dbc); ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo "<h4>Data tidak ditemukan</h4>";
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
            </div>
            <?php include 'include/footer.php'; ?>
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