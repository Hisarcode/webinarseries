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
                            <h3 class="my-4 font-weight-bold text-dark"><?= $webinar['webinar_nama'] ?></h3>
                            <div class="row">
                                <div class="col-sm col-lg-8">
                                    <div class="mb-4" style="width:600px;">
                                        <img class="img-fluid shadow-lg ml-lg-5 mb-4" style="max-width: 80%;" src="<?= base_url('upload/webinar/') . $webinar['poster']; ?>">
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
                                            <?php if ($is_register == 0) { ?>
                                                <form action="<?= base_url() ?>peserta/registrasi_webinar" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="user_id" id="user_id" value="<?= $user['id'] ?>">
                                                    <input type="hidden" name="webinar_id" id="webinar_id" value="<?= $webinar['webinar_id'] ?>">

                                                    <button class="mb-3 btn btn-info btn-block">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-pen"></i>
                                                        </span>
                                                        <span class="text">Ikuti Webinar</span>
                                                    </button>
                                                </form>
                                            <?php } else { ?>

                                                <h6 class="m-0 font-weight-bold text-dark mb-3"> Anda telah terdaftar </h6>
                                                <a href="<?= base_url() . 'peserta/batal_webinar/' . $webinar['webinar_id'] . '/' . $user['id']; ?>" class="mb-3 btn btn-danger btn-block" onclick="return confirm('Yakin?');">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Batal</span>
                                                </a>

                                            <?php }; ?>

                                            <a href="<?= base_url('peserta/listwebinar') ?>" class="mb-3 btn btn-secondary  btn-block">
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