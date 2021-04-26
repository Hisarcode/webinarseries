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
                            <h6 class="m-0 font-weight-bold text-primary">Edit Data Sertifikat Webinar</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="webinar_nama">Webinar : </label>
                                    <input type="text" class="form-control mb-2" value="<?= $sertifikat['webinar_nama'] ?>" id="webinar_nama" name="webinar_nama" readonly>

                                </div>
                                <input type="hidden" value="<?= $sertifikat['sertifikat_id'] ?>" id="sertifikat_id" name="sertifikat_id">
                                <input type="hidden" value="<?= $sertifikat['webinar_id'] ?>" id="webinar_id" name="webinar_id">
                                <input type="hidden" value="<?= $sertifikat['gambar_sertifikat']; ?>" id="old_gambar_sertifikat" name="old_gambar_sertifikat">


                                <div class="form-group">
                                    <label for="tanggal_keluar">Tanggal Keluar : </label>
                                    <p id="tanggalKeluarId">
                                        <input type="text" class="form-control date <?php echo form_error('tanggal_keluar') ? 'is-invalid' : '' ?>" name="tanggal_keluar" value="<?= $sertifikat['tanggal_keluar'] ?>">
                                    </p>
                                    <div class="invalid-feedback ">
                                        <?php echo form_error('tanggal_keluar') ?>
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="gambar_sertifikat">Gambar Sertifikat : </label>
                                    <input type="file" name="gambar_sertifikat">
                                </div>

                                <img src="<?= base_url('upload/sertifikat/') . $sertifikat['gambar_sertifikat']; ?>" class="mb-2 img-fluid col-lg-6" style="margin-left:-10px" height="auto">
                                <br>
                                <a href="<?= base_url('panitia/inputsertifikat') ?>" class="btn btn-secondary btn-user">Batal</a>
                                <button type="submit" class="btn btn-primary">Edit Sertifikat</button>
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
            <script>
                $('#tanggalKeluarId .date').datepicker({
                    'format': 'yyyy-mm-dd',
                    'autoclose': true
                });


                // initialize datepair
                var basicExampleEl = document.getElementById('tanggalKeluarId');
                var datepair = new Datepair(basicExampleEl);
            </script>
        </div>

    </div>
</body>