<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/meta'); ?>

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <?php $this->load->view('templates/style'); ?>
</head>

<body class="bg-gradient-primary utama">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ilustrasi"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center text-dark">
                                        <h1 class="h3 font-weight-bolder mb-4">Login Informatika Webinar Series</h1>
                                    </div>

                                    <?php if ($this->session->flashdata('category_success')) : ?>
                                        <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                                    <?php endif; ?>

                                    <?php if ($this->session->flashdata('category_error')) : ?>
                                        <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                                    <?php endif; ?>
                                    <form class="user" autocomplete="new-password" method="POST" action="<?= base_url('auth'); ?>">
                                        <a href="<?= $login_button ?>" class="btn btn-google btn-user btn-block mb-4">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <hr>
                                        <div class="form-group mt-4">
                                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan email Anda..." value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input autocomplete="new-password" type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password Anda">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block mb-5 tombol">
                                            Login
                                        </button>

                                    </form>
                                    <div class="p-4"></div>
                                    <hr>
                                    <div class="text-center text-dark">

                                        <div class="medium font-weight-bold">Belum Punya Akun?</div>

                                    </div>
                                    <div class="text-center">
                                        <a class="medium" href="<?= base_url('auth/registrasi'); ?>">Silahkan Registrasi!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view('templates/script'); ?>
</body>

</html>