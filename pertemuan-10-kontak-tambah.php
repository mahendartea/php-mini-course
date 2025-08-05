<?php
// Proses menambah kontak ke file kontak.txt
if(isset($_POST['nama']) && isset($_POST['telepon'])){
    $nama = htmlspecialchars($_POST['nama']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $data = $nama . "|" . $telepon . "\n";
    file_put_contents("kontak.txt", $data, FILE_APPEND);
    echo "Kontak berhasil ditambahkan.<br>";
}
echo '<a href="kontak-daftar.php">Lihat Daftar Kontak</a>';
?>