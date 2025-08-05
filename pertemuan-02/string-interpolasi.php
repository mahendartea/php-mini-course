<?php

/**
 * Pertemuan 2: String Interpolasi
 * File: string-interpolasi.php
 *
 * Mendemonstrasikan berbagai cara interpolasi string dalam PHP
 */

// Data untuk demonstrasi
$nama = "Siti Nurhaliza";
$umur = 22;
$kota = "Bandung";
$gaji = 5000000;

echo "<h1>Demo String Interpolasi</h1>";

// 1. Single Quotes vs Double Quotes
echo "<h2>1. Single Quotes vs Double Quotes</h2>";
echo 'Single quotes: Nama saya $nama dan umur $umur tahun<br>';
echo "Double quotes: Nama saya $nama dan umur $umur tahun<br>";

// 2. Concatenation dengan operator titik (.)
echo "<h2>2. String Concatenation</h2>";
echo "Concatenation: " . "Nama saya " . $nama . " dan umur " . $umur . " tahun<br>";

// 3. Interpolasi dalam double quotes
echo "<h2>3. Interpolasi dalam Double Quotes</h2>";
echo "Halo, nama saya $nama<br>";
echo "Saya berumur $umur tahun<br>";
echo "Saya tinggal di $kota<br>";

// 4. Interpolasi dengan curly braces
echo "<h2>4. Interpolasi dengan Curly Braces</h2>";
echo "Halo, nama saya {$nama}<br>";
echo "Gaji saya Rp {$gaji} per bulan<br>";

// 5. Interpolasi dengan array (preview untuk pertemuan array)
echo "<h2>5. Interpolasi dengan Array Elements</h2>";
$person = [
    'nama' => 'Ahmad',
    'profesi' => 'Developer'
];
echo "Nama: {$person['nama']}, Profesi: {$person['profesi']}<br>";

// 6. Format number dalam string
echo "<h2>6. Format Number dalam String</h2>";
echo "Gaji: Rp " . number_format($gaji, 0, ',', '.') . "<br>";
echo "Gaji (formatted): Rp " . number_format($gaji, 2, ',', '.') . "<br>";

// 7. Heredoc Syntax
echo "<h2>7. Heredoc Syntax</h2>";
$biodata = <<<EOD
Nama: $nama
Umur: $umur tahun
Kota: $kota
Gaji: Rp $gaji
EOD;

echo nl2br($biodata) . "<br>";

// 8. Nowdoc Syntax (seperti single quotes)
echo "<h2>8. Nowdoc Syntax</h2>";
$template = <<<'EOD'
Nama: $nama
Umur: $umur tahun
Kota: $kota
EOD;

echo nl2br($template) . "<br>";

// 9. sprintf untuk formatting
echo "<h2>9. sprintf untuk Formatting</h2>";
$formatted = sprintf(
    "Nama: %s, Umur: %d tahun, Gaji: Rp %s",
    $nama,
    $umur,
    number_format($gaji, 0, ',', '.')
);
echo $formatted . "<br>";

// 10. printf (langsung print)
echo "<h2>10. printf (Direct Print)</h2>";
printf("Halo %s, selamat datang di %s!<br>", $nama, $kota);

// 11. Escape characters
echo "<h2>11. Escape Characters</h2>";
echo "Dia berkata: \"Halo, apa kabar?\"<br>";
echo "Path file: C:\\xampp\\htdocs\\project<br>";
echo "Baris baru menggunakan \\n (tidak terlihat di HTML)<br>";
echo "Tab menggunakan \\t (tidak terlihat di HTML)<br>";

// 12. Multiline string dengan proper HTML
echo "<h2>12. Multiline String untuk HTML</h2>";
$html_content = "
<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>
    <h3>Profil: $nama</h3>
    <p><strong>Umur:</strong> $umur tahun</p>
    <p><strong>Kota:</strong> $kota</p>
    <p><strong>Gaji:</strong> Rp " . number_format($gaji, 0, ',', '.') . "</p>
</div>
";

echo $html_content;

// 13. String functions yang berguna
echo "<h2>13. String Functions</h2>";
echo "Length nama: " . strlen($nama) . " karakter<br>";
echo "Uppercase: " . strtoupper($nama) . "<br>";
echo "Lowercase: " . strtolower($nama) . "<br>";
echo "Ucwords: " . ucwords(strtolower($nama)) . "<br>";
echo "Substr: " . substr($nama, 0, 4) . "<br>";
