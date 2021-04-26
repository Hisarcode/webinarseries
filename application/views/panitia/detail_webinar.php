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
                                    <img class="img-fluid col-lg-6 mb-3" style="margin-left:-10px" height="auto" src="<?= base_url('upload/webinar/') . $webinar['poster']; ?>">
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
                                            <h6 class="font-weight-bold text-dark">
                                                <?= date('d F Y', strtotime($webinar['tanggal']));  ?> , <?= $webinar['jam'] ?> WIB
                                            </h6>
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
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary"> Link Media </h6>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="font-weight-bold text-dark"><?= $webinar['link_media'] ?></h6>
                                            <a href="<?= base_url('panitia/edit_link/') . $webinar['webinar_id']; ?>" class="btn btn-primary tampilModalEditLink" data-toggle="modal" data-target="#editLinkModal" data-id="<?= $webinar['webinar_id']; ?>">Edit Link</a>
                                            <a href="<?= $webinar['link_media']; ?>" target="_blank" class="btn btn-info"> Coba Link</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary"> Aksi </h6>
                                        </div>
                                        <div class="card-body text-justify">
                                            <a href="<?= base_url('panitia/edit_webinar/') . $webinar['webinar_id'] ?>" class="mb-3 btn btn-info btn-block">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text">Ubah Data</span>
                                            </a>
                                            <a href="<?= base_url('panitia/webinar') ?>" class="mb-3 btn btn-secondary  btn-block">
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

            <div class="modal fade" id="editLinkModal" tabindex="-1" role="dialog" aria-labelledby="editLinkModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLinkModalLabel">Edit Link</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('panitia/edit_link/'); ?>" method="POST">
                                <div class="form-group">
                                    <input type="text" name="id" id="id">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="link_media" name="link_media" placeholder="Sub Menu Title">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->view('templates/footer'); ?>
            <?php $this->load->view('templates/logout_modal'); ?>
            <?php $this->load->view('templates/script'); ?>
            <script src="<?= base_url('assets/') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets/') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url('assets/')  ?>/js/demo/datatables-demo.js"></script>


            <script>
                $(function() {

                    $('.tampilModalEditLink').on('click', function() {
                        $('.modal-body form').attr('action', 'http://localhost/webinarseries/panitia/editlink');

                        const id = $(this).data('id');

                        // jquery ajax, request data tanpa mereload seluruh halamannya 
                        $.ajax({
                            url: 'http://localhost/webinarseries/panitia/geteditlink',
                            data: {
                                id: id
                            },
                            method: 'post',
                            dataType: 'json',
                            success: function(data) {
                                $('#id').val(data.webinar_id);
                                $('#link_media').val(data.link_media);
                            }
                        });
                    });
                });
            </script>
        </div>

    </div>
</body>