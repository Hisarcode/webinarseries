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
                    <a href="<?= base_url('panitia/tambah_inputsertifikat/') ?>" class="mb-3 btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Input Sertifikat</span>
                    </a>
                    <?php if ($this->session->flashdata('category_success')) : ?>
                        <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('category_error')) : ?>
                        <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                    <?php endif; ?>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <?php if (empty($sertifikat)) {; ?>
                                <div class="alert alert-danger" role="alert"> Data tidak ada </div>
                                <?php var_dump($sertifikat); ?>
                            <?php } else {; ?>


                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th>Nama Webinar</th>
                                        <th width="50%">Gambar Sertifikat</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">
                                    <?php $i =  1; ?>

                                    <?php foreach ($sertifikat as $se) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $se['webinar_nama']; ?></td>

                                            <td class="text-center"><img class="img-fluid" src="<?= base_url('upload/sertifikat/') . $se['gambar_sertifikat']; ?>"></td>

                                            <td>
                                                <a href="<?= base_url() . 'panitia/detail_sertifikat/' . $se['sertifikat_id']; ?>" class="btn btn-warning btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                    <span class="text">Lihat</span>
                                                </a>
                                                <a href="<?= base_url() . 'panitia/edit_sertifikat/' . $se['sertifikat_id']; ?>" class="btn btn-info btn-icon-split btn-sm" onclick="return confirm('Yakin?');">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-pen"></i>
                                                    </span>
                                                    <span class="text">Ubah</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            <?php }; ?>

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