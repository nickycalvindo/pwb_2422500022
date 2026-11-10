<?php
/**
 * Catatan: file template asli (index.html dari Classroom) tidak tersedia di mesin ini.
 * Markup carousel direkonstruksi memakai Bootstrap 5 sesuai potongan materi
 * (class d-block w-100) dan gambar produk yang benar-benar ada di folder uploads.
 */
?>
<div id="carouselProduk" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselProduk" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselProduk" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselProduk" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner rounded-3">
        <div class="carousel-item active">
            <img src="<?= base_url() ?>uploads/produk/produk-8-1791627157-0.jpg" class="d-block w-100"
                alt="Dress Wanita Putih">
            <div class="carousel-caption d-none d-md-block">
                <h5>Dress Wanita Putih</h5>
                <p>Koleksi terbaru untuk penampilan sehari-hari.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url() ?>uploads/produk/produk-6-1791630735-11.jpg" class="d-block w-100"
                alt="Kemeja Kasual Hitam Pria">
            <div class="carousel-caption d-none d-md-block">
                <h5>Kemeja Kasual Hitam Pria</h5>
                <p>Bahan nyaman untuk kegiatan harian.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url() ?>uploads/produk/produk-13-0.jpg" class="d-block w-100" alt="Kaos Anak Putih">
            <div class="carousel-caption d-none d-md-block">
                <h5>Kaos Anak Putih</h5>
                <p>Pilihan tepat untuk buah hati.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduk" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sebelumnya</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselProduk" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Berikutnya</span>
    </button>
</div>