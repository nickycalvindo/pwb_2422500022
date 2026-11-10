# Catatan Implementasi PWB Pertemuan 9 — Front-End (Pelanggan)

Dokumen ini mencatat secara terbuka apa yang dikerjakan pada proyek **pwb_2422500022** untuk materi
**Pertemuan 9–10: Front-End (Pelanggan) — Produk, Profil, Registrasi, Login, Logout**, termasuk bagian
yang berasal langsung dari materi dosen dan bagian yang ditambahkan karena sumber tidak tersedia atau
karena tugas tambahan.

- Proyek: `C:\xampp\htdocs\pwb_2422500022`
- Framework: CodeIgniter 3.1.13, PHP 8.0.30 (XAMPP), database MySQL/MariaDB `pwb_2422500022`
- Materi: `PERTEMUAN 9-10 - FRONT END (PELANGGAN).pdf`
- Transkripsi kode materi: `PWB_Pertemuan_9_Transkripsi_dan_Perintah_Hermes.md`
- Tanggal implementasi: 10 November 2026

---

## 1. Implementasi yang sesuai materi dosen

Bagian berikut diambil dari kode pada materi/transkripsi dan dipertahankan sedekat mungkin dengan aslinya
(nama variabel, nama method, nama kolom, dan ejaan seperti `carausel`, `pelanggan_controller`,
`pelanggan_model`, `nopon`, `kodepos` tidak diubah).

### 1.1 Controller `application/controllers/Pelanggan_controller.php`

| Method | Status | Keterangan |
|---|---|---|
| `__construct()` | Sesuai materi | Memuat `pelanggan_model` |
| `login()` | Sesuai materi | Cek session `pelanggan_login`, `form_validation` required, render `ecom/template/header` + `ecom/pelanggan_login` + `ecom/template/footer` |
| `__login()` (private) | Sesuai materi | Password `md5()`, `check_login()`, set session `id`, `email`, `nama`, `pelanggan_login`, flashdata alert danger, `redirect('login')` |
| `register()` | Sesuai materi | 8 rule `required` (`nama`, `nopon`, `alamat`, `kota`, `kodepos`, `provinsi`, `email`, `password`) |
| `__register()` (private) | Sesuai materi | Tolak email terdaftar, `ucwords()` pada nama/alamat/kota/provinsi, `md5()` password, flashdata sukses/gagal/duplikat, `redirect('register')` |
| `logout()` | Sesuai materi | `unset_userdata(['id','email','nama','pelanggan_login'])` lalu `redirect(base_url())` |

Mekanisme password **tetap MD5** sesuai materi; tidak diubah dan tidak ditambah hashing lain.

### 1.2 Model `application/models/Pelanggan_model.php`

| Method | Status |
|---|---|
| `$_table = "pelanggan"` | Sesuai materi |
| `get_all()` | Sesuai materi |
| `tambah($data)` | Sesuai materi, mengembalikan `false` bila `affected_rows() != 1` |
| `get_by_id($id)` | Sesuai materi |
| `get_by_email($email)` | Sesuai materi |
| `check_login($email, $password)` | Sesuai materi |
| `ubah($data, $id)` | Sesuai materi (belum dipakai di halaman mana pun) |

### 1.3 Routes `application/config/routes.php` (bagian bawah)

```php
#pelanggan
$route['login'] = 'pelanggan_controller/login';
$route['register'] = 'pelanggan_controller/register';
$route['logout'] = 'pelanggan_controller/logout';
```

### 1.4 Dashboard `application/controllers/Dashboard.php`

Struktur `__construct()` yang memuat `produk_model`, `produk_kategori_model`, `produk_gambar_model`, serta
urutan render `header` → `carausel` → `home` → `footer` mengikuti materi.

### 1.5 Tabel `pelanggan`

Dibuat dengan kolom dan tipe data persis seperti tabel pada materi: `id_pelanggan` (int, PK, AUTO_INCREMENT),
`email`, `password`, `nama_pelanggan`, `telp_pelanggan`, `alamat`, `kota`, `kode_pos`, `provinsi`.
Tidak ada kolom tambahan.

### 1.6 Halaman view

`ecom/pelanggan_login.php` dan `ecom/pelanggan_register.php` memakai markup, name input, label, dan tombol
sesuai materi.

---

## 2. Penambahan di luar materi (rinci)

### 2.1 Template front-end: `header.php`, `carausel.php`, `home.php`, `footer.php`

