<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/meta'); ?>

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <?php $this->load->view('templates/style'); ?>

    <style>
        a,
        a:hover {
            color: #333
        }
    </style>
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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center text-dark mb-3">
                                        <!-- <h1 class="h3 font-weight-bolder mb-4">Login Informatika Webinar Series</h1> -->
                                        <a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/Webinar Series Biru.png') ?>" width="100%"></a>
                                    </div>

                                    <?php if ($this->session->flashdata('category_success')) : ?>
                                        <div class="alert alert-success" role="alert"> <?= $this->session->flashdata('category_success') ?> </div>
                                    <?php endif; ?>

                                    <?php if ($this->session->flashdata('category_error')) : ?>
                                        <div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('category_error') ?> </div>
                                    <?php endif; ?>

                                    <form class="user" method="POST" action="<?= base_url('auth'); ?>" autocomplete="off">

                                        <div class="form-group">
                                            <input type="text" class="form-control  " id="email" name="email" placeholder="Masukkan email Anda..." value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<div class="invalid-feedback  d-block">', '</div>'); ?>
                                        </div>


                                        <div class="form-group">
                                            <div class="input-group" id="show_hide_password">
                                                <input autocomplete="new-password" type="password" class="form-control " id="password" name="password" placeholder="Masukkan Password Anda">

                                                <span class="input-group-addon border border-primary">
                                                    <a href="" class="btn btn-default"><i class="my-auto fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </span>
                                            </div>
                                            <?= form_error('password', '<div class="invalid-feedback  d-block">', '</div>'); ?>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block mb-2 tombol">
                                            Login
                                        </button>
                                        <hr>

                                        <a href="<?= $login_button ?>" class="btn btn-google btn-user btn-block mb-4">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
    </script>
</body>

</html>