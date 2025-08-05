<?php

/**
 * Pertemuan 2: Biodata Sederhana
 * File: biodata.php
 *
 * Menampilkan biodata menggunakan variabel
 */

// Deklarasi variabel biodata
$nama = "Budi Santoso";
$umur = 20;
$tempat_lahir = "Jakarta";
$tanggal_lahir = "15 Agustus 2003";
$alamat = "Jl. Merdeka No. 123, Jakarta Pusat";
$email = "budi.santoso@email.com";
$telepon = "08123456789";
$hobi = "Membaca, Programming, Olahraga";
$status = "Mahasiswa";

// Variabel boolean
$sudah_menikah = false;
$aktif_kuliah = true;

// Variabel numerik
$tinggi_badan = 170.5; // cm
$berat_badan = 65.2;   // kg
$ipk = 3.75;

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata - <?php echo $nama; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f8ff;
        }

        .biodata-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        .info-row {
            display: flex;
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            font-weight: bold;
            width: 150px;
            color: #34495e;
        }

        .value {
            color: #2c3e50;
        }

        .status-badge {
            background-color: #27ae60;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="biodata-card">
        <h1>📋 BIODATA DIRI</h1>

        <!-- Data Pribadi -->
        <div class="info-row">
            <div class="label">Nama Lengkap:</div>
            <div class="value"><?php echo $nama; ?></div>
        </div>

        <div class="info-row">
            <div class="label">Umur:</div>
            <div class="value"><?php echo $umur; ?> tahun</div>
        </div>

        <div class="info-row">
            <div class="label">Tempat Lahir:</div>
            <div class="value"><?php echo $tempat_lahir; ?></div>
        </div>

        <div class="info-row">
            <div class="label">Tanggal Lahir:</div>
            <div class="value"><?php echo $tanggal_lahir; ?></div>
        </div>

        <div class="info-row">
            <div class="label">Alamat:</div>
            <div class="value"><?php echo $alamat; ?></div>
        </div>

        <!-- Kontak -->
        <div class="info-row">
            <div class="label">Email:</div>
            <div class="value"><?php echo $email; ?></div>
        </div>

        <div class="info-row">
            <div class="label">Telepon:</div>
            <div class="value"><?php echo $telepon; ?></div>
        </div>

        <!-- Data Fisik -->
        <div class="info-row">
            <div class="label">Tinggi Badan:</div>
            <div class="value"><?php echo $tinggi_badan; ?> cm</div>
        </div>

        <div class="info-row">
            <div class="label">Berat Badan:</div>
            <div class="value"><?php echo $berat_badan; ?> kg</div>
        </div>

        <!-- Status -->
        <div class="info-row">
            <div class="label">Status:</div>
            <div class="value">
                <span class="status-badge"><?php echo $status; ?></span>
            </div>
        </div>

        <div class="info-row">
            <div class="label">Status Pernikahan:</div>
            <div class="value">
                <?php
                if ($sudah_menikah) {
                    echo "Sudah Menikah";
                } else {
                    echo "Belum Menikah";
                }
                ?>
            </div>
        </div>

        <div class="info-row">
            <div class="label">Status Kuliah:</div>
            <div class="value">
                <?php echo $aktif_kuliah ? "Aktif" : "Tidak Aktif"; ?>
            </div>
        </div>

        <div class="info-row">
            <div class="label">IPK:</div>
            <div class="value"><?php echo $ipk; ?></div>
        </div>

        <div class="info-row">
            <div class="label">Hobi:</div>
            <div class="value"><?php echo $hobi; ?></div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 30px; color: #7f8c8d;">
            <small>Data diperbarui: <?php echo date('d F Y, H:i:s'); ?></small>
        </div>
    </div>
</body>

</html>
