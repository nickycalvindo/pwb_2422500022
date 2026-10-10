<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Gambar Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/produk') ?>">Produk</a></li>
            <li class="breadcrumb-item active">Ubah Gambar</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <p class="card-text">

                <?php if ($this->session->flashdata('message')) : ?>
                  <?= $this->session->flashdata('message') ?>
                <?php endif ?>

                <div class="row mb-3">
                  <div class="col-lg-4">
                    <div class="card" style="width: 18rem;">
                      <img src="<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>" class="card-img-top">
                      <div class="card-body">
                        <p class="card-text mb-0"><strong>Gambar saat ini</strong></p>
                        <small class="text-muted"><?= $gambar['nama_gambar'] ?></small>
                      </div>
                    </div>
                  </div>
                </div>

                <p>
                  Produk: <strong><?= $produk['nama'] ?></strong>
                </p>

                <form method="post" enctype="multipart/form-data">

                  <div class="mb-3">
                    <label for="gambar_produk_baru" class="form-label">Gambar pengganti</label>
                    <input class="form-control" type="file" id="gambar_produk_baru" name="gambar_produk_baru">
                    <small class="text-muted">Pilih satu gambar. Gambar lama akan diganti setelah gambar baru berhasil diunggah.</small>
                  </div>

                  <button type="submit" class="btn btn-primary">Ubah</button>
                  <a href="<?= base_url('admin/produk/ubah/' . $produk['id_produk']) ?>" class="btn btn-danger">Kembali</a>

                </form>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
