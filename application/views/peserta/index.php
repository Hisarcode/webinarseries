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

                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <?php if (strpos($user['image'], 'https') !== false) : ?>
                                    <img class="card-img" src="<?= $user['image']; ?>">
                                <?php else : ?>
                                    <img class="card-img" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                                <?php endif; ?>

                            </div>

                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                                    <p class="card-text"><small class="text-muted"><?= $peserta['instansi'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Webinar Mendatang</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Webinar</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">

                                    <?php $no = 1; ?>
                                    <?php foreach ($list_webinar_next as $wp) : ?>

                                        <tr>
                                            <th class="text-center"><?= $no; ?></th>
                                            <th>
                                                <a href="<?= base_url() . 'peserta/detail_webinar/' . $wp['webinar_id']; ?>">
                                                    <?= $wp['webinar_nama'] ?>
                                                </a>
                                            </th>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <?php $this->load->view('templates/footer'); ?>
            <?php $this->load->view('templates/logout_modal'); ?>
            <?php $this->load->view('templates/script'); ?>