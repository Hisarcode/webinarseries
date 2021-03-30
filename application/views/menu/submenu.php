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
                        <div class="col-lg">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('category_success')) : ?>
                                <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('category_error')) : ?>
                                <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                            <?php endif; ?>

                            <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-primary mb-3 tambahSubMenuBtn" data-toggle="modal" data-target="#tambahSubMenuModal">Tambah Submenu Baru</a>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Url</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($subMenu as $sm) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $sm['title']; ?></td>
                                            <td><?= $sm['menu']; ?></td>
                                            <td><?= $sm['url']; ?></td>
                                            <td><?= $sm['icon']; ?></td>
                                            <td><?= $sm['is_active']; ?></td>
                                            <td>
                                                <a href="<?= base_url(); ?>menu/editsubmenu/<?= $sm['id']; ?>" class="badge badge-success tampilModalEditSubMenu" data-toggle="modal" data-target="#tambahSubMenuModal" data-id="<?= $sm['id']; ?>">Edit</a>
                                                <a href="<?= base_url(); ?>menu/deletesubmenu/<?= $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('Yakin?');">Delete</a>
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
            <div class="modal fade" id="tambahSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahSubMenuModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahSubMenuModalLabel">Tambah Sub Menu Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('menu/submenu/'); ?>" method="POST">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
                                </div>

                                <div class="form-group">
                                    <select name="menu_id" id="menu_id" class="form-control">
                                        <option value="">Pilih Menu</option>
                                        <?php foreach ($menu as $m) : ?>
                                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu Url">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon">
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
                                        <label for="is_active" class="form-check-label">Active</label>
                                    </div>
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
    <script>
        $(function() {

            $('.tambahSubMenuBtn').on('click', function() {
                $('#tambahSubMenuModalLabel').html('Tambah Sub Menu Baru');
                $('.modal-footer button[type=submit]').html('Tambah');
                $('#title').val('');
                $('#url').val('');
                $('#icon').val('');
                $('#menu_id').val('');
                $('.modal-body form').attr('action', 'http://localhost/webinarseries/menu/submenu');
            });

            $('.tampilModalEditSubMenu').on('click', function() {

                $('#tambahSubMenuModalLabel').html('Edit Sub Menu');
                $('.modal-footer button[type=submit]').html('Edit Data');
                $('.modal-body form').attr('action', 'http://localhost/webinarseries/menu/editsubmenu');

                const id = $(this).data('id');

                // jquery ajax, request data tanpa mereload seluruh halamannya 
                $.ajax({
                    url: 'http://localhost/webinarseries/menu/geteditsubmenu',
                    data: {
                        id: id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#menu_id').val(data.menu_id);
                        $('#title').val(data.title);
                        $('#url').val(data.url);
                        $('#icon').val(data.icon);
                        $('#is_active').val(data.is_active);
                    }
                });
            });

        });
    </script>
</body>

</html>