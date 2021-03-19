<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/meta'); ?>

    <title><?= $title; ?></title>

    <?php $this->load->view('templates/style'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="jquery.timepicker.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap-datepicker.css" />

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
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <h5 class="my-4 font-weight-bold text-dark">Preview Sertifikat <?= $sertifikat['webinar_nama'] ?></h5>
                            <div class="row">
                                <div class="col-sm col-lg-9">
                                    <div class="container mb-4" style="width:800px;  position: relative;">
                                        <img class="img-fluid shadow-lg mb-4" style="max-width: 80%;" src="<?= base_url('upload/sertifikat/') . $sertifikat['gambar_sertifikat']; ?>">
                                        <div class="centered text-dark" style="position: absolute;top: 42%; left:40%; transform: translate(-50%, -50%);">Hisarman Bijaksana</div>
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary"> Aksi </h6>
                                        </div>
                                        <div class="card-body text-justify">
                                            <a href="<?= base_url('panitia/edit_sertifikat/') . $sertifikat['sertifikat_id'] ?>" class="mb-3 btn btn-info btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text">Ubah Data</span>
                                            </a>
                                            <a href="<?= base_url('panitia/unduh_contoh_sertifikat/') . $sertifikat['sertifikat_id'] ?>" class="mb-3 btn btn-success btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-download"></i>
                                                </span>
                                                <span class="text">Unduh Contoh</span>
                                            </a>
                                            <a href="<?= base_url('panitia/kirim_sertifikat/') .  $sertifikat['sertifikat_id']  ?>" class="mb-3 btn btn-warning btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-download"></i>
                                                </span>
                                                <span class="text">Bagikan</span>
                                            </a>
                                            <a href="<?= base_url('panitia/inputsertifikat') ?>" class="mb-3 btn btn-secondary btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-reply"></i>
                                                </span>
                                                <span class="text">Kembali</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>

            </div>

            <?php $this->load->view('templates/footer'); ?>
            <?php $this->load->view('templates/logout_modal'); ?>
            <?php $this->load->view('templates/script'); ?>
            <script src="<?= base_url('assets/') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets/') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url('assets/')  ?>/js/demo/datatables-demo.js"></script>
        </div>

    </div>
</body>