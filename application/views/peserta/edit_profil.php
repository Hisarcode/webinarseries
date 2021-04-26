<!DOCTYPE html>
<html lang="en">
<!-- Betulkan script dan link, tampilan -->
<!-- jam , tanggal belum betul -->

<head>
    <?php $this->load->view('templates/meta'); ?>

    <title><?= $title; ?></title>

    <?php $this->load->view('templates/style'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />
    <link rel="stylesheet" type="text/css" href="https://www.jonthornton.com/jquery-timepicker/jquery.timepicker.css" />

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

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Data Profil Peserta</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="email">Email : </label>
                                    <input type="text" class="form-control mb-2" value="<?= $peserta['email'] ?>" id="email" name="email" readonly>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('email') ?>
                                    </div>
                                </div>
                                <input type="hidden" value="<?= $peserta['id'] ?>" id="user_id" name="user_id">
                                <input type="hidden" value="<?= $peserta['image'] ?>" id="old_image" name="old_image">
                                <div class="form-group">
                                    <label for="nama">Nama : </label>
                                    <input type="text" class="form-control mb-2" value="<?= $peserta['nama'] ?>" id="nama" name="nama">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nama') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="instansi">Instansi : </label>
                                    <input type="text" class="form-control mb-2" value="<?= $peserta['instansi'] ?>" id="instansi" name="instansi">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('instansi') ?>
                                    </div>
                                </div>



                                <div class="form-group mb-2">
                                    <label for="fotoprofil">Foto Profil : </label>
                                    <input type="file" name="fotoprofil" id="fotoprofil">
                                </div>

                                <img src="<?= base_url('assets/img/profile/') . $peserta['image'];  ?>" class="mb-2 img-fluid col-lg-6" style="margin-left:-10px" height="auto">
                                <br>
                                <a href="<?= base_url('peserta/profil') ?>" class="btn btn-secondary btn-user">Batal</a>
                                <button type="submit" class="btn btn-primary">Edit Profil</button>
                            </form>

                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>

            </div>

            <?php $this->load->view('templates/footer'); ?>
            <?php $this->load->view('templates/logout_modal'); ?>
            <?php $this->load->view('templates/script'); ?>
            <script src="https://www.jonthornton.com/jquery-timepicker/jquery.timepicker.js"></script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

            <script src="<?= base_url('assets') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url('assets') ?>/js/demo/datatables-demo.js"></script>


            <script src="<?= base_url('assets') ?>/date/datepair.js"></script>

        </div>

    </div>
</body>