| Komponen | Lokasi | Fungsi | Alasan | Wajib? |
|---|---|---|---|---|
| `header.php` | `application/views/ecom/template/` | Head, navbar, form pencarian, blok menu login/profil/logout, pembuka `container` | Materi hanya menyebut “copy baris 1–54 dari `index.html`”; file template Classroom tidak tersedia di mesin ini | Wajib agar halaman tampil |
| `carausel.php` | `application/views/ecom/template/` | Carousel 3 slide Bootstrap | Materi menyebut baris 57–97; isi asli tidak tersedia | Wajib untuk halaman utama sesuai struktur materi |
| `home.php` | `application/views/ecom/` | Menampilkan daftar produk dari database | Materi menyebut baris 99–136; isi asli tidak tersedia | Wajib |
| `footer.php` | `application/views/ecom/template/` | Penutup container, footer, pemuatan JavaScript | Materi menyebut baris 139–213; isi asli tidak tersedia | Wajib |

**Pernyataan terbuka:** keempat file di atas adalah **rekonstruksi**, bukan salinan template dosen. Sudah
dilakukan pencarian ulang pada 10 November 2026 di `D:\Penyimpanan Desktop\Unduhan`, `C:\Users\ASUS\Downloads`,
`C:\xampp\htdocs`, `D:\AI`, serta seluruh arsip `.zip`/`.rar` yang relevan; tidak ditemukan `index.html`
template e-commerce, folder `plugins/slick`, `styles.css` template, `scripts.js` template, maupun gambar
`stylish-men-s-shoes-still-life-men-s-accessories.jpg` dan `running-shoe-371625_640.jpg`.

### 2.2 Aset tambahan

| Komponen | Lokasi | Fungsi | Alasan | Wajib? |
|---|---|---|---|---|
| Bootstrap 5.3.3 (CSS + JS bundle) | `assets/plugins/bootstrap5/` | Kerangka tampilan halaman pelanggan | Markup materi memakai kelas Bootstrap 5 (`form-floating`, `btn-close`, `data-bs-dismiss`, `me-2`); aset proyek yang ada hanya Bootstrap 4.6.1 milik AdminLTE | Wajib agar form materi tampil benar |
| `styles.css` | `assets/css/styles.css` | Gaya tambahan (tinggi gambar carousel/kartu, latar halaman) | Materi merujuk `assets/css/styles.css`, tetapi file template aslinya tidak ada | Tambahan tampilan |
| `scripts.js` | `assets/js/scripts.js` | Mengaktifkan tooltip Bootstrap bila ada | Materi merujuk `assets/js/scripts.js`, file asli tidak ada | Tambahan (tidak memengaruhi fitur) |

Bootstrap 5 sengaja diletakkan di folder baru `assets/plugins/bootstrap5/` supaya **tidak menimpa**
`assets/plugins/bootstrap/` (Bootstrap 4.6.1) yang dipakai seluruh halaman administrator.

### 2.3 Controller, method, route, dan view tambahan

| Komponen | Lokasi | Fungsi | Alasan | Wajib? |
|---|---|---|---|---|
| Route `profil` | `application/config/routes.php` | `$route['profil'] = 'pelanggan_controller/profil';` | Tugas “buat menu Profil” tidak punya contoh route di PDF | Wajib untuk tugas |
| Method `profil()` | `Pelanggan_controller` | Cek session, ambil data dengan `get_by_id($id)` dari **session**, render view profil | Tugas Profil tanpa contoh kode di PDF | Wajib untuk tugas |
| View `pelanggan_profil.php` | `application/views/ecom/` | Menampilkan nama, email, telepon, alamat, kota, kode pos, provinsi | Tugas Profil | Wajib untuk tugas |
| Tombol/menu **Profil** | `views/ecom/template/header.php` | Tautan ke `base_url('profil')`, hanya muncul saat `pelanggan_login` aktif | Tugas Profil | Wajib untuk tugas |
| Filter pencarian `?q=` | `Dashboard::index()` | Menyaring `$list_produk` berdasarkan nama produk | Header memuat form pencarian; tanpa filter tombol Cari tidak berfungsi | Tambahan (opsional) |

### 2.4 Validasí dan pengamanan tambahan

| Komponen | Lokasi | Fungsi | Alasan | Wajib? |
|---|---|---|---|---|
| Pemeriksaan session pada `profil()` | `Pelanggan_controller::profil()` | Mengalihkan ke `login` bila `pelanggan_login` belum ada | Mencegah akses profil tanpa login | Wajib (kriteria tugas) |
| ID profil dari session | `Pelanggan_controller::profil()` | `$this->session->userdata('id')`, bukan dari URL/POST | Mencegah pelanggan melihat data akun lain | Wajib (kriteria tugas) |
| Penanganan data tidak ditemukan | `Pelanggan_controller::profil()` | Flashdata peringatan + hapus session + redirect ke `login` | Menghindari halaman kosong/error | Wajib (kriteria tugas) |
| `html_escape()` pada view | `home.php`, `header.php`, `pelanggan_profil.php` | Meng-escape output teks | Mencegah HTML/script injection dari data pengguna | Tambahan pengamanan |

