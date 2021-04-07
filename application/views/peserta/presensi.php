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
                            <thead>
                                <tr>
                                    <th>Nama Webinar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">

                                <?php foreach ($webinar_peserta as $wp) : ?>

                                    <tr>
                                        <td><a href="<?= base_url() . 'peserta/detail_webinar/' . $wp['webinar_id'] ?>"><?= $wp['webinar_nama'] ?></a></td>
                                        <td><?php echo ($wp['is_presence'] ==  1) ? "Sudah Presensi" : "Belum Presensi"; ?></td>
                                        <td>
                                            <?php if ($wp['is_presence'] == 0) { ?>
                                                <a href=" <?= base_url() . 'peserta/presensi_peserta/' . $wp['webinar_peserta_id']; ?>" class="btn btn-primary btn-icon-split btn-sm">
                                                    <span class="icon">
                                                        <i class="fas fa-check-circle"></i>
                                                    </span>
                                                    <span class="text">Presensi Webinar</span>
                                                </a>
                                            <?php } else if ($wp['is_presence'] == 1) { ?>
                                                <span class="icon text-success">
                                                    <i class="fas fa-check-circle"></i>
                                                </span>

                                            <?php } ?>

                                        </td>
                                    </tr>
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