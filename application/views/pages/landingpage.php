<section id="acara" class="mt-5">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-center fw-bolder mb-4">Acara</h2>
      </div>
      <div class="row mb-4">

        <?php foreach ($webinar as $wb) : ?>
          <?php $urlEncode = base_url() . 'w/' . strtr(base64_encode($wb['webinar_id']), '+/=', '._-') ?>
          <div class="col-md-6 col-lg-4">
            <div class="card mb-3">
              <img src="<?= base_url('upload/webinar/') . $wb['poster']; ?>" style="height: 450px !important;" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?= $wb['webinar_nama']; ?></h5>
                <p class="card-text"><?= $wb['deskripsi'] ?></p>
                <a href="<?php echo $urlEncode ?>" class="btn btn-primary w-100">Detail</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</section>