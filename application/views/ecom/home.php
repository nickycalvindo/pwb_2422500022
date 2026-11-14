     <style>
        .diskon {
            position: absolute;
            top: 8px;
            right: 16px;
        }
    </style>
    <div class="container mb-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                <?php if (empty($list_produk)) : ?>
        <div class="col-12">
            <div class="alert alert-info mb-0">Produk belum tersedia.</div>
        </div>
        <?php else : ?>
        <?php foreach ($list_produk as $produk) : ?>
            <?php $gambar = $gambar_model->get_by_produk_id($produk['id_produk']); ?>
            <div class="col">
                <div class="card shadow-sm">
                    <a href="#">
                        <?php if (!empty($gambar)) : ?>
                        <img src="<?= base_url() ?>uploads/produk/<?= html_escape($gambar[0]['nama_gambar']) ?>" class="d-block w-100" alt="<?= html_escape($produk['pd_nama']) ?>">
                        <?php else : ?>
                        <img src="<?= base_url() ?>assets/template_frontend/running-shoe-371625_640.jpg" class="d-block w-100" alt="<?= html_escape($produk['pd_nama']) ?>">
                        <?php endif ?>
                    </a>
                        <div class="diskon">
                            <span class="badge bg-primary">Lebaran.20%</span>
                        </div>
                    <div class="card-body">
                        <a href="#">
                            <h5 class="card-title"><?= html_escape($produk['pd_nama']) ?></h5>
                        </a>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="harga d-flex" style="color:dark">
                                <small>Rp</small>
                                <h4><?= number_format($produk['harga'], 0, ',', '.') ?></h4>
                            </div>
                            <small>
                                <p><?= (int) $produk['stok'] ?> stok</p>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <?php endif ?>
    </div>
    <div class="container mt-4 text-center">
        <button type="button" class="btn btn-outline-primary">Lihat Semua Produk</button>
    </div>
