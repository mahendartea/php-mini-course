# Pertemuan 1: Pengenalan PHP & Instalasi

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami konsep dasar PHP dan kegunaannya
- Memahami cara kerja PHP sebagai server-side scripting
- Melakukan instalasi environment PHP
- Menulis dan menjalankan kode PHP pertama

## Materi Teori

### 1. Apa itu PHP?
PHP (PHP: Hypertext Preprocessor) adalah bahasa pemrograman server-side scripting yang dirancang khusus untuk pengembangan web. PHP dapat disisipkan ke dalam HTML dan berjalan di server sebelum halaman web dikirim ke browser pengguna.

### 2. Karakteristik PHP
- **Open Source**: Gratis dan bebas digunakan
- **Cross Platform**: Dapat berjalan di berbagai sistem operasi (Windows, Linux, macOS)
- **Server-Side**: Kode dieksekusi di server, bukan di browser
- **Embedded**: Dapat disisipkan langsung ke dalam HTML
- **Interpreted**: Tidak perlu kompilasi, langsung dijalankan

### 3. Kegunaan PHP
- Membuat website dinamis
- Mengelola database
- Membuat sistem login dan registrasi
- Menangani form HTML
- Mengupload file
- Membuat API web
- Mengelola session dan cookies

### 4. Cara Kerja PHP
1. **Request**: Browser mengirim request ke web server
2. **Processing**: Server memproses file PHP menggunakan PHP interpreter
3. **Response**: Server mengirim hasil (HTML) kembali ke browser
4. **Display**: Browser menampilkan halaman web

### 5. Instalasi Environment PHP

#### XAMPP (Cross-platform)
- Apache Web Server
- MySQL Database
- PHP
- phpMyAdmin

#### Laragon (Windows)
- Apache/Nginx
- MySQL/PostgreSQL
- PHP
- Node.js

#### MAMP (macOS)
- Apache
- MySQL
- PHP

### 6. Sintaks Dasar PHP

#### Tag PHP
PHP ditulis di antara tag khusus:
```php
<?php
// Kode PHP di sini
?>
```

#### Aturan Penulisan
- Setiap baris kode diakhiri dengan semicolon (;)
- PHP case-sensitive untuk nama variabel
- PHP tidak case-sensitive untuk keywords dan nama fungsi

## Praktikum

### Latihan 1: Hello World
File: `hello-world.php`

### Latihan 2: PHP Info
File: `info.php`

### Latihan 3: PHP dalam HTML
File: `hello-html.php`

## Tugas
1. Install salah satu environment PHP (XAMPP/Laragon/MAMP)
2. Buat file PHP yang menampilkan nama Anda
3. Jalankan file tersebut di browser

## Referensi
- [PHP Official Documentation](https://www.php.net/docs.php)
- [XAMPP Download](https://www.apachefriends.org/)
- [Laragon Download](https://laragon.org/)

---
**Pertemuan Selanjutnya**: Sintaks Dasar & Variabel
