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

                    <!-- ISI DISINI -->


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

</body>

</html>