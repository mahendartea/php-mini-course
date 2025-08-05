<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP dalam HTML</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .info-box {
            background-color: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?php echo "Belajar PHP dalam HTML"; ?></h1>

        <div class="info-box">
            <h3>Informasi Server</h3>
            <p><strong>Tanggal dan Waktu Server:</strong> <?php echo date('d F Y, H:i:s'); ?></p>
            <p><strong>Versi PHP:</strong> <?php echo phpversion(); ?></p>
            <p><strong>Sistem Operasi Server:</strong> <?php echo php_uname('s'); ?></p>
        </div>

        <div class="info-box">
            <h3>Perhitungan Sederhana</h3>
            <?php
            $angka1 = 10;
            $angka2 = 5;
            ?>
            <p><?php echo $angka1; ?> + <?php echo $angka2; ?> = <?php echo $angka1 + $angka2; ?></p>
            <p><?php echo $angka1; ?> × <?php echo $angka2; ?> = <?php echo $angka1 * $angka2; ?></p>
        </div>

        <div class="info-box">
            <h3>Pesan Dinamis</h3>
            <p>
                <?php
                $jam = date('H');
                if ($jam < 12) {
                    echo "Selamat pagi! ☀️";
                } elseif ($jam < 17) {
                    echo "Selamat siang! 🌤️";
                } else {
                    echo "Selamat malam! 🌙";
                }
                ?>
            </p>
        </div>
    </div>
</body>

</html>
