<?php

/**
 * Pertemuan 2: Demo Variabel
 * File: variabel-demo.php
 *
 * Mendemonstrasikan berbagai tipe variabel dan cara penggunaannya
 */

echo "<h1>Demo Variabel PHP</h1>";

// 1. Variabel String
echo "<h2>1. Variabel String</h2>";
$nama_depan = "Ahmad";
$nama_belakang = "Wijaya";
$nama_lengkap = $nama_depan . " " . $nama_belakang;

echo "Nama depan: $nama_depan<br>";
echo "Nama belakang: $nama_belakang<br>";
echo "Nama lengkap: $nama_lengkap<br>";

// 2. Variabel Integer
echo "<h2>2. Variabel Integer</h2>";
$umur = 25;
$tahun_lahir = 2024 - $umur;

echo "Umur: $umur tahun<br>";
echo "Tahun lahir: $tahun_lahir<br>";

// 3. Variabel Float
echo "<h2>3. Variabel Float</h2>";
$tinggi = 175.5;
$berat = 70.25;
$bmi = $berat / (($tinggi / 100) * ($tinggi / 100));

echo "Tinggi: $tinggi cm<br>";
echo "Berat: $berat kg<br>";
echo "BMI: " . number_format($bmi, 2) . "<br>";

// 4. Variabel Boolean
echo "<h2>4. Variabel Boolean</h2>";
$is_student = true;
$is_married = false;

echo "Status mahasiswa: " . ($is_student ? "Ya" : "Tidak") . "<br>";
echo "Status menikah: " . ($is_married ? "Ya" : "Tidak") . "<br>";

// 5. Variabel Null
echo "<h2>5. Variabel Null</h2>";
$alamat = null;
$telepon = null;

echo "Alamat: " . ($alamat ?? "Belum diisi") . "<br>";
echo "Telepon: " . ($telepon ?? "Belum diisi") . "<br>";

// 6. Cek tipe data variabel
echo "<h2>6. Cek Tipe Data</h2>";
echo "Tipe data nama: " . gettype($nama_depan) . "<br>";
echo "Tipe data umur: " . gettype($umur) . "<br>";
echo "Tipe data tinggi: " . gettype($tinggi) . "<br>";
echo "Tipe data status: " . gettype($is_student) . "<br>";
echo "Tipe data alamat: " . gettype($alamat) . "<br>";

// 7. Variabel Reference
echo "<h2>7. Variabel Reference</h2>";
$a = 100;
$b = &$a; // $b adalah reference ke $a

echo "Nilai a: $a<br>";
echo "Nilai b: $b<br>";

$a = 200; // Mengubah $a akan mengubah $b juga
echo "Setelah a diubah menjadi 200:<br>";
echo "Nilai a: $a<br>";
echo "Nilai b: $b<br>";

// 8. Variabel Variabel (Variable Variables)
echo "<h2>8. Variable Variables</h2>";
$nama_var = "greeting";
$$nama_var = "Halo Dunia!"; // Sama dengan $greeting = "Halo Dunia!";

echo "Variable variables: $greeting<br>";

// 9. Konstanta
echo "<h2>9. Konstanta</h2>";
define("NAMA_APLIKASI", "Sistem Biodata");
const VERSION = "1.0.0";

echo "Nama aplikasi: " . NAMA_APLIKASI . "<br>";
echo "Versi: " . VERSION . "<br>";

// 10. Predefined Variables
echo "<h2>10. Predefined Variables</h2>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "OS: " . PHP_OS . "<br>";
echo "Script name: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "Server name: " . $_SERVER['SERVER_NAME'] . "<br>";
