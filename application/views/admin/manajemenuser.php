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
                            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?php if ($this->session->flashdata('category_error')) : ?>
                                <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('category_success')) : ?>
                                <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                            <?php endif; ?>

                            <a href="tambah_user" class="btn btn-primary mb-3">Tambah User Baru</a>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($manajemenuser as $mu) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $mu['nama']; ?></td>
                                            <td><?= $mu['email']; ?></td>
                                            <td><?= $mu['role_id']; ?></td>
                                            <td>
                                                <a href="<?= base_url(); ?>admin/edit_user/<?= $mu['id']; ?>" class="badge badge-success">Edit</a>
                                                <a href="<?= base_url(); ?>admin/delete_user/<?= $mu['id']; ?>" class="badge badge-danger" onclick="return confirm('Yakin?');">Delete</a>
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


            <?php $this->load->view('templates/footer'); ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <?php $this->load->view('templates/script') ?>

</body>

</html>