# PWB 2422500022 — Toko Online Sederhana (CodeIgniter 3)

Proyek mata kuliah **Pemrograman Web Bisnis** (NIM 2422500022). Aplikasi terdiri dari dua sisi:

- **Administrator** (`/admin`): login admin, CRUD kategori, produk, gambar produk, dan data kota.
- **Pelanggan** (front-end, Pertemuan 9): halaman produk, registrasi, login, logout, dan menu profil.

## Teknologi

| Komponen | Versi / keterangan |
|---|---|
| Framework | CodeIgniter 3.1.13 |
| Bahasa | PHP 8.0.30 |
| Database | MySQL / MariaDB (XAMPP 10.4.x) |
| Web server | Apache (XAMPP) |
| Tampilan admin | AdminLTE 3 + Bootstrap 4.6.1 (aset lokal di `assets/`) |
| Tampilan pelanggan | Bootstrap 5.3.3 + Font Awesome Free (aset lokal di `assets/plugins/`) |
| JavaScript | jQuery 3.x (lokal) |

## Struktur folder penting

```text
pwb_2422500022/
├── application/
│   ├── config/            routes.php, database.php, config.php, autoload.php
│   ├── controllers/
│   │   ├── Dashboard.php              halaman utama pelanggan
│   │   ├── Pelanggan_controller.php   login, register, logout, profil
│   │   └── administrator/             controller sisi admin
│   ├── models/
│   │   ├── Pelanggan_model.php
│   │   ├── Produk_model.php
│   │   ├── Produk_gambar_model.php
│   │   └── Produk_kategori_model.php
│   └── views/
│       ├── administrator/             tampilan admin (AdminLTE)
│       └── ecom/                      tampilan pelanggan (Pertemuan 9)
│           ├── template/header.php
│           ├── template/carausel.php
│           ├── template/footer.php
│           ├── home.php
│           ├── pelanggan_login.php
│           ├── pelanggan_register.php
│           └── pelanggan_profil.php
├── assets/                aset AdminLTE + Bootstrap 5 + CSS/JS pelanggan
├── database/              dump SQL proyek
├── docs/                  catatan implementasi
└── uploads/produk/        gambar produk
```

## Kebutuhan

1. XAMPP (Apache + MySQL/MariaDB) dengan PHP 8.0 atau lebih baru.
2. Git (opsional, untuk clone repository).

## Instalasi

1. Clone / salin proyek ke document root XAMPP:

   ```bash
   git clone https://github.com/nickycalvindo/pwb_2422500022.git C:/xampp/htdocs/pwb_2422500022
   ```

2. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.

3. Buat database `pwb_2422500022` (boleh melalui phpMyAdmin), lalu impor
   `database/pwb_2422500022.sql`:

   ```bash
   C:/xampp/mysql/bin/mysql -u root -e "CREATE DATABASE IF NOT EXISTS pwb_2422500022"
   C:/xampp/mysql/bin/mysql -u root pwb_2422500022 < database/pwb_2422500022.sql
   ```

4. Sesuaikan konfigurasi bila lingkungan berbeda:

   | Berkas | Pengaturan |
   |---|---|
   | `application/config/database.php` | `hostname`, `username`, `password`, `database` |
   | `application/config/config.php` | `$config['base_url'] = 'http://localhost/pwb_2422500022/';` |
   | `.htaccess` | `RewriteBase /pwb_2422500022/` |

5. Pastikan folder `uploads/produk/` dapat ditulis (dipakai proses unggah gambar produk di admin).

## Menjalankan aplikasi

| Halaman | URL |
|---|---|
| Halaman utama pelanggan (produk) | `http://localhost/pwb_2422500022/` |
| Registrasi pelanggan | `http://localhost/pwb_2422500022/register` |
| Login pelanggan | `http://localhost/pwb_2422500022/login` |
| Profil pelanggan (setelah login) | `http://localhost/pwb_2422500022/profil` |
| Logout pelanggan | `http://localhost/pwb_2422500022/logout` |
| Login administrator | `http://localhost/pwb_2422500022/admin/login` |
| Dashboard administrator | `http://localhost/pwb_2422500022/admin` |

Akun pelanggan dibuat sendiri melalui halaman **Register**. Akun administrator tersimpan pada tabel
`administrator` (kelola melalui database; tidak ada kredensial yang dicantumkan di repository ini).

## Catatan penting

- Auth pelanggan memakai `md5()` sesuai materi kuliah dan session CodeIgniter (`pelanggan_login`).
  Ini bukan praktik yang dianjurkan untuk aplikasi produksi.
- Template front-end pelanggan (`header.php`, `carausel.php`, `home.php`, `footer.php`) merupakan
  **rekonstruksi** karena file template dari Classroom tidak tersedia saat pengerjaan. Rincian bagian
  yang sesuai materi dan yang direkonstruksi ada di
  [`docs/CATATAN_IMPLEMENTASI_PWB_PERTEMUAN_9.md`](docs/CATATAN_IMPLEMENTASI_PWB_PERTEMUAN_9.md).
- Fitur keranjang, detail produk, dan checkout belum termasuk cakupan Pertemuan 9 sehingga tidak
  ditampilkan di antarmuka.

## Lisensi

Kode framework CodeIgniter 3 mengikuti lisensi MIT (lihat `license.txt`). Kode aplikasi dibuat untuk
keperluan tugas mata kuliah.