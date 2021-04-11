<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/if_new_ico.gif') ?>" />
  <meta name="description" content="Infomatika Webinar Series">
  <meta name="author" content="Informatika Untan">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <title><?= $title ?></title>
  <!-- custom style -->
  <style>
    .fw600 {
      font-weight: 600;
    }

    .navbar-brand img {
      height: 40% !important;
      width: 40% !important;
    }
  </style>
</head>

<body style="font-family: 'Poppins', sans-serif;">
  <!-- NavBar hehe -->
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="border-bottom: 1px solid #dee2e6 !important">
    <div class="container">
      <a class="navbar-brand text-uppercase fs-4 fw-bold d-flex" href="<?= base_url() ?>">
        <img src="<?= base_url('assets/img/Webinar Series Biru.png') ?>" alt="Informatics Webinar Series" class="d-none d-md-flex">
        <span class="d-md-none text-primary">Webinar Series</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-uppercase fs-6 fw600  active" aria-current="page" href="<?= base_url() ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase fs-6 fw600 " href="#acara">Acara</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase fs-6 fw600 " href="#stats">Statistik</a>
          </li>
          <li class="nav-item d-sm-block d-md-none my-2">
            <a class="btn btn-outline-secondary w-100" href="<?= base_url('auth') ?>">Login</a>
          </li>
          <li class="nav-item d-sm-block d-md-none">
            <a class="btn btn-block btn-primary w-100" href="<?= base_url('auth/registrasi') ?>">Register</a>
          </li>
        </ul>
        <div class="d-none d-md-flex">
          <div class='p-sm-1 p-md-2'>
            <a class="btn btn-outline-secondary text-uppercase" href="<?= base_url('auth') ?>">Login</a>
          </div>
          <div class="p-sm-1 p-md-2">
            <a class="btn btn-primary text-uppercase" href="<?= base_url('auth/registrasi') ?>">Register</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->
  <!-- Hero Section -->
  <section id="hero" class="mt-3">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mt-5 fw-bold">Webinar Series Informatika Universitas Tanjungpura</h2>
          <p class="fs-6">Upgrade skillmu dengan bergabung dalam Webinar Informatika serta dapatkan sertifikatmu sekarang juga! </p>
          <a class="btn btn-primary" href="<?= base_url('auth/registrasi') ?>">Mulai Bergabung</a>
          <a class="btn btn-outline-secondary" href="#acara">List Webinar</a>
        </div>
        <div class="col-md-6 d-none d-sm-block">
          <div class="mt-5 ">
            <img src="<?= base_url('assets/img/hero.svg') ?>" height="250" width="100%" alt="Hero image" class="figure-img">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Hero Section -->
  <?= $content ?>
  <section id="stats" class="y-1 bg-dark text-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="text-center my-3">
            <i class="bi bi-calendar-check fs-1"></i>
            <h2 class="fs-4">Event Selesai</h2>
          </div>
          <h3 class="display-2 text-center"><?= $acara ?></h3>
          <p class="text-center">Acara yang terdaftar pada Webinar Series Informatika Untan</p>
        </div>
        <div class="col-md-4">
          <div class="text-center my-3">
            <i class="bi bi-person-square fs-1"></i>
            <h2 class="fs-4">Peserta</h2>
          </div>
          <h3 class="display-2 text-center"><?= $peserta ?></h3>
          <p class="text-center">Orang yang terdaftar pada Webinar Series Informatika Untan</p>
        </div>
        <div class="col-md-4">
          <div class="text-center my-3">
            <i class="bi bi-file-earmark-arrow-down fs-1"></i>
            <h2 class="fs-4">Sertifikat</h2>
          </div>
          <h3 class="display-2 text-center"><?= $sertifikat ?></h3>
          <p class="text-center">Sertifikat yang telah dikeluarkan oleh Webinar Series Informatika Untan</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Optional JavaScript; choose one of the two! -->
  <footer class="border-top bg-dark text-light">
    <p class="text-center my-auto">&copy; <?= date('Y') == '2021' ? date('Y') : '2021-' . date('Y') ?> Jurusan Informatika Universitas Tanjungpura</p>
  </footer>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>