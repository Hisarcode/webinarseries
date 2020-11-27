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
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->session->flashdata('message'); ?>

                            <form action="<?= base_url('auth/ubahpassword') ?>" method="POST">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="passwordlama" name="passwordlama" placeholder="Pasword lama...">
                                    <?= form_error('passwordlama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="passwordbaru1" name="passwordbaru1" placeholder="Pasword baru...">
                                    <?= form_error('passwordbaru1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="passwordbaru2" name="passwordbaru2" placeholder="Ulangi pasword baru...">
                                    <?= form_error('passwordbaru2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Ubah Password Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->view('templates/footer'); ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <?php $this->load->view('templates/script') ?>

</body>

</html>