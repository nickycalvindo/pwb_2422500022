<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Starter Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->flashdata('message')) : ?>
        <?= $this->session->flashdata('message') ?>
      <?php endif; ?>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ubah Kategori</h3>
        </div>
        <div class="card-body">
          <form method="post">
            <div class="mb-3">
              <label for="nama_kategori" class="form-label">Nama Kategori</label>
              <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="<?= $kategori['nama'] ?>" aria-describedby="Nama Kategori">
              <?= form_error('nama_kategori', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="mb-3">
              <label for="deskripsi_kategori" class="form-label">Deskripsi</label>
              <textarea name="deskripsi_kategori" id="deskripsi_kategori" cols="30" rows="10" class="form-control"><?= $kategori['deskripsi'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ubah</button>
            <a href="<?= base_url('admin/kategori') ?>" class="btn btn-danger">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
