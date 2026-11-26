# Zahran Kopi — Marketplace UMKM Indonesia

**Zahran Kopi** adalah aplikasi web marketplace UMKM modern berbasis **Laravel 13**, **PHP 8.3**, **MySQL**, **Tailwind CSS v4**, dan **JavaScript**. Website ini dirancang untuk membantu pelaku UMKM memasarkan produk unggulan mereka secara online dengan tampilan bersih, elegan, responsif, dan terhubung langsung ke WhatsApp penjual.

---

## Identitas & Konsep Visual

- **Nama Brand:** `Zahran Kopi`
- **Bahasa Antarmuka:** Bahasa Indonesia
- **Palet Warna:**
  - Primary: `#6C4AB6` (Ungu Modern)
  - Secondary: `#FFFFFF` (Putih)
  - Accent: `#FF9F43` (Orange)
  - Background: `#F8F9FC` (Abu-abu Sangat Muda)
  - Text: `#20243A` (Dark Navy)

---

## Fitur Utama

### Halaman Publik
- **Beranda (`/`):** Navbar dengan logo `Zahran Kopi`, Hero section, Kategori Produk, Produk Unggulan, Produk Terbaru, Keunggulan Berbelanja, dan Footer informasi usaha & media sosial.
- **Katalog Produk (`/produk`):** Daftar produk dari database MySQL lengkap dengan pencarian (`q`), filter kategori (`kategori`), pengurutan harga/terbaru, dan pagination.
- **Detail Produk (`/produk/{slug}`):** Foto produk besar, nama, harga, kategori, stok, deskripsi lengkap, pemilih jumlah, tombol **Hubungi Penjual via WhatsApp**, serta rekomendasi produk terkait.
- **Kategori (`/kategori` & `/kategori/{slug}`):** Direktori kategori produk beserta ikon dan daftar produk per kategori.
- **Tentang Kami (`/tentang-kami`):** Profil usaha, visi, misi, tujuan, dan manfaat `Zahran Kopi` bagi UMKM.
- **Kontak (`/kontak`):** Informasi kontak resmi (email, WhatsApp, alamat usaha) dan formulir pesan dengan validasi server-side Bahasa Indonesia.

### Dashboard Admin (`/admin`)
- **Autentikasi Admin:** Login & Logout aman menggunakan Laravel Auth, password hashing (`Hash`), proteksi CSRF, dan middleware `admin`.
- **Dashboard Statistik:** Ringkasan total produk, total kategori, total stok, produk stok menipis, dan pesan masuk.
- **CRUD Produk:** Tambah, tampil, ubah, dan hapus produk beserta upload gambar (`JPG`, `JPEG`, `PNG`, `WEBP`, maks 2 MB) ke `storage/app/public/products`. Gambar lama otomatis terhapus saat diganti atau saat produk dihapus.
- **CRUD Kategori:** Tambah, tampil, ubah, dan hapus kategori dengan validasi slug unik dan perlindungan kategori yang masih memiliki produk.
- **Manajemen Pesan Kontak:** Melihat pesan pengunjung dan menandai status terbaca.

---

## Teknologi yang Digunakan

- **Backend:** PHP 8.3, Laravel Framework 13
- **Database:** MySQL (Eloquent ORM dengan relasi `Category hasMany Product` & `Product belongsTo Category`)
- **Frontend:** Blade Templates, Tailwind CSS v4, Vite, Vanilla JavaScript
- **Package Manager:** Composer & NPM
- **Version Control:** Git & GitHub

---

## Panduan Instalasi Lokal

1. **Clone repository atau buka folder project:**
   ```bash
   git clone https://github.com/<username-anda>/zahran-kopi.git
   cd zahran-kopi
   ```

2. **Install dependensi PHP dan Node.js:**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Salin file konfigurasi environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database MySQL di `.env`:**
   Buat database `zahrankopi` di MySQL, lalu pastikan konfigurasi `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=zahrankopi
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrasi, Seeder, dan Storage Link:**
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

6. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Akses website di `http://127.0.0.1:8000`.

### Akun Demo Administrator (Hasil Seeder)
- **URL Login:** `http://127.0.0.1:8000/admin/login`
- **Email:** `admin@zahrankopi.id`
- **Kata Sandi:** `AdminZahranKopi123!`

---

## Panduan Menghubungkan ke GitHub (`zahran-kopi`)

1. Buat repository baru bernama **`zahran-kopi`** di akun GitHub Anda (tanpa README/gitignore tambahan).
2. Hubungkan repository lokal ke GitHub dan push branch `main`:
   ```bash
   git remote add origin https://github.com/<username-anda>/zahran-kopi.git
   git branch -M main
   git push -u origin main
   ```

---

## Pengujian Otomatis

Jalankan seluruh pengujian fitur dengan PHPUnit:
```bash
php artisan test
```
