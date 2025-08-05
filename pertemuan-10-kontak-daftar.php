<?php
// Menampilkan daftar kontak dari file kontak.txt
if(file_exists("kontak.txt")){
    $kontak = file("kontak.txt", FILE_IGNORE_NEW_LINES);
    echo "<h3>Daftar Kontak:</h3><ul>";
    foreach($kontak as $key=>$value){
        list($nama, $telepon) = explode('|', $value);
        echo "<li>$nama ($telepon) <a href='kontak-hapus.php?id=$key'>Hapus</a></li>";
    }
    echo "</ul>";
} else {
    echo "Belum ada kontak.";
}
echo '<a href="kontak-form.html">Tambah Kontak</a>';
?>