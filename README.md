# About BizCycle
BizCycle adalah ekosistem bisnis yang menghubungkan supplier dan pembeli secara efisien. Supplier dapat dengan mudah mengelola dan mempromosikan produk mereka di platform ini, sementara pembeli dapat menemukan produk yang mereka butuhkan dengan cepat dan mudah. Dengan fitur pencarian berdasarkan supplier, Dapat menemukan produk spesifik dari merek yang dicari. Dapatkan diskon menarik untuk pembelian dalam jumlah banyak dan nikmati pengalaman belanja yang lebih menguntungkan.

## Requirements
<a href="https://laravel.com/docs/11.x/releases"><img src="https://img.shields.io/badge/laravel-v11-blue" alt="version laravel"></a>
<a href="https://www.php.net/releases/8.3.6/en.php"><img src="https://img.shields.io/badge/PHP-v8.3.6-blue" alt="version php"></a>

## Instalasi
- download zip <a href="https://github.com/michailtjhang/BizCycle/archive/refs/heads/master.zip">Klik disini</a> 
- atau clone di terminal :
    ```bash
    git clone https://github.com/michailtjhang/BizCycle.git
    ```

## Setup
- buka direktori project di terminal anda.
- ketikan command di terminal :
  ```bash
  copy .env.example .env
  ```
  untuk Linuk, ketikan command :
  ```bash
  cp .env.example .env
  ```
- instal package-package di laravel, ketikan command :
  ```bash
  composer install
  ```
- Generate app key, ketikan command :
  ```bash
  php artisan key:generate
  ```
### Command Run Website
- menjalanlan Laravel di website, ketikan command :
  ```bash
  php artisan serve
  ```
### Command Database
- buatlah nama database baru. Lalu sesuaikan nama database, username, dan password database di file `.env`, ketikan command :
  ```bash
  php artisan migrate
  ```
- memasukkan data table ke database, ketikan command :
  ```bash
  php artisan db:seed
  ```

## Akun Login
akun admin : email = admin@gmail.com, pw = 12345678

## Fitur
### Front End
- Login & Register

### Admin
- Halaman Dashboard
- Data Master (Table Supplier, Product)
- laporan Transaksi
- Buat Transaksi
- Role Permission
- Table User

### Supplier
- Halaman Dashboard
- Data Master (Table Product)

### User/Pembeli
- Halaman Dashboard
- Data Master (Table Supplier)
- Buat Transaksi
- laporan Transaksi

## Author
- **[Michail](https://github.com/michailtjhang)**

## Credits
- Template dari [AdminLTE](https://adminlte.io)

## License
MIT License