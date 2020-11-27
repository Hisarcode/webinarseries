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

                            <a href="" class="btn btn-primary mb-3 tambahRoleBtn" data-toggle="modal" data-target="#tambahRoleModal">Tambah Role Baru</a>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($role as $r) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $r['role']; ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-warning">Akses</a>
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
            <div class="modal fade" id="tambahRoleModal" tabindex="-1" role="dialog" aria-labelledby="tambahRoleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahRoleModalLabel">Tambah Role Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/role'); ?>" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Nama Role">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?php $this->load->view('templates/footer'); ?>
    </div>
    <!-- End of Content Wrapper -->

    </div>

    <?php $this->load->view('templates/script') ?>

</body>