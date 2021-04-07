<!DOCTYPE html>
<html lang="en">

<head>
    <!--  BAGIAN META -->
    <?php $this->load->view('templates/meta'); ?>

    <!--  JUDUL TAB HALAMAN -->
    <title><?= $title; ?></title>

    <!-- BAGIAN STYLE -->
    <?php $this->load->view('templates/style'); ?>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- BAGIAN SIDEBAR -->
        <?php $this->load->view('templates/sidebar'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- BAGIAN TOPBAR -->
                <?php $this->load->view('templates/topbar'); ?>

                <!-- Page Content -->
                <div class="container-fluid">

                    <div class="row justify-content center">
                        <div class="col-md">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- End of Page Content -->

            </div>
            <!-- End of Main Content -->

            <!-- BAGIAN FOOTER -->
            <?php $this->load->view('templates/footer'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of  Wrapper -->

    <!-- BAGIAN SCRIPT -->
    <?php $this->load->view('templates/script') ?>
    <?php $this->load->view('templates/logout_modal'); ?>


</body>

</html>