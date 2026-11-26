---
name: antislop
description: >-
  Enforces intentional, domain-authentic UI/UX craft and eliminates generic
  "AI slop" patterns across Zahran Kopi (Laravel + Blade + Tailwind CSS v4).
  Activate when designing, reviewing, or updating views, components, styles,
  or copy.
---

# Anti-Slop UI/UX & Engineering Skill

Panduan ini menjaga kualitas desain dan kode **Zahran Kopi** agar terasa autentik, rapi, nyaman dipakai di HP maupun laptop, dan bebas dari pola antarmuka generik buatan AI ("AI slop").

---

## 1. Anti-Slop Visual Rules (Larangan Pola Generik)

- **Hindari dekorasi klise**: Jangan menumpuk lingkaran `blur-3xl`, gradien ungu-biru generik yang menutupi keterbacaan teks, atau kartu bernomor `01 / 02 / 03 / 04` tanpa nilai informasi nyata.
- **Hierarki yang jelas**: Setiap halaman hanya boleh punya **1 fokus utama** di atas lipatan layar (*above the fold*). Bedakan dengan tegas antara elemen primer (CTA utama), sekunder, dan metadata.
- **Kedalaman yang tenang**: Gunakan permukaan bersih (`#FFFFFF`, `#FAF8F5`, `#F8F9FC`) dengan border halus `1px` (`border-slate-200/80` atau `border-[#E8E2D9]`) dan bayangan tipis. Hindari semua elemen memakai `rounded-3xl` + `shadow-xl` sekaligus.
- **Angka & harga presisi**: Selalu gunakan `tabular-nums` (`font-variant-numeric: tabular-nums`) pada harga (`Rp ...`), stok, dan angka statistik agar sejajar rapi.

## 2. Tipografi & Bahasa Produk (Copywriting)

- **Bahasa Indonesia natural & ringkas**: Tulis copy yang langsung pada inti manfaat untuk pembeli dan pelaku UMKM. Hindari kalimat berbunga-bunga atau pengulangan kata "modern / terbaik / terpercaya" di setiap paragraf.
- **Label konsisten**: Pertahankan istilah yang akrab bagi pengguna Indonesia (*Beranda*, *Katalog Produk*, *Stok Tersedia*, *Pesan via WhatsApp*).
- **Tanpa emoji berlebihan**: Gunakan ikon SVG yang konsisten dan proporsional; jangan menaburkan emoji di setiap judul atau tombol.

## 3. Ergonomi Lintas Perangkat (HP ke Laptop)

Website harus nyaman diakses mulai dari layar HP kecil (`360px–430px`), tablet (`768px`), hingga laptop/desktop (`1280px+`):

- **Target sentuh minimal 44px**: Tombol, tautan navigasi mobile, dan kontrol form wajib memiliki area sentuh nyaman (`min-h-[44px]`).
- **Navigasi mobile yang sigap**: Sediakan drawer/menu mobile yang mudah ditutup (tombol tutup, klik backdrop, atau tombol `Escape`) dan pencarian cepat yang langsung terjangkau ibu jari.
- **Strip kategori horizontal di mobile**: Untuk daftar kategori atau filter cepat di layar kecil, gunakan scroll horizontal (`overflow-x-auto snap-x`) agar pengguna tidak perlu menggulir terlalu jauh ke bawah.
- **Detail produk ramah HP**:
  - Gunakan tombol stepper `−` / `+` untuk jumlah pesanan (bukan hanya input angka kecil bawaan browser).
  - Tampilkan **sticky bottom bar** di layar mobile untuk CTA utama (*Hubungi Penjual via WhatsApp*) agar pembeli bisa langsung memesan kapan saja saat membaca deskripsi.
- **Tabel admin responsif**: Bungkus tabel dengan `overflow-x-auto` dan pertahankan kolom penting tetap terbaca di layar sempit.

## 4. Aksesibilitas & Micro-Interactions

- **Focus ring terlihat**: Pastikan elemen interaktif memakai `focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#6C4AB6]/40` agar navigasi keyboard jelas.
- **Hormati preferensi gerak**: Sertakan aturan `@media (prefers-reduced-motion: reduce)` di CSS.
- **Status kosong (*empty state*) yang membantu**: Saat pencarian produk tidak ditemukan, berikan alasan singkat dan tombol aksi untuk mereset filter.

## 5. Checklist Sebelum Selesai

1. Cek tampilan di viewport mobile (`375px`), tablet (`768px`), dan desktop (`1280px`).
2. Pastikan tidak ada *horizontal overflow* yang tidak disengaja pada `body`.
3. Jalankan `npm run build` untuk memastikan aset Tailwind v4 & JS terkompilasi tanpa error.
4. Pastikan test fitur tetap hijau (`php artisan test` / PHPUnit).
