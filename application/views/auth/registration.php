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
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center mb-3">
                <img src="<?= base_url('assets/img/Webinar Series Biru.png') ?>" width="100%">
              </div>
              <form class="user" method="POST" autocomplete="off" action="<?= base_url('auth/registrasi'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                  <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Masukkan instansi" value="<?= set_value('instansi'); ?>">
                  <?= form_error('instansi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>


                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input autocomplete="new-password" type="password" class="form-control" id="passsword1" name="password1" placeholder="Password">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>

              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth'); ?>">Sudah memiliki akun? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>