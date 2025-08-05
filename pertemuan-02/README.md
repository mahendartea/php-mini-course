# Pertemuan 2: Sintaks Dasar & Variabel

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami sintaks dasar PHP
- Menggunakan komentar dengan benar
- Membuat dan menggunakan variabel
- Memahami aturan penamaan variabel
- Menampilkan nilai variabel

## Materi Teori

### 1. Tag PHP
PHP memiliki beberapa cara penulisan tag:

#### Tag Standar (Recommended)
```php
<?php
// kode PHP
?>
```

#### Tag Pendek (Short Tag)
```php
<?
// kode PHP
?>
```
*Tidak disarankan karena tidak selalu aktif*

#### Tag Echo Pendek
```php
<?= $variabel ?>
```
*Setara dengan <?php echo $variabel; ?>*

### 2. Komentar dalam PHP

#### Komentar Satu Baris
```php
// Ini komentar satu baris
# Ini juga komentar satu baris
```

#### Komentar Multi Baris
```php
/*
Ini adalah komentar
yang terdiri dari
beberapa baris
*/
```

#### Komentar Dokumentasi
```php
/**
 * Ini adalah komentar dokumentasi
 * @param string $nama Parameter nama
 * @return string Hasil greeting
 */
```

### 3. Variabel dalam PHP

#### Definisi Variabel
- Variabel dalam PHP dimulai dengan tanda `$`
- Diikuti oleh nama variabel
- PHP adalah bahasa yang case-sensitive untuk variabel

#### Aturan Penamaan Variabel
1. **Harus dimulai dengan huruf atau underscore (_)**
   - ✅ `$nama`, `$_umur`, `$firstName`
   - ❌ `$1nama`, `$-umur`

2. **Hanya boleh berisi huruf, angka, dan underscore**
   - ✅ `$nama_lengkap`, `$umur25`
   - ❌ `$nama-lengkap`, `$umur@25`

3. **Case sensitive**
   - `$nama` ≠ `$Nama` ≠ `$NAMA`

4. **Tidak boleh menggunakan kata kunci PHP**
   - ❌ `$class`, `$function`, `$if`

#### Konvensi Penamaan
- **camelCase**: `$namaLengkap`, `$umurSiswa`
- **snake_case**: `$nama_lengkap`, `$umur_siswa`
- **PascalCase**: `$NamaLengkap` (biasanya untuk class)

### 4. Tipe Data Variabel

#### String
```php
$nama = "Budi";
$alamat = 'Jakarta';
```

#### Integer
```php
$umur = 25;
$jumlah = -10;
```

#### Float
```php
$tinggi = 170.5;
$berat = 65.25;
```

#### Boolean
```php
$aktif = true;
$lulus = false;
```

#### Null
```php
$kosong = null;
```

### 5. Menampilkan Variabel

#### Menggunakan echo
```php
echo $nama;
echo "Nama saya: " . $nama;
echo "Nama saya: $nama";
```

#### Menggunakan print
```php
print $nama;
print "Nama saya: $nama";
```

#### Menggunakan var_dump()
```php
var_dump($nama); // Menampilkan tipe dan nilai
```

#### Menggunakan print_r()
```php
print_r($nama); // Menampilkan nilai (untuk array/object)
```

### 6. Interpolasi String
```php
$nama = "Budi";
$umur = 25;

// Double quotes - interpolasi aktif
echo "Nama: $nama, Umur: $umur";

// Single quotes - interpolasi tidak aktif
echo 'Nama: $nama, Umur: $umur'; // Output: Nama: $nama, Umur: $umur

// Concatenation
echo "Nama: " . $nama . ", Umur: " . $umur;
```

### 7. Konstanta
```php
// Menggunakan define()
define("NAMA_SEKOLAH", "SMA Negeri 1");

// Menggunakan const (PHP 5.3+)
const PI = 3.14159;

echo NAMA_SEKOLAH;
echo PI;
```

## Praktikum

### Latihan 1: Biodata Sederhana
File: `biodata.php`

### Latihan 2: Bermain dengan Variabel
File: `variabel-demo.php`

### Latihan 3: Interpolasi String
File: `string-interpolasi.php`

## Best Practices
1. Gunakan nama variabel yang deskriptif
2. Konsisten dengan konvensi penamaan
3. Gunakan komentar untuk menjelaskan kode kompleks
4. Inisialisasi variabel sebelum digunakan
5. Gunakan konstanta untuk nilai yang tidak berubah

## Tugas
1. Buat file PHP yang berisi biodata lengkap Anda
2. Gunakan berbagai tipe data (string, integer, float, boolean)
3. Tampilkan biodata dengan format yang rapi
4. Gunakan komentar untuk menjelaskan setiap bagian kode

---
**Pertemuan Sebelumnya**: Pengenalan PHP & Instalasi
**Pertemuan Selanjutnya**: Operator dan Tipe Data
