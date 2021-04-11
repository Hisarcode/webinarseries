<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/if_new_ico.gif') ?>" />
    <meta name="description" content="Infomatika Webinar Series">
    <meta name="author" content="Informatika Untan">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <title><?= $webinar['webinar_nama'] ?></title>
    <!-- custom style -->
    <style>
        .fw600 {
            font-weight: 600;
        }

        .navbar-brand img {
            height: 40% !important;
            width: 40% !important;
        }
    </style>
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <!-- NavBar hehe -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="border-bottom: 1px solid #dee2e6 !important">
        <div class="container">
            <a class="navbar-brand text-uppercase fs-4 fw-bold d-flex" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/Webinar Series Biru.png') ?>" alt="Informatics Webinar Series" class="d-none d-md-flex">
                <span class="d-md-none text-primary">Webinar Series</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                    <li class="nav-item d-sm-block d-md-none my-2">
                        <a class="btn btn-outline-secondary w-100" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item d-sm-block d-md-none my-2">
                        <a class="btn btn-outline-secondary w-100" href="<?= base_url('auth') ?>">Login</a>
                    </li>
                    <li class="nav-item d-sm-block d-md-none">
                        <a class="btn btn-block btn-primary w-100" href="<?= base_url('auth/registrasi') ?>">Register</a>
                    </li>
                </ul>
                <div class="d-none d-md-flex">
                    <div class='p-sm-1 p-md-2'>
                        <a class="btn btn-outline-secondary text-uppercase" href="<?= base_url('/') ?>">Home</a>
                    </div>
                    <div class='p-sm-1 p-md-2'>
                        <a class="btn btn-outline-secondary text-uppercase" href="<?= base_url('auth') ?>">Login</a>
                    </div>
                    <div class="p-sm-1 p-md-2">
                        <a class="btn btn-primary text-uppercase" href="<?= base_url('auth/registrasi') ?>">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->
    <!-- Hero Section -->
    <section id="hero" class="mt-3">
        <div class="container">

            <div class="card shadow mt-5 mb-4">

                <div class="p-4 mb-5 card-body ">
                    <center>
                        <h3 class="my-4 font-weight-bold  text-dark"><?= $webinar['webinar_nama'] ?></h3>
                    </center>
                    <div class="row">
                        <div class="col-sm col-lg-8">
                            <div class="mb-4" style="width:600px;">
                                <img class="img-fluid shadow-lg mx-auto mb-4" style="max-width: 80%;" src="<?= base_url('upload/webinar/') . $webinar['poster']; ?>">
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary"> Deskripsi Webinar </h6>
                                </div>
                                <div class="card-body">
                                    <p class="font-weight-bold text-dark text-justify"><?= $webinar['deskripsi'] ?></p>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary"> Narasumber </h6>
                                </div>
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-dark"><?= $webinar['narasumber'] ?></h6>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary"> Waktu </h6>
                                </div>
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-dark"><?= date('d F Y', strtotime($webinar['tanggal']));  ?> , <?= $webinar['jam'] ?> WIB</h6>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary"> Media </h6>
                                </div>
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-dark"><?= $webinar['media_nama'] ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary"> Aksi </h6>
                                </div>
                                <div class="card-body text-justify">
                                    <a href="<?= base_url('auth/') ?>" class="mb-3 btn btn-info btn-block">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                        <span class="text">Ikuti Webinar</span>
                                    </a>
                                    <a href="<?= base_url('/') ?>" class="mb-3 btn btn-secondary btn-block">
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
    </section>

    <?php $this->load->view('templates/footer'); ?>
    <div class="mb-5"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url('assets/') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/')  ?>/js/demo/datatables-demo.js"></script>


</body>

</html>