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

                    <a href="<?= base_url('panitia/tambah_webinar/') . $this->session->userdata('id_relawan') ?>" class="mb-3 btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Webinar</span>
                    </a>
                    <?php if ($this->session->flashdata('category_success')) : ?>
                        <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('category_error')) : ?>
                        <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                    <?php endif; ?>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
                    <div class="table-responsive p-1">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Webinar</th>
                                    <th width="20%">Jadwal</th>
                                    <th>Poster</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php $i =  1; ?>

                                <?php foreach ($webinar as $wb) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $wb['webinar_nama']; ?></td>

                                        <?php


                                        $dateTimestamp1 = new DateTime(date('Y-m-d'));
                                        $dateTimestamp2 = new DateTime($wb['tanggal']);
                                        $filter = "";
                                        if ($dateTimestamp1 > $dateTimestamp2) {
                                            $filter = 'style="filter: grayscale(100%)"';
                                        }
                                        ?>

                                        <td><?= date('d F Y', strtotime($wb['tanggal'])); ?> <br> <?= $wb['jam'] ?> WIB</td>
                                        <td style="width:20%;" class="text-center"><img class="img-fluid" src="<?= base_url('upload/webinar/') . $wb['poster']; ?>" <?= $filter ?>></td>
                                        <td>
                                            <a href="<?= base_url() . 'panitia/detail_webinar/' . $wb['webinar_id']; ?>" class="btn btn-warning btn-sm btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">Detail</span>
                                            </a>
                                            <a href="<?= base_url() . 'panitia/edit_webinar/' . $wb['webinar_id']; ?>" class="btn btn-info btn-sm btn-icon-split" onclick="return confirm('Yakin?');">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                            <a href="<?= base_url() . 'panitia/hapus_webinar/' . $wb['webinar_id']; ?>" class="btn btn-danger btn-sm btn-icon-split" onclick="return confirm('Yakin?');">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Hapus</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
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