Tidak ada penambahan `is_unique`, CAPTCHA, token CSRF, atau aturan validasi lain: validasi tetap
`required` seperti materi, dan `csrf_protection` tetap `FALSE` seperti konfigurasi proyek.

### 2.5 Perubahan tampilan/struktur HTML yang perlu diketahui

- `header.php` membuka `<div class="container my-4">`, `footer.php` menutupnya, sehingga view isi (login,
  register, profil, home) tidak perlu membuka container sendiri.
- Tombol **Keranjang** pada contoh header materi **tidak ditampilkan** karena route `keranjang` belum ada
  (di luar cakupan Pertemuan 9). Ini disengaja agar tidak ada tautan yang menuju halaman 404.
- Carousel dan kartu produk memakai gambar produk yang benar-benar ada di `uploads/produk/`, bukan nama
  gambar sepatu pada materi (file tersebut tidak tersedia).

---

## 3. Perubahan terhadap kode materi

### 3.1 `Dashboard.php` — tambahan `$title` dan filter pencarian

**Sebelum (materi):**

```php
public function index()
{
    $data['gambar_model'] = $this->produk_gambar_model;
    $data['list_produk'] = $this->produk_model->get_all();
    $this->load->view('ecom/template/header', $data);
    $this->load->view('ecom/template/carausel');
    $this->load->view('ecom/home', $data);
    $this->load->view('ecom/template/footer');
}
```

**Sesudah:**

```php
public function index()
{
    $data['title'] = 'Toko Online - PWB 2422500022';
    $data['gambar_model'] = $this->produk_gambar_model;
    $data['list_produk'] = $this->produk_model->get_all();

    // Filter sederhana untuk form pencarian pada header (parameter ?q=)
    $keyword = $this->input->get('q');
    if (!empty($keyword)) {
        $hasil = array();
        foreach ($data['list_produk'] as $produk) {
            if (stripos($produk['pd_nama'], $keyword) !== FALSE) {
                $hasil[] = $produk;
            }
        }
        $data['list_produk'] = $hasil;
    }

    $this->load->view('ecom/template/header', $data);
    $this->load->view('ecom/template/carausel');
    $this->load->view('ecom/home', $data);
    $this->load->view('ecom/template/footer');
}
```

**Alasan teknis:** `$title` dipakai `header.php` untuk `<title>`; filter `?q=` agar form pencarian pada
header tidak menjadi tombol mati. Keduanya dapat dihapus tanpa memengaruhi login/registrasi/profil.

### 3.2 `pelanggan_login.php` dan `pelanggan_register.php` — satu `</div>` berlebih dihapus

**Sebelum (akhir contoh pada materi, login):**

```html
        </main>
    </div>
</div>
</div>
```

**Sesudah:**

```html
        </main>
    </div>
</div>
```

**Alasan teknis:** contoh materi menutup satu `div` lebih banyak daripada yang dibuka. Bila dipertahankan,
container pembuka dari `header.php` ikut tertutup dan struktur HTML menjadi tidak seimbang. Hal yang sama
dilakukan pada bagian akhir `pelanggan_register.php`. Seluruh markup, name input, label, dan tombol tidak
diubah.

### 3.3 Referensi Bootstrap pada `header.php`/`footer.php`

**Materi (contoh):**

```html
<link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/fontawesome/js/all.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/slick/slick.css" />
```

**Sesudah (proyek ini):**

```html
<link href="<?= base_url() ?>assets/plugins/bootstrap5/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
...
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap5/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
```

**Alasan teknis:** `styles.css` template, `plugins/fontawesome/js/all.js`, `jquery-1.11.0.min.js`, dan
`plugins/slick/*` milik template Classroom tidak tersedia. Digunakan aset yang ada di proyek:
`fontawesome-free` (Font Awesome Free 6) dan `jquery.min.js`. Slick tidak dipakai karena carousel
direkonstruksi dengan komponen carousel Bootstrap.

### 3.4 Isi `carausel.php` dan `home.php`

Materi hanya menampilkan potongan contoh:

```html
<img src="<?= base_url() ?>assets/stylish-men-s-shoes-still-life-men-s-accessories.jpg" class="d-block w-100" alt="Shoes">
<img src="<?= base_url() ?>assets/running-shoe-371625_640.jpg" class="d-block w-100" alt="...">
```

**Sesudah:** gambar memakai file yang ada di proyek, contoh:

```html
<img src="<?= base_url() ?>uploads/produk/produk-8-1791627157-0.jpg" class="d-block w-100" alt="Dress Wanita Putih">
```

