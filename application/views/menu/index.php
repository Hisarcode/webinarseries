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

                    <div class="row">
                        <div class="col-lg-6">
                            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?php if ($this->session->flashdata('category_error')) : ?>
                                <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('category_success')) : ?>
                                <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                            <?php endif; ?>


                            <a href="" class="btn btn-primary mb-3 tambahMenuBtn" data-toggle="modal" data-target="#tambahMenuModal">Tambah Menu Baru</a>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $m['menu']; ?></td>
                                            <td>
                                                <a href="<?= base_url(); ?>menu/editmenu/<?= $m['id']; ?>" class="badge badge-success tampilModalEditMenu" data-toggle="modal" data-target="#tambahMenuModal" data-id="<?= $m['id']; ?>">Edit</a>
                                                <a href="<?= base_url(); ?>menu/deletemenu/<?= $m['id']; ?>" class="badge badge-danger" onclick="return confirm('Yakin?');">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++;  ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



            <!-- Modal -->
            <div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahMenuModalLabel">Tambah Menu Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('menu'); ?>" method="POST">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php $this->load->view('templates/footer'); ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <?php $this->load->view('templates/script') ?>
    <script src="<?= base_url('assets/'); ?>js/script.js"></script>
    <script>
        $(function() {
            $('.tambahMenuBtn').on('click', function() {
                $('#tambahMenuModalLabel').html('Tambah Menu Baru');
                $('.modal-footer button[type=submit]').html('Tambah');
                $('.modal-body form').attr('action', 'http://localhost/webinarseries/menu/');
                $('#menu').val('');

            });


            $('.tampilModalEditMenu').on('click', function() {
                $('#tambahMenuModalLabel').html('Edit  Menu');
                $('.modal-footer button[type=submit]').html('Edit Data');
                $('.modal-body form').attr('action', 'http://localhost/webinarseries/menu/editmenu');

                const id = $(this).data('id');

                // jquery ajax, request data tanpa mereload seluruh halamannya 
                $.ajax({
                    url: 'http://localhost/webinarseries/menu/geteditmenu',
                    data: {
                        id: id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#menu').val(data.menu);
                    }
                });
            });
        });
    </script>

</body>

</html>