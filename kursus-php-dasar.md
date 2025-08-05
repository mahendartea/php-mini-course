# Mini Course: Belajar PHP Dasar (Fundamental) dalam 10 Pertemuan

Selamat datang di kursus singkat **Belajar PHP Dasar**! Kursus ini terdiri dari 10 pertemuan dengan penjelasan konsep dan studi kasus yang langsung dipraktikkan secara bertahap. Cocok untuk pemula yang ingin memahami dasar-dasar PHP dan langsung mengaplikasikannya.

---

## Daftar Pertemuan

1. [Pengenalan PHP & Instalasi](#pertemuan-1)
2. [Sintaks Dasar & Variabel](#pertemuan-2)
3. [Operator dan Tipe Data](#pertemuan-3)
4. [Percabangan (If/Else/Switch)](#pertemuan-4)
5. [Perulangan (Looping)](#pertemuan-5)
6. [Fungsi (Function)](#pertemuan-6)
7. [Array & Manipulasinya](#pertemuan-7)
8. [Form Input & Validasi Dasar](#pertemuan-8)
9. [Dasar Pemrograman Berbasis File](#pertemuan-9)
10. [Mini Proyek: Aplikasi Daftar Kontak Sederhana](#pertemuan-10)

---

## <a name="pertemuan-1"></a>Pertemuan 1: Pengenalan PHP & Instalasi

**Materi:**
- Apa itu PHP?
- Kegunaan PHP dalam pengembangan web.
- Cara kerja PHP (Server-Side Scripting).
- Instalasi XAMPP/Laragon/MAMP.
- Menulis kode PHP pertama: `Hello World`.

**Studi Kasus:**  
Membuat file `index.php` yang menampilkan "Hello, Dunia!" di browser.

```php
<?php
echo "Hello, Dunia!";
?>
```

---

## <a name="pertemuan-2"></a>Pertemuan 2: Sintaks Dasar & Variabel

**Materi:**
- Tag pembuka & penutup PHP.
- Komentar pada PHP.
- Variabel dan aturan penamaan.
- Menampilkan nilai variabel.

**Studi Kasus:**  
Buat file `biodata.php` yang menampilkan nama dan umur menggunakan variabel.

```php
<?php
$nama = "Budi";
$umur = 20;

echo "Nama: $nama <br>";
echo "Umur: $umur tahun";
?>
```

---

## <a name="pertemuan-3"></a>Pertemuan 3: Operator dan Tipe Data

**Materi:**
- Tipe data (string, integer, float, boolean).
- Operator aritmatika, perbandingan, dan logika.

**Studi Kasus:**  
Buat file `kalkulator.php` untuk menjumlahkan dua angka.

```php
<?php
$a = 5;
$b = 3;
$hasil = $a + $b;

echo "$a + $b = $hasil";
?>
```

---

## <a name="pertemuan-4"></a>Pertemuan 4: Percabangan (If/Else/Switch)

**Materi:**
- If, else, elseif.
- Switch case.

**Studi Kasus:**  
Buat file `cek-nilai.php` untuk menentukan lulus/tidaknya nilai siswa.

```php
<?php
$nilai = 75;

if($nilai >= 70){
    echo "Lulus";
} else {
    echo "Tidak Lulus";
}
?>
```

---

## <a name="pertemuan-5"></a>Pertemuan 5: Perulangan (Looping)

**Materi:**
- For, while, do-while.
- Foreach untuk array.

**Studi Kasus:**  
Buat file `tabel-perkalian.php` untuk menampilkan tabel perkalian 1-10.

```php
<?php
for($i = 1; $i <= 10; $i++){
    echo "5 x $i = " . (5 * $i) . "<br>";
}
?>
```

---

## <a name="pertemuan-6"></a>Pertemuan 6: Fungsi (Function)

**Materi:**
- Cara membuat dan memanggil fungsi.
- Parameter dan return value.

**Studi Kasus:**  
Buat file `luas-persegi.php` yang menghitung luas persegi dengan fungsi.

```php
<?php
function luasPersegi($sisi){
    return $sisi * $sisi;
}

echo "Luas persegi dengan sisi 4 = " . luasPersegi(4);
?>
```

---

## <a name="pertemuan-7"></a>Pertemuan 7: Array & Manipulasinya

**Materi:**
- Membuat array, menambah, menghapus, mengakses data array.
- Array asosiatif dan multidimensi.

**Studi Kasus:**  
Buat file `daftar-nama.php` untuk menampilkan daftar nama dengan foreach.

```php
<?php
$nama = ["Budi", "Ani", "Siti"];

foreach($nama as $n){
    echo $n . "<br>";
}
?>
```

---

## <a name="pertemuan-8"></a>Pertemuan 8: Form Input & Validasi Dasar

**Materi:**
- Membaca data dari form (GET dan POST).
- Validasi sederhana pada input.

**Studi Kasus:**  
Buat file `form-nama.php` yang menerima nama dari form lalu menampilkannya.

```php
<!-- form-nama.html -->
<form method="POST" action="proses-nama.php">
  Nama: <input type="text" name="nama">
  <input type="submit" value="Kirim">
</form>
```

```php
<?php
// proses-nama.php
if(isset($_POST['nama']) && $_POST['nama'] != ""){
    echo "Halo, " . htmlspecialchars($_POST['nama']);
} else {
    echo "Nama wajib diisi!";
}
?>
```

---

## <a name="pertemuan-9"></a>Pertemuan 9: Dasar Pemrograman Berbasis File

**Materi:**
- Membaca dan menulis file dengan PHP.
- File handling (fopen, fwrite, fread, fclose).

**Studi Kasus:**  
Buat file `tulis-file.php` untuk menulis data ke file teks.

```php
<?php
$file = fopen("data.txt", "w");
fwrite($file, "Ini adalah data yang ditulis dengan PHP.");
fclose($file);
echo "Data berhasil ditulis ke file.";
?>
```

---

## <a name="pertemuan-10"></a>Pertemuan 10: Mini Proyek - Aplikasi Daftar Kontak Sederhana

**Materi:**
- Menggabungkan materi yang telah dipelajari.
- Membuat aplikasi sederhana untuk menyimpan, menampilkan, dan menghapus data kontak (nama & nomor telepon) menggunakan file txt.

**Studi Kasus:**  
### Fitur:
- Form tambah kontak
- Tampilkan daftar kontak
- Hapus kontak

**Contoh Alur Sederhana:**
1. Form input nama & nomor.
2. Data disimpan ke `kontak.txt`.
3. Daftar kontak ditampilkan dari file.
4. Setiap kontak bisa dihapus.

**Contoh kode dan penjelasan dapat dilihat pada repository ini.**

---

## Penutup

Kamu telah menyelesaikan kursus singkat PHP Dasar! Lanjutkan latihan dengan membuat studi kasus lain seperti aplikasi daftar tugas, buku tamu, dll. Jangan ragu untuk mengembangkan dari contoh yang sudah ada. Selamat belajar!

---

> **Sumber dan hak cipta:** Bebas digunakan untuk pembelajaran.  
> Untuk diskusi dan update, kunjungi: [GitHub](https://github.com/mahendartea)