**Alasan teknis:** kedua file gambar pada materi tidak ada di mesin ini. Jika Nicky mengunduh template asli
dari Classroom, cukup mengganti path gambar dan menimpa keempat file template; controller, model, route,
dan database tidak perlu diubah.

---

## 4. Perubahan database

### 4.1 Struktur tabel `pelanggan` (sesuai materi)

| Kolom | Tipe | Null | Key | Default | Extra |
|---|---|---|---|---|---|
| `id_pelanggan` | int(11) | No | PRI | NULL | auto_increment |
| `email` | varchar(100) | No | | NULL | |
| `password` | varchar(100) | No | | NULL | |
| `nama_pelanggan` | varchar(100) | No | | NULL | |
| `telp_pelanggan` | varchar(100) | Yes | | NULL | |
| `alamat` | varchar(100) | No | | NULL | |
| `kota` | varchar(100) | No | | NULL | |
| `kode_pos` | int(11) | No | | NULL | |
| `provinsi` | varchar(100) | Yes | | NULL | |

Engine InnoDB, `utf8mb4`, collation `utf8mb4_unicode_ci`. Tidak ada foreign key (tidak diminta materi).

### 4.2 Hubungan dengan proses aplikasi

| Proses | Kolom yang dipakai |
|---|---|
| Registrasi (`__register`) | insert `email`, `password` (MD5), `nama_pelanggan`, `telp_pelanggan`, `alamat`, `kota`, `kode_pos`, `provinsi` |
| Cek email duplikat | `get_by_email($email)` → `email` |
| Login (`__login`) | `check_login($email, md5($password))` → `email` + `password`; hasil dipakai untuk session (`id_pelanggan`, `email`, `nama_pelanggan`) |
| Profil | `get_by_id($id)` dengan `id` dari session → `id_pelanggan` |
| Logout | tidak menyentuh database, hanya session |

### 4.3 Berkas SQL

`database/pwb_2422500022.sql` diperbarui agar dapat diimpor ulang menjadi database yang sama dengan
kondisi proyek: berisi 6 tabel (`administrator`, `kategori`, `kota2422500022`, `pelanggan`, `produk`,
`produk_gambar`) beserta data yang sudah ada sebelumnya, **tanpa** baris data pelanggan hasil pengujian.
Struktur tabel `pelanggan` sama dengan tabel pada materi (tanpa kolom tambahan). Tabel lain tidak diubah
dan datanya tidak dihapus dari database. Impor ulang dump ini sudah diuji pada database sementara
(`pwb_uji_import`) dan berhasil, lalu database sementara dihapus.

---

## 5. Fitur yang belum dikerjakan (di luar cakupan Pertemuan 9)

| Fitur | Alasan |
|---|---|
| Keranjang belanja | Tombol Keranjang disebut pada contoh header materi, tetapi route/controller/views keranjang tidak ada di Pertemuan 9. Tombol tidak ditampilkan agar tidak menuju 404. |
| Halaman detail produk | Tidak ada pada materi Pertemuan 9; kartu produk hanya menampilkan nama, kategori, harga, dan stok. |
| Ubah profil oleh pelanggan | Method `ubah()` pada model sudah disiapkan materi, tetapi form ubah profil tidak diminta. |
| Checkout / pembayaran / riwayat pesanan | Belum ada pada materi. |
| Lupa password / reset password | Belum ada pada materi. |
| Halaman toko berdasarkan kategori | Belum ada pada materi. |
| Slick slider dan Simple DataTables | Aset template tidak tersedia; carousel memakai Bootstrap. |

---

## 6. Catatan pengujian

Pengujian dilakukan pada localhost (`http://localhost/pwb_2422500022/`) dengan hasil sebagai berikut
(rincian lengkap ada pada laporan akhir):

- Seluruh file PHP lolos `php -l`.
- Halaman utama 200, produk diambil dari database, seluruh aset 200.
- Registrasi berhasil menyimpan ke tabel `pelanggan`; email duplikat ditolak.
- Login salah menampilkan pesan; login benar membuat session `pelanggan_login`.
- Profil hanya bisa diakses setelah login, menampilkan data pemilik session, tanpa password.
- Logout menghapus session dan mengembalikan menu Login/Register.
- Halaman administrator tetap meminta login (307 ke `/admin/login`).
- Tidak ada error PHP/MySQL pada halaman yang diuji.

## 7. Kesimpulan

Bagian inti Pertemuan 9 (produk, login, registrasi, logout, database pelanggan) mengikuti materi. Bagian
template front-end merupakan rekonstruksi karena file template Classroom tidak tersedia, dan menu Profil
merupakan implementasi tugas tanpa contoh kode pada PDF. Semua penambahan dan penyesuaian sudah dicatat
di dokumen ini agar dapat diperiksa dosen.