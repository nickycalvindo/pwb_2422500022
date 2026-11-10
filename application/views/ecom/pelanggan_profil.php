<div class="container mb-3 mt-4">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-1 text-center">
            <h4>Profil</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-small">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">profil</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Data Pelanggan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th class="text-muted" style="width: 200px;">Nama Pelanggan</th>
                            <td><?= html_escape($pelanggan['nama_pelanggan']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Email</th>
                            <td><?= html_escape($pelanggan['email']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">No Telpon</th>
                            <td><?= html_escape($pelanggan['telp_pelanggan']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Alamat</th>
                            <td><?= html_escape($pelanggan['alamat']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kota</th>
                            <td><?= html_escape($pelanggan['kota']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kode Pos</th>
                            <td><?= html_escape($pelanggan['kode_pos']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Provinsi</th>
                            <td><?= html_escape($pelanggan['provinsi']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white text-end">
                <a href="<?= base_url() ?>" class="btn btn-outline-secondary">Kembali ke Home</a>
            </div>
        </div>
    </div>
</div>