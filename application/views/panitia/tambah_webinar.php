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
                            <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Webinar</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url() ?>panitia/tambah_webinar" method="POST" enctype="multipart/form-data">
                                Nama Webinar: <br>
                                <input type="text" class="form-control <?php echo form_error('webinar_nama') ? 'is-invalid' : '' ?>" name="webinar_nama" value="<?= set_value('webinar_nama'); ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('webinar_nama') ?>
                                </div><br><br>
                                Tanggal : <br>
                                <p id="tanggalId">

                                    <input type="text" class="form-control date <?php echo form_error('tanggal') ? 'is-invalid' : '' ?>" name="tanggal" value="<?= set_value('tanggal'); ?>">
                                </p>
                                <div class="invalid-feedback">
                                    <?php echo form_error('tanggal') ?>
                                </div><br><br>
                                Jam: <br>
                                <p id="jamId">

                                    <input type="text" class="form-control time <?php echo form_error('jam') ? 'is-invalid' : '' ?>" name="jam" value="<?= set_value('jam'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('jam') ?>
                                    </div><br><br>
                                </p>
                                Media: <br>
                                <select name="media_id" id="media_id" class="form-control <?php echo form_error('media_id') ? 'is-invalid' : '' ?>">
                                    <option value="">Pilih Media</option>
                                    <?php foreach ($media as $m) : ?>
                                        <option value="<?= $m['media_id']; ?>"><?= $m['media_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('media_id') ?>
                                </div><br><br>

                                Link Media : <br>
                                <input type="text" class="form-control" name="link_media" value="<?= set_value('link_media'); ?>">
                                <br><br>

                                Narasumber: <br>
                                <div class="row ml-0 after-add-more ">

                                    <div class="col-6 p-0 ">
                                        <input type="text" class="form-control <?php echo form_error('narasumber') ? 'is-invalid' : '' ?>" name="narasumber[]" value="<?= set_value('narasumber'); ?>">

                                        <div class="invalid-feedback">
                                            <?php echo form_error('narasumber') ?>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary add-more mt-2" type="button">
                                    <i class="fas fa-plus"></i> Tambah Narasumber
                                </button>

                                <div class="copy invisible">
                                    <div class="row control-group ml-0 mt-2 ">
                                        <div class="col-6 p-0">
                                            <input type="text" class="form-control <?php echo form_error('narasumber') ? 'is-invalid' : '' ?>" name="narasumber[]" value="<?= set_value('narasumber'); ?>">
                                            <div class="invalid-feedback">
                                                <?php echo form_error('narasumber') ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-danger remove" type="button"><i class="fas fa-minusx"></i> Remove</button>
                                        </div>
                                    </div>

                                </div>


                                Deskripsi:
                                <textarea class="form-control <?php echo form_error('deskripsi') ? 'is-invalid' : '' ?>"" id=" deskripsi" name="deskripsi" rows="5" value="<?= set_value('deskripsi'); ?>"></textarea>
                                <div class="invalid-feedback">
                                    <?php echo form_error('deskripsi') ?>
                                </div><br><br>
                                Foto <br>
                                <input type="file" name="poster">

                                <br><br>
                                <a href="<?= base_url('panitia/webinar') ?>" class="btn btn-secondary btn-user">Batal</a>
                                <button type="submit" class="btn btn-primary">Tambah Webinar</button>
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
                $('#jamId .time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'H:i'
                });

                var timeOnlyExampleEl = document.getElementById('jamId');
                var timeOnlyDatepair = new Datepair(timeOnlyExampleEl);

                $('#tanggalId .date').datepicker({
                    'format': 'yyyy-mm-dd',
                    'autoclose': true
                });


                // initialize datepair
                var basicExampleEl = document.getElementById('tanggalId');
                var datepair = new Datepair(basicExampleEl);
            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(".add-more").click(function() {
                        var html = $(".copy").html();

                        $(".after-add-more").after(html);
                    });

                    // saat tombol remove dklik control group akan dihapus 
                    $("body").on("click", ".remove", function() {
                        $(this).parents(".control-group").remove();
                    });
                });
            </script>
        </div>

    </div>
</body>