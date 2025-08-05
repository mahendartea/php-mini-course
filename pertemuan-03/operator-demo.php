<?php

/**
 * Pertemuan 3: Demo Operator
 * File: operator-demo.php
 *
 * Mendemonstrasikan berbagai jenis operator dalam PHP
 */

echo "<h1>Demo Berbagai Operator PHP</h1>";

// Data untuk demonstrasi
$a = 10;
$b = 3;
$nama = "Budi";
$aktif = true;

echo "<h2>Data Awal:</h2>";
echo "a = $a<br>";
echo "b = $b<br>";
echo "nama = '$nama'<br>";
echo "aktif = " . ($aktif ? 'true' : 'false') . "<br><br>";

// 1. Operator Aritmatika
echo "<h2>1. Operator Aritmatika</h2>";
echo "a + b = " . ($a + $b) . "<br>";
echo "a - b = " . ($a - $b) . "<br>";
echo "a * b = " . ($a * $b) . "<br>";
echo "a / b = " . ($a / $b) . "<br>";
echo "a % b = " . ($a % $b) . "<br>";
echo "a ** b = " . ($a ** $b) . " (10 pangkat 3)<br><br>";

// 2. Operator Assignment
echo "<h2>2. Operator Assignment</h2>";
$x = 20;
echo "x = $x<br>";

$x += 5;
echo "x += 5, sekarang x = $x<br>";

$x -= 3;
echo "x -= 3, sekarang x = $x<br>";

$x *= 2;
echo "x *= 2, sekarang x = $x<br>";

$x /= 4;
echo "x /= 4, sekarang x = $x<br>";

$x %= 7;
echo "x %= 7, sekarang x = $x<br><br>";

// 3. Operator Increment/Decrement
echo "<h2>3. Operator Increment/Decrement</h2>";
$counter = 5;
echo "counter = $counter<br>";
echo "++counter = " . (++$counter) . " (pre-increment)<br>";
echo "counter sekarang = $counter<br>";
echo "counter++ = " . ($counter++) . " (post-increment)<br>";
echo "counter sekarang = $counter<br>";
echo "--counter = " . (--$counter) . " (pre-decrement)<br>";
echo "counter-- = " . ($counter--) . " (post-decrement)<br>";
echo "counter sekarang = $counter<br><br>";

// 4. Operator Perbandingan
echo "<h2>4. Operator Perbandingan</h2>";
$p = 10;
$q = "10";
$r = 15;

echo "p = $p (integer)<br>";
echo "q = '$q' (string)<br>";
echo "r = $r (integer)<br><br>";

echo "p == q: " . ($p == $q ? 'true' : 'false') . " (equal)<br>";
echo "p === q: " . ($p === $q ? 'true' : 'false') . " (identical)<br>";
echo "p != r: " . ($p != $r ? 'true' : 'false') . " (not equal)<br>";
echo "p !== q: " . ($p !== $q ? 'true' : 'false') . " (not identical)<br>";
echo "p < r: " . ($p < $r ? 'true' : 'false') . " (less than)<br>";
echo "p > r: " . ($p > $r ? 'true' : 'false') . " (greater than)<br>";
echo "p <= q: " . ($p <= $q ? 'true' : 'false') . " (less than or equal)<br>";
echo "p >= q: " . ($p >= $q ? 'true' : 'false') . " (greater than or equal)<br>";

// Spaceship operator (PHP 7+)
echo "p <=> q: " . ($p <=> $q) . " (spaceship: 0=equal, -1=less, 1=greater)<br>";
echo "p <=> r: " . ($p <=> $r) . " (spaceship)<br><br>";

// 5. Operator Logika
echo "<h2>5. Operator Logika</h2>";
$benar1 = true;
$benar2 = true;
$salah1 = false;
$salah2 = false;

echo "benar1 = " . ($benar1 ? 'true' : 'false') . "<br>";
echo "benar2 = " . ($benar2 ? 'true' : 'false') . "<br>";
echo "salah1 = " . ($salah1 ? 'true' : 'false') . "<br>";
echo "salah2 = " . ($salah2 ? 'true' : 'false') . "<br><br>";

