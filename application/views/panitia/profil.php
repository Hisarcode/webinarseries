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

                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <h3 class="my-4 font-weight-bold text-dark">Profil Panitia</h3>
                            <div class="row">
                                <div class="col-sm col-lg-8">
                                    <div class="mb-4" style="width:600px;">
                                        <img class="img-fluid shadow-lg ml-lg-5 mb-4" style="max-width: 80%;" src="<?= base_url('assets/img/profile/') . $user['image'];  ?>">
                                    </div>
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary"> Nama </h6>
                                        </div>
                                        <div class="card-body pb-2">
                                            <h6 class="font-weight-bold text-dark text-justify"><?= $user['nama'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary"> Email </h6>
                                        </div>
                                        <div class="card-body pb-2">
                                            <h6 class="font-weight-bold text-dark"><?= $user['email'] ?></h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary"> Aksi </h6>
                                        </div>
                                        <div class="card-body text-justify">
                                            <a href="<?= base_url('panitia/edit_profil') ?>" class="mb-3 btn btn-info btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text">Ubah Profil</span>
                                            </a>
                                            <a href="<?= base_url() . 'auth/ubahpassword' ?>" class="mb-3 btn btn-danger btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-key"></i>
                                                </span>
                                                <span class="text">Ubah Password</span>
                                            </a>
                                            <a href="<?= base_url('panitia') ?>" class="mb-3 btn btn-secondary  btn-block">
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
                <?php $this->load->view('templates/footer'); ?>
                <?php $this->load->view('templates/logout_modal'); ?>
                <?php $this->load->view('templates/script'); ?>