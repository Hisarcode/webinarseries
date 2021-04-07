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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Webinar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">

                                <?php $no = 1; ?>
                                <?php foreach ($webinar_peserta as $wp) : ?>

                                    <tr>
                                        <th class="text-center"><?= $no; ?></th>
                                        <th><?= $wp['webinar_nama'] ?></th>

                                        <th>
                                            <a href="<?= base_url() . 'peserta/detail_webinar/' . $wp['webinar_id']; ?>" class="btn btn-info btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">Detail</span>
                                            </a>
                                            <a href="<?= base_url() . 'peserta/batal_webinar/' . $wp['webinar_id'] . '/' . $user['id']; ?>" class="btn btn-danger btn-icon-split btn-sm" onclick="return confirm('Yakin?');">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-minus-circle"></i>
                                                </span>
                                                <span class="text">Batal</span>
                                            </a>
                                            <a href="<?= base_url() . 'peserta/sertifikat/' . $wp['webinar_peserta_id']; ?>" class="btn btn-primary btn-icon-split btn-sm" onclick="return confirm('Yakin?');">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-certificate"></i>
                                                </span>
                                                <span class="text">Sertifikat</span>
                                            </a>
                                        </th>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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