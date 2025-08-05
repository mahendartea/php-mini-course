<?php
// Pertemuan 9: Dasar Pemrograman Berbasis File
$file = fopen("data.txt", "w");
fwrite($file, "Ini adalah data yang ditulis dengan PHP.");
fclose($file);
echo "Data berhasil ditulis ke file.";
?>