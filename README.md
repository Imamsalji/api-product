# Clone Proyek Laravel dari GitHub

Panduan ini akan membantu Anda untuk meng-clone proyek Laravel dari GitHub dan menginstal semua dependensi yang diperlukan.

## Prasyarat

Sebelum memulai, pastikan Anda memiliki beberapa alat berikut yang terpasang di sistem Anda:

- **PHP**: Laravel membutuhkan PHP versi 7.3 atau lebih tinggi.
- **Composer**: Composer digunakan untuk mengelola dependensi PHP https://getcomposer.org/download/.
- **Git**: Digunakan untuk meng-clone repositori dari GitHub.
- **Database**: MySQL atau database lain yang didukung Laravel.

## Cara instalasi dan menjalankan Projek

1. Clone repository menggunakan cmd/terminal

```
git clone https://github.com/Imamsalji/api-product.git
```

2. Arahkan ke folder yang sudah di clone

```
cd api-product
```

3. Menginstal dependensi menggunakan cmd/terminal 

```
npm install
```

4. Konfigurasi file

```
.env
```

5. Generate kunci aplikasi dengan

```
php artisan key:generate
```

6. Menjalankan migrasi database

```
php artisan migrate --seed
```

7. Jalankan aplikasi dengan cmd/terminal 

```
php artisan serve
```

Jalankan api dengan http://127.0.0.1:8000/api/
