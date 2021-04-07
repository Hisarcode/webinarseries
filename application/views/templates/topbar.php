<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Messages -->

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                <?php if (strpos($user['image'], 'https') !== false) : ?>
                    <img class="img-profile rounded-circle" src="<?= $user['image']; ?>">
                <?php else : ?>
                    <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                <?php endif; ?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <?php $role_id = $this->session->userdata('role_id'); ?>
                <?php if ($role_id != 1) : ?>
                    <?php if ($role_id == 2) : ?>

                        <a class="dropdown-item" href="<?= base_url('panitia/profil'); ?>">
                        <?php elseif ($role_id == 3) : ?>
                            <a class="dropdown-item" href="<?= base_url('peserta/profil'); ?>">
                            <?php endif; ?>


                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profil Saya
                            </a>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>

                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>


            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->