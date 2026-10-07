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
          <h3 class="card-title">Kategori</h3>
          <div class="card-tools">
            <a href="<?= base_url('admin/kategori/tambah') ?>" class="btn btn-labeled btn-primary">
              <span class="btn-label"><i class="fa fa-plus"></i></span> Kategori
            </a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style="width: 50px">No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th style="width: 150px">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($list_kategori as $kategori) : ?>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <td><?= $no ?></td>
                  <td><?= $kategori['nama'] ?></td>
                  <td><?= $kategori['deskripsi'] ?></td>
                  <td>
                    <a href="<?= base_url('admin/kategori/ubah/' . $kategori['id_kategori']) ?>"><span class="badge bg-success">Ubah</span></a>
                    <a href="<?= base_url('admin/kategori/hapus/' . $kategori['id_kategori']) ?>"><span class="badge bg-danger">Hapus</span></a>
                  </td>
                </tr>
              <?php $no++; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
