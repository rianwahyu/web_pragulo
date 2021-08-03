<?php include 'include/head.php';?>

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
        <?php include 'include/header.php';?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'include/aside.php';?>
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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Form Inputs</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
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
            <?php 
            include 'config/connection.php';

            $query = "SELECT * FROM category ";
            $result = mysqli_query($dbc, $query);

            ?>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Tambah Barang</h4>
                                <h6 class="card-subtitle">Mohon mengisi form di bawah ini</h6>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="form-group mt-4">
                                        <label>Deskripsi Barang</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="form-group mt-4">
                                        <label>Deskripsi Barang</label>
                                        <select class="form-control">
                                            <?php while($data = mysqli_fetch_array($result)) { ?>
                                                <option value="<?=$data['categoryID']?>"><?=$data['categoryName']?></option>
                                            <?php }?>
                                            
                                        </select>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Input With Helper Text</h4>
                                <form class="mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nametext" aria-describedby="name"
                                            placeholder="Name">
                                        <small id="name" class="form-text text-muted">Helper Text</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Password</h4>
                                <form class="mt-5">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="passtext"
                                            placeholder="Password">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Disabled Input</h4>
                                <h6 class="card-subtitle">Add attribute <code>disabled</code> to disable input field.
                                </h6>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nametext1" placeholder="Name"
                                            disabled>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Predefined Input Value</h4>
                                <h6 class="card-subtitle">Add attribute <code>value="VALUE"</code> to set predefined
                                    value.</h6>
                                <form class="mt-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="prenametext" value="Name">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Readonly Input Field</h4>
                                <h6 class="card-subtitle">Add attribute <code>readonly</code> to set field readonly.
                                </h6>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="readonly"
                                            placeholder="Readonly Text" readonly>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Input With Placeholder</h4>
                                <h6 class="card-subtitle">Add attribute <code>placeholder="..."</code> to input area.
                                </h6>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="placeholder"
                                            placeholder="Placeholder Text">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Maximum Value</h4>
                                <h6 class="card-subtitle">Add attribute <code>maxlength="6"</code> to input area.</h6>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" maxlength="6" id="maxval"
                                            aria-describedby="maxval" placeholder="Name">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Minimum Value</h4>
                                <h6 class="card-subtitle">Add attribute <code>minlength="5"</code> to input area.</h6>
                                <form class="mt-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" minlength="5" id="minval"
                                            aria-describedby="minval" placeholder="Name">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
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
            <?php include 'include/footer.php';?>
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
   <?php include 'include/footer_jquery.php'?>
</body>

</html>