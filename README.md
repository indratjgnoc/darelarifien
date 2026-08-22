<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Website Pesantren

Website Pesantren adalah aplikasi manajemen dan informasi pesantren berbasis web yang dibangun menggunakan **Laravel**. Aplikasi ini dirancang untuk membantu pengelolaan data pesantren sekaligus menyediakan informasi dan layanan bagi calon santri, santri, guru, dan pengelola pesantren.

Website menggunakan konsep desain modern dengan **warna hijau sebagai warna utama**, dipadukan dengan warna **hitam dan kuning** sebagai warna pendukung.

## ✨ Fitur Utama

### 🌐 Informasi Website

* 🏠 Halaman beranda
* 🕌 Profil pesantren
* 📢 Berita dan informasi
* 📅 Agenda kegiatan
* 🖼️ Galeri
* 📞 Informasi kontak
* 📍 Informasi lokasi pesantren
* 📄 Halaman informasi lainnya

### 📝 Pendaftaran Santri

* Formulir pendaftaran santri baru
* Pengisian data calon santri
* Upload dokumen persyaratan
* Informasi persyaratan pendaftaran
* Status pendaftaran
* Pengelolaan data pendaftar oleh admin
* Verifikasi data calon santri

### 👨‍🏫 Manajemen Guru

* Data guru
* Profil guru
* Data mata pelajaran
* Informasi pengajar
* Pengelolaan data guru oleh admin

### 👨‍🎓 Manajemen Santri

* Data santri
* Profil santri
* Informasi kelas
* Data akademik
* Pengelolaan data santri
* Status santri

### 👥 Role & Hak Akses

Aplikasi memiliki sistem role dan permission untuk membatasi akses berdasarkan jenis pengguna.

Contoh role:

| Role         | Akses                                                       |
| ------------ | ----------------------------------------------------------- |
| Admin        | Mengelola seluruh data dan fitur                            |
| Guru         | Mengakses fitur yang berkaitan dengan guru dan pembelajaran |
| Santri       | Mengakses informasi dan fitur khusus santri                 |
| Calon Santri | Mengakses dan mengelola proses pendaftaran                  |

> Role dapat disesuaikan dengan implementasi yang digunakan pada project.

### 📚 Manajemen Akademik

* Data kelas
* Data mata pelajaran
* Data guru
* Data santri
* Jadwal pembelajaran
* Pengelolaan data akademik

### 📰 Manajemen Konten

Admin dapat mengelola berbagai konten website, seperti:

* Berita
* Pengumuman
* Agenda
* Galeri
* Halaman informasi
* Banner
* Konten profil pesantren

### 📊 Dashboard

Dashboard admin menyediakan informasi ringkas mengenai data pesantren, seperti:

* Jumlah santri
* Jumlah guru
* Jumlah pendaftar
* Jumlah kelas
* Data pendaftaran terbaru
* Informasi aktivitas terbaru

## 🎨 Tampilan

Website menggunakan kombinasi warna:

* 🟢 **Hijau** — warna utama dan identitas pesantren
* ⚫ **Hitam** — warna pendukung untuk memberikan kontras
* 🟡 **Kuning** — warna aksen untuk menonjolkan informasi tertentu

Desain dibuat dengan pendekatan modern, sederhana, dan responsif sehingga dapat digunakan pada desktop maupun perangkat mobile.

## 🛠️ Teknologi

Project ini dibangun menggunakan:

* **Laravel**
* **PHP**
* **MySQL**
* **Blade**
* **HTML5**
* **CSS3**
* **JavaScript**
* **Bootstrap / Tailwind CSS**
* **Composer**
* **NPM**

> Sesuaikan daftar teknologi dengan teknologi yang benar-benar digunakan dalam project.

## 📋 Persyaratan

Sebelum menjalankan project, pastikan sudah terinstall:

* PHP
* Composer
* MySQL
* Node.js
* NPM
* Git

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/indratjgnoc/darelarifien.git
```

Masuk ke direktori project:

```bash
cd darelarifien
```

### 2. Install Dependency

Install dependency Laravel:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

### 3. Konfigurasi Environment

Copy `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian sesuaikan konfigurasi database:

```env
APP_NAME="Website Pesantren"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pesantren
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Membuat Database

Buat database MySQL, misalnya:

```text
pesantren
```

Kemudian jalankan migration:

```bash
php artisan migrate
```

Jika project memiliki seeder:

```bash
php artisan db:seed
```

atau:

```bash
php artisan migrate --seed
```

### 6. Storage Link

Jika aplikasi menggunakan upload gambar atau dokumen:

```bash
php artisan storage:link
```

### 7. Jalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

Untuk menjalankan frontend:

```bash
npm run dev
```

## 📁 Struktur Project

```text
website-pesantren/
├── app/
│   ├── Http/
│   ├── Models/
│   └── ...
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── web.php
│   └── ...
├── storage/
├── tests/
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
└── README.md
```

## 🔐 Keamanan

Informasi sensitif tidak boleh dimasukkan ke repository.

File `.env` harus masuk ke `.gitignore`:

```gitignore
.env
.env.local
.env.production
```

Gunakan `.env.example` sebagai template konfigurasi:

```env
APP_NAME="Website Pesantren"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## 👤 Sistem Role

Sistem role digunakan untuk mengatur hak akses setiap pengguna.

Contoh alur:

```text
                    Website Pesantren
                           │
             ┌─────────────┼─────────────┐
             │             │             │
           Admin          Guru          Santri
             │             │             │
       ┌─────┴─────┐       │             │
       │           │       │             │
    Kelola      Verifikasi  Akademik    Profil
     Data       Pendaftaran  & Kelas     & Data
```

Setiap role hanya dapat mengakses fitur sesuai dengan hak akses yang diberikan.

## 📌 Modul Sistem

Secara umum aplikasi terdiri dari beberapa modul:

```text
Website Pesantren
│
├── Landing Page
│   ├── Beranda
│   ├── Profil
│   ├── Berita
│   ├── Agenda
│   ├── Galeri
│   └── Kontak
│
├── Pendaftaran
│   ├── Form Pendaftaran
│   ├── Data Pendaftar
│   ├── Upload Dokumen
│   └── Verifikasi
│
├── Akademik
│   ├── Santri
│   ├── Guru
│   ├── Kelas
│   ├── Mata Pelajaran
│   └── Jadwal
│
└── Dashboard
    ├── User
    ├── Role
    ├── Konten
    ├── Pendaftaran
    └── Data Pesantren
```

## 📱 Responsive Design

Website dirancang agar dapat digunakan pada berbagai perangkat:

* 💻 Desktop
* 💻 Laptop
* 📱 Tablet
* 📱 Smartphone

## 🧑‍💻 Development

Untuk menjalankan project dalam mode development:

```bash
php artisan serve
```

Pada terminal lain:

```bash
npm run dev
```

## 📄 License

Project ini dikembangkan untuk kebutuhan pengelolaan dan penyediaan informasi pesantren.
Jika ada saran silahkan pull requests
