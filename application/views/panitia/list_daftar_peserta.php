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



                    <?php
                    $total_presensi = 0;
                    foreach ($webinar_peserta as $wp) {
                        if ($wp['is_presence'] == 1) {
                            $total_presensi++;
                        }
                    }
                    ?>


                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs mb-2 font-weight-bold text-primary text-uppercase mb-1">Total Peserta</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_peserta; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs mb-2 font-weight-bold text-info text-uppercase mb-1">Total Presensi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_presensi; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
                    <div class="card mb-4  col-lg-6">
                        <div class="card-header">
                            <h5 class="text-primary font-weight-bold"><?= 'Daftar Peserta ' . $nama_webinar ?></h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">No</th>
                                            <th>Nama Peserta</th>
                                            <th width="12%">Presensi</th>
                                            <th width="12%">Sertifikat</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                        <?php $i =  1; ?>

                                        <?php foreach ($webinar_peserta as $wp) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $wp['nama']; ?></td>
                                                <td class="text-center">
                                                    <?php if ($wp['is_presence'] == 0) { ?>
                                                        <span class="icon text-danger">
                                                            <i class="fas fa-minus-circle"></i>
                                                        </span>

                                                    <?php } else if ($wp['is_presence'] == 1) { ?>
                                                        <span class="icon text-success">
                                                            <i class="fas fa-check-circle"></i>
                                                        </span>

                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($wp['is_certificate'] == 0) { ?>
                                                        <span class="icon text-danger">
                                                            <i class="fas fa-minus-circle"></i>
                                                        </span>

                                                    <?php } else if ($wp['is_certificate'] == 1) { ?>
                                                        <span class="icon text-success">
                                                            <i class="fas fa-check-circle"></i>
                                                        </span>

                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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