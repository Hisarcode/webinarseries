<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/meta'); ?>

    <title><?= $title; ?></title>

    <?php $this->load->view('templates/style'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('templates/sidebar'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php $this->load->view('templates/topbar'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row ml-2">
                        <a href="<?= base_url('menu') ?>" class="btn btn-primary mb-3">Konfigurasi Menu</a>
                    </div>

                    <div class="row ml-2">
                        <a href="<?= base_url('menu/submenu') ?>" class="btn btn-primary mb-3">Konfigurasi Submenu</a>
                    </div>

                </div>

            </div>
            <!-- End of Main Content -->
            <?php $this->load->view('templates/footer'); ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <?php $this->load->view('templates/script') ?>

</body>

</html>