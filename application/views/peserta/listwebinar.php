<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/meta'); ?>

    <title><?= $title; ?></title>

    <?php $this->load->view('templates/style'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="<?= base_url('assets/') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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


                    <?php if ($this->session->flashdata('category_success')) : ?>
                        <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('category_error')) : ?>
                        <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                    <?php endif; ?>



                    <div class="tab-content">

                        <div class="tab-pane active" role="tabpanel" id="card">
                            <div class="row justify-content center">


                                <?php foreach ($webinar as $wb) : ?>
                                    <div class="col-md-6 col-lg-4  mb-3">
                                        <div class="card">
                                            <img class="card-img-top" src="<?= base_url('upload/webinar/') . $wb['poster']; ?>" alt="<?= 'Poster ' . $wb['webinar_nama']; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $wb['webinar_nama']; ?></h5>
                                                <p class="card-text"><?= $wb['tanggal']; ?></p>
                                                <a href="<?= base_url() . 'peserta/detail_webinar/' . $wb['webinar_id']; ?>" class="btn btn-info btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-info-circle"></i>
                                                    </span>
                                                    <span class="text">Detail</span>
                                                </a>
                                                <?php if ($wb['is_register'] == 0) : ?>

                                                    <a href="<?= base_url() . 'peserta/registrasi_webinar/' . $wb['webinar_id'] . '/' . $user['id'] ?>" class="btn btn-success btn-icon-split btn-sm" onclick="return confirm('Yakin?');">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text">Ikuti</span>
                                                    </a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->

            </div>

            <?php $this->load->view('templates/footer'); ?>
            <?php $this->load->view('templates/logout_modal'); ?>
            <?php $this->load->view('templates/script'); ?>
            <script src="<?= base_url('assets/') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets/') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url('assets/')  ?>/js/demo/datatables-demo.js"></script>