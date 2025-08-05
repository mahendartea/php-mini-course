<?php
// Menghapus kontak sesuai ID pada file kontak.txt
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    if(file_exists("kontak.txt")){
        $kontak = file("kontak.txt", FILE_IGNORE_NEW_LINES);
        if(isset($kontak[$id])){
            unset($kontak[$id]);
            file_put_contents("kontak.txt", implode("\n", $kontak));
            echo "Kontak berhasil dihapus.<br>";
        }
    }
}
echo '<a href="kontak-daftar.php">Kembali ke Daftar Kontak</a>';
?>