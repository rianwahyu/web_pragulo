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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Karyawan</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Karyawan</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Daftar Karyawan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container-fluid">

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="mt-2" action="config/users/addUsers.php" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Tambah Karyawan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="fullname" autocomplete="off" reqired>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" autocomplete="off" reqired maxlength="10">
                                    </div>
                                    <input type="hidden" value="role" value="Karyawan" />

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

                $query = " SELECT * FROM users WHERE role='karyawan' ";

                $result = mysqli_query($dbc, $query);

                ?>

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Karyawan</h4>
                                <h5 class="card-subtitle">Daftar nama karyawan di pragulo</h5>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Karyawan</button>

                                <div class="table-responsive">
                                    <?php if (mysqli_num_rows($result) >= 1) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Lengkap</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Jabatan</th>
                                                    <th scope="col">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                while ($data = mysqli_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $data['fullname']; ?></td>
                                                        <td><?= $data['username']; ?></td>
                                                        <td><?= $data['role']; ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#updateUser<?= $data['userID']; ?>">
                                                                <button type="button" class="btn btn-info btn-rounded"><i class="far fa-edit"></i> Edit</button>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteUser<?= $data['userID']; ?>">
                                                                <button type="button" class="btn btn-danger btn-rounded"><i class="far fa-trash-alt"></i> Delete</button>
                                                            </a>

                                                            <div id="updateUser<?= $data['userID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">

                                                                    <form class="mt-2" action="config/users/editUsers.php" method="POST">
                                                                        <input type="hidden" name="userID" value="<?= $data['userID'] ?>" />
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Edit Karyawan</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Nama Lengkap</label>
                                                                                    <input type="text" class="form-control" name="fullname" value="<?= $data['fullname'] ?>">
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

                                                            <div id="deleteUser<?= $data['userID'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form action="config/users/deleteUsers.php" method="POST">
                                                                        <input type="hidden" name="userID" value="<?= $data['userID'] ?>" />
                                                                        <div class="modal-content modal-filled bg-danger">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="fill-danger-modalLabel">Hapus Karyawan
                                                                                </h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Apakah anda ingin menghapus karyawan terpilih ?</p>

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

                                                mysqli_close($dbc); ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo "<h4>Data tidak ditemukan</h4>";
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