echo "benar1 && benar2: " . ($benar1 && $benar2 ? 'true' : 'false') . " (AND)<br>";
echo "benar1 && salah1: " . ($benar1 && $salah1 ? 'true' : 'false') . " (AND)<br>";
echo "benar1 || salah1: " . ($benar1 || $salah1 ? 'true' : 'false') . " (OR)<br>";
echo "salah1 || salah2: " . ($salah1 || $salah2 ? 'true' : 'false') . " (OR)<br>";
echo "!benar1: " . (!$benar1 ? 'true' : 'false') . " (NOT)<br>";
echo "!salah1: " . (!$salah1 ? 'true' : 'false') . " (NOT)<br>";
echo "benar1 xor salah1: " . ($benar1 xor $salah1 ? 'true' : 'false') . " (XOR)<br>";
echo "benar1 xor benar2: " . ($benar1 xor $benar2 ? 'true' : 'false') . " (XOR)<br><br>";

// 6. Operator String
echo "<h2>6. Operator String</h2>";
$depan = "Budi";
$belakang = "Santoso";
$lengkap = $depan . " " . $belakang;

echo "depan = '$depan'<br>";
echo "belakang = '$belakang'<br>";
echo "lengkap = depan . ' ' . belakang = '$lengkap'<br>";

$pesan = "Halo ";
$pesan .= $depan;
echo "pesan setelah concatenation assignment: '$pesan'<br><br>";

// 7. Operator Ternary
echo "<h2>7. Operator Ternary</h2>";
$umur = 17;
$status = ($umur >= 18) ? "Dewasa" : "Anak-anak";
echo "Umur: $umur tahun<br>";
echo "Status: $status<br>";

$nilai = 85;
$grade = ($nilai >= 90) ? "A" : (($nilai >= 80) ? "B" : (($nilai >= 70) ? "C" : "D"));
echo "Nilai: $nilai<br>";
echo "Grade: $grade<br><br>";

// 8. Null Coalescing Operator (PHP 7+)
echo "<h2>8. Null Coalescing Operator (PHP 7+)</h2>";
$username = null;
$default_user = "guest";

// Sebelum PHP 7
$user1 = isset($username) ? $username : $default_user;
echo "Sebelum PHP 7: $user1<br>";

// PHP 7+
$user2 = $username ?? $default_user;
echo "PHP 7+ (??): $user2<br>";

$config = null;
$setting = $config ?? "default_setting" ?? "fallback";
echo "Multiple null coalescing: $setting<br><br>";

// 9. Operator Bitwise (untuk integer)
echo "<h2>9. Operator Bitwise</h2>";
$bit1 = 12; // Binary: 1100
$bit2 = 25; // Binary: 11001

echo "bit1 = $bit1 (binary: " . decbin($bit1) . ")<br>";
echo "bit2 = $bit2 (binary: " . decbin($bit2) . ")<br>";
echo "bit1 & bit2 = " . ($bit1 & $bit2) . " (AND)<br>";
echo "bit1 | bit2 = " . ($bit1 | $bit2) . " (OR)<br>";
echo "bit1 ^ bit2 = " . ($bit1 ^ $bit2) . " (XOR)<br>";
echo "~bit1 = " . (~$bit1) . " (NOT)<br>";
echo "bit1 << 2 = " . ($bit1 << 2) . " (Shift left)<br>";
echo "bit1 >> 2 = " . ($bit1 >> 2) . " (Shift right)<br><br>";

// 10. Operator Array
echo "<h2>10. Operator Array</h2>";
$array1 = ["a" => "apple", "b" => "banana"];
$array2 = ["b" => "blueberry", "c" => "cherry"];

echo "array1: ";
print_r($array1);
echo "<br>array2: ";
print_r($array2);

$union = $array1 + $array2;
echo "<br>Union (array1 + array2): ";
print_r($union);

echo "<br>array1 == array2: " . ($array1 == $array2 ? 'true' : 'false') . "<br>";
echo "array1 === array2: " . ($array1 === $array2 ? 'true' : 'false') . "<br>";
echo "array1 != array2: " . ($array1 != $array2 ? 'true' : 'false') . "<br>";

// 11. Operator Type (instanceof)
echo "<h2>11. Operator Type</h2>";

class TestClass {}
$obj = new TestClass();

echo "obj instanceof TestClass: " . ($obj instanceof TestClass ? 'true' : 'false') . "<br>";
echo "obj instanceof stdClass: " . ($obj instanceof stdClass ? 'true' : 'false') . "<br>";
