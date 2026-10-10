<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_admin_logged_in();

        // Load model
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';

        $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');

        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();

            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    private function __simpan_produk()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'kategori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        # simpan dan return id_produk
        $id_produk = $this->produk_model->tambah($data);

        # simpan data, terus lakukan upload gambar berdasarkan id produk
        $count = count($_FILES['gambar_produk']['name']);

        if ($count > 0) {
            // jika ada gambar upload
            $this->__produk_gambar_upload($count, $id_produk);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil menambahkan produk!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        redirect('admin/produk');
    }

    private function __produk_gambar_upload($count, $id_produk)
    {
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path'] = 'uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = 'produk-' . $id_produk . '-' . $i;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    $data = [
                        'nama_gambar' => $filename,
                        'produk_id' => $id_produk
                    ];

                    $this->produk_gambar_model->tambah($data);
                }
            }
        }
    }

    public function ubah_produk($id)
    {
        // check dulu apakah id dengan produk ada?
        $produk = $this->produk_model->get_by_id($id);

        if ($produk) {
            $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_produk($id);
            } else {
                $data['title'] = 'Ubah produk';
                $data['produk'] = $produk;
                $data['list_kategori'] = $this->produk_kategori_model->get_all();
                $data['gambar_model'] = $this->produk_gambar_model;

                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>produk tidak ditemukan!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            redirect('admin/produk');
        }
    }

    private function __ubah_produk($id)
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'kategori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $ubah = $this->produk_model->ubah($data, $id);

        // Cek apakah user memilih gambar baru
        $ada_gambar_baru = FALSE;

        if (isset($_FILES['gambar_produk']['name']) && is_array($_FILES['gambar_produk']['name'])) {
            foreach ($_FILES['gambar_produk']['name'] as $nama_file) {
                if (!empty($nama_file)) {
                    $ada_gambar_baru = TRUE;
                    break;
                }
            }
        }

        // Produk sudah dipastikan ada pada pengecekan get_by_id().
        // Update dianggap berhasil kecuali gambar baru gagal diupload seluruhnya.
        $berhasil = TRUE;

        if ($ada_gambar_baru) {
            // Upload gambar baru terlebih dahulu
            $gambar_baru = $this->__produk_gambar_upload_replacement($id);

            if (count($gambar_baru) > 0) {
                // Ada minimal satu gambar baru berhasil diupload,
                // hapus gambar lama (file + record database)
                $this->__hapus_semua_gambar_lama($id, $gambar_baru);
            } else {
                // Gambar baru dipilih tetapi gagal seluruhnya:
                // gambar lama tidak dihapus, operasi dianggap gagal.
                $berhasil = FALSE;
            }
        }

        if ($berhasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil mengubah produk!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Gagal mengubah produk!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        redirect('admin/produk');
    }

    /**
     * Upload gambar produk untuk proses ubah/ganti gambar.
     * Mengembalikan array nama file yang berhasil diupload.
     */
    private function __produk_gambar_upload_replacement($id_produk)
    {
        $berhasil = [];

        $count = count($_FILES['gambar_produk']['name']);

        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path'] = 'uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = 'produk-' . $id_produk . '-' . time() . '-' . $i;
                $config['overwrite'] = FALSE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    $berhasil[] = $filename;

                    $data = [
                        'nama_gambar' => $filename,
                        'produk_id' => $id_produk
                    ];

                    $this->produk_gambar_model->tambah($data);
                }
            }
        }

        return $berhasil;
    }

    /**
     * Hapus gambar lama produk (record database + file fisik),
     * kecuali gambar yang baru saja diupload.
     */
    private function __hapus_semua_gambar_lama($id_produk, $gambar_baru)
    {
        $list_gambar = $this->produk_gambar_model->get_by_produk_id($id_produk);

        foreach ($list_gambar as $gambar) {
            // Lewati gambar yang baru saja diupload
            if (in_array($gambar['nama_gambar'], $gambar_baru)) {
                continue;
            }

            // Hapus record database
            $this->produk_gambar_model->hapus($gambar['id_gambar']);

            // Hapus file fisik jika ada
            $path = './uploads/produk/' . $gambar['nama_gambar'];

            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    public function hapus_gambar($id_gambar, $id_produk)
    {
        // ambil data gambar
        $list_gambar = $this->produk_gambar_model->get_by_produk_id($id_produk);

        foreach ($list_gambar as $gambar) {
            if ($gambar['id_gambar'] == $id_gambar) {
                // hapus record database
                $this->produk_gambar_model->hapus($id_gambar);

                // hapus file fisik jika ada
                $path = './uploads/produk/' . $gambar['nama_gambar'];

                if (file_exists($path)) {
                    unlink($path);
                }
                break;
            }
        }

        redirect('admin/produk/ubah/' . $id_produk);
    }

    /**
     * Ganti satu gambar produk tanpa mengubah gambar lain.
     * Gambar lama dihapus hanya setelah gambar baru berhasil diunggah.
     */
    public function ubah_gambar($id_gambar, $id_produk)
    {
        // ambil data gambar yang akan diganti
        $gambar_lama = NULL;

        $list_gambar = $this->produk_gambar_model->get_by_produk_id($id_produk);

        foreach ($list_gambar as $gambar) {
            if ($gambar['id_gambar'] == $id_gambar) {
                $gambar_lama = $gambar;
                break;
            }
        }

        // gambar tidak ditemukan, kembalikan ke halaman ubah produk
        if ($gambar_lama === NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>gambar tidak ditemukan!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            redirect('admin/produk/ubah/' . $id_produk);
        }

        // gambar baru dipilih lewat form?
        $ada_gambar_baru = FALSE;

        if (isset($_FILES['gambar_produk_baru']['name']) && !empty($_FILES['gambar_produk_baru']['name'])) {
            $ada_gambar_baru = TRUE;
        }

        // belum ada gambar baru dipilih: tampilkan form ubah gambar
        if (!$ada_gambar_baru) {
            $data['title'] = 'Ubah gambar produk';
            $data['produk'] = $this->produk_model->get_by_id($id_produk);
            $data['gambar'] = $gambar_lama;

            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/produk/ubah_gambar', $data);
            $this->load->view('administrator/templates/footer');

            return;
        }

        // upload gambar baru terlebih dahulu
        $_FILES['file']['name'] = $_FILES['gambar_produk_baru']['name'];
        $_FILES['file']['type'] = $_FILES['gambar_produk_baru']['type'];
        $_FILES['file']['tmp_name'] = $_FILES['gambar_produk_baru']['tmp_name'];
        $_FILES['file']['error'] = $_FILES['gambar_produk_baru']['error'];
        $_FILES['file']['size'] = $_FILES['gambar_produk_baru']['size'];

        $config['upload_path'] = 'uploads/produk/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '5000';
        $config['file_name'] = 'produk-' . $id_produk . '-' . time() . '-' . $id_gambar;
        $config['overwrite'] = FALSE;

        $this->load->library('upload', $config);

        // upload gagal: gambar lama tetap utuh, tidak ada yang dihapus
        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Gagal mengganti gambar!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            redirect('admin/produk/ubah/' . $id_produk);
        }

        // upload berhasil: simpan record gambar baru
        $uploadData = $this->upload->data();
        $filename = $uploadData['file_name'];

        $data = [
            'nama_gambar' => $filename,
            'produk_id' => $id_produk
        ];

        $this->produk_gambar_model->tambah($data);

        // hapus record dan file gambar lama
        $this->produk_gambar_model->hapus($id_gambar);

        $path_lama = './uploads/produk/' . $gambar_lama['nama_gambar'];

        if (file_exists($path_lama)) {
            unlink($path_lama);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil mengganti gambar!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        redirect('admin/produk/ubah/' . $id_produk);
    }

    public function hapus_produk($id)
    {
        // check apakah ada produk
        $produk = $this->produk_model->get_by_id($id);

        if ($produk) {
            // ambil data gambar
            $list_gambar = $this->produk_gambar_model->get_by_produk_id($id);

            foreach ($list_gambar as $gambar) {
                $id_gambar = $gambar['id_gambar'];
                $nama_gambar = $gambar['nama_gambar'];

                // hapus gambar di database
                $this->produk_gambar_model->hapus($id_gambar);

                // hapus gambar di file
                $path = './uploads/produk/' . $nama_gambar;

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // hapus produk di database
            $this->produk_model->hapus($id);

            $this->session->set_flashdata('message', '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil menghapus produk!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            redirect('admin/produk');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>produk tidak ditemukan!!</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            redirect('admin/produk');
        }
    }
}
