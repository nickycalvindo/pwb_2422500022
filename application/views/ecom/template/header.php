<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Toko online Pemrograman Web Bisnis 2422500022" />
    <title><?= isset($title) ? $title : 'Toko Online - PWB 2422500022' ?></title>
    <link href="<?= base_url() ?>assets/plugins/bootstrap5/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">Toko Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPelanggan"
                aria-controls="navbarPelanggan" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarPelanggan">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
                    </li>
                </ul>
                <form class="d-flex me-auto my-2 my-lg-0" role="search" method="GET" action="<?= base_url() ?>">
                    <input class="form-control me-2" type="search" name="q" placeholder="Cari produk"
                        aria-label="Cari produk" value="<?= html_escape($this->input->get('q')) ?>">
                    <button class="btn btn-outline-light" type="submit">Cari</button>
                </form>
                <?php if ($this->session->has_userdata('pelanggan_login')) : ?>
                    <div class="text-end">
                        <a href="<?= base_url('profil') ?>" class="btn btn-outline-light me-2 ">Profil</a>
                        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
                    </div>
                <?php else : ?>
                    <div class="text-end">
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-light me-2 ">Login</a>
                        <a href="<?= base_url('register') ?>" class="btn btn-warning">Register</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </nav>

    <div class="container my-4">