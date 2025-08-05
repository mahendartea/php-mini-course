<?php
// Pertemuan 8: Proses Form Input & Validasi Dasar
if(isset($_POST['nama']) && $_POST['nama'] != ""){
    echo "Halo, " . htmlspecialchars($_POST['nama']);
} else {
    echo "Nama wajib diisi!";
}
?>