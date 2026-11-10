<?php
/**
 * Catatan: file template asli (index.html dari Classroom) tidak tersedia di mesin ini.
 * Bagian ini direkonstruksi: daftar produk diambil dari $list_produk yang dikirim Dashboard.
 */
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Produk</h4>
    <?php if ($this->input->get('q')) : ?>
        <span class="text-muted small">Hasil pencarian: <b><?= html_escape($this->input->get('q')) ?></b></span>
    <?php endif ?>
</div>

<?php if (empty($list_produk)) : ?>
    <div class="alert alert-info">Produk belum tersedia.</div>
<?php else : ?>
    <div class="row g-3 mb-5">
        <?php foreach ($list_produk as $produk) : ?>
            <?php
            $gambar = $gambar_model->get_by_produk_id($produk['id_produk']);
            ?>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($gambar)) : ?>
                        <img src="<?= base_url() ?>uploads/produk/<?= html_escape($gambar[0]['nama_gambar']) ?>"
                            class="card-img-top" alt="<?= html_escape($produk['pd_nama']) ?>">
                    <?php else : ?>
                        <div class="card-img-top bg-secondary bg-opacity-25 d-flex align-items-center justify-content-center">
                            <span class="text-muted small">Gambar belum tersedia</span>
                        </div>
                    <?php endif ?>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-1"><?= html_escape($produk['pd_nama']) ?></h6>
                        <div class="text-muted small mb-2"><?= html_escape($produk['kt_nama']) ?></div>
                        <div class="fw-bold text-success mb-2">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>
                        <div class="small text-muted mt-auto">Stok: <?= (int) $produk['stok'] ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>