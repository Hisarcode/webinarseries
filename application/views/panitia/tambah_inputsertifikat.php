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
                            <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Sertifikat Webinar</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url() ?>panitia/tambah_inputsertifikat" method="POST" enctype="multipart/form-data">

                                Pilih Webinar: <br>
                                <select name="webinar_id" id="webinar_id" class="form-control <?php echo form_error('webinar_id') ? 'is-invalid' : '' ?>">
                                    <option value="">Pilih Webinar</option>
                                    <?php foreach ($daftarwebinar as $dw) : ?>
                                        <option value="<?= $dw['webinar_id']; ?>"><?= $dw['webinar_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('webinar_nama') ?>
                                </div><br><br>
                                Tanggal Keluar : <br>
                                <p id="tanggalKeluarId">
                                    <input type="text" class="form-control date <?php echo form_error('tanggal_keluar') ? 'is-invalid' : '' ?>" name="tanggal_keluar" value="<?= set_value('tanggal_keluar'); ?>">
                                </p>
                                <div class="invalid-feedback">
                                    <?php echo form_error('tanggal_keluar') ?>
                                </div><br><br>


                                Gambar Sertifikat <br>
                                <input type="file" name="gambar_sertifikat">

                                <br><br>
                                <a href="<?= base_url('panitia/inputsertifikat') ?>" class="btn btn-secondary btn-user">Batal</a>
                                <button type="submit" class="btn btn-primary">Input Sertifikat</button>
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
                    'format': 'dd/mm/yyyy',
                    'autoclose': true
                });


                // initialize datepair
                var basicExampleEl = document.getElementById('tanggalKeluarId');
                var datepair = new Datepair(basicExampleEl);
            </script>
        </div>

    </div>
</body>