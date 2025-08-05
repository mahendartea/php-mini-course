<?php

/**
 * Pertemuan 5: Tabel Perkalian
 * File: tabel-perkalian.php
 *
 * Mendemonstrasikan penggunaan nested loop untuk membuat tabel perkalian
 */

$angka = 7; // Angka yang akan dibuat tabel perkaliannya
$maksimal = 10; // Sampai perkalian berapa

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Perkalian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .multiplication-table {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border: 2px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        .highlight {
            background-color: #ffeb3b !important;
            font-weight: bold;
        }

        .pattern-section {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .number-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .number-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 15px;
            border-radius: 8px;
            min-width: 60px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📊 Tabel Perkalian</h1>

        <!-- Tabel Perkalian Sederhana -->
        <div class="multiplication-table">
            <h2>Tabel Perkalian <?php echo $angka; ?></h2>
            <?php for ($i = 1; $i <= $maksimal; $i++): ?>
                <div style="padding: 5px 0;">
                    <?php echo $angka; ?> × <?php echo $i; ?> =
                    <strong><?php echo $angka * $i; ?></strong>
                </div>
            <?php endfor; ?>
        </div>

        <!-- Tabel Perkalian Lengkap -->
        <div class="multiplication-table">
            <h2>Tabel Perkalian Lengkap (1-10)</h2>
            <table>
                <thead>
                    <tr>
                        <th>×</th>
                        <?php for ($j = 1; $j <= 10; $j++): ?>
                            <th><?php echo $j; ?></th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <tr>
                            <th><?php echo $i; ?></th>
                            <?php for ($j = 1; $j <= 10; $j++): ?>
                                <td class="<?php echo ($i == $angka || $j == $angka) ? 'highlight' : ''; ?>">
                                    <?php echo $i * $j; ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

        <!-- Demo For Loop Variants -->
        <div class="pattern-section">
            <h2>🔄 Demo Variasi For Loop</h2>

            <h3>1. For Loop Biasa (1 sampai 10)</h3>
            <div class="number-list">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <div class="number-item"><?php echo $i; ?></div>
                <?php endfor; ?>
            </div>

            <h3>2. For Loop Mundur (10 sampai 1)</h3>
            <div class="number-list">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                    <div class="number-item"><?php echo $i; ?></div>
                <?php endfor; ?>
            </div>

            <h3>3. For Loop dengan Step 2 (Angka Ganjil)</h3>
            <div class="number-list">
                <?php for ($i = 1; $i <= 20; $i += 2): ?>
                    <div class="number-item"><?php echo $i; ?></div>
                <?php endfor; ?>
            </div>

            <h3>4. For Loop dengan Step 3</h3>
            <div class="number-list">
                <?php for ($i = 3; $i <= 30; $i += 3): ?>
                    <div class="number-item"><?php echo $i; ?></div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Demo While Loop -->
        <div class="pattern-section">
            <h2>🔄 Demo While Loop</h2>

            <h3>While Loop - Countdown</h3>
            <div class="number-list">
                <?php
                $countdown = 5;
                while ($countdown > 0):
                ?>
                    <div class="number-item">T-<?php echo $countdown; ?></div>
                <?php
                    $countdown--;
                endwhile;
                ?>
                <div class="number-item" style="background-color: #ff6b6b;">🚀 GO!</div>
            </div>
        </div>

        <!-- Demo Do-While Loop -->
        <div class="pattern-section">
            <h2>🔄 Demo Do-While Loop</h2>

            <h3>Do-While - Minimal satu kali eksekusi</h3>
            <div>
                <?php
                $number = 15;
                echo "<p>Mencari angka yang habis dibagi 3 dimulai dari $number:</p>";
                do {
                    echo "<div class='number-item'>Cek: $number</div>";
                    if ($number % 3 == 0) {
                        echo "<div class='number-item' style='background-color: #4CAF50;'>✓ $number habis dibagi 3!</div>";
                        break;
                    }
                    $number++;
                } while ($number < 20);
                ?>
            </div>
        </div>

        <!-- Factorial Calculator -->
        <div class="pattern-section">
            <h2>🧮 Kalkulator Faktorial</h2>

            <?php
            $n = 5;
            $factorial = 1;
            $steps = [];

            for ($i = 1; $i <= $n; $i++) {
                $factorial *= $i;
                $steps[] = $i;
            }
            ?>

            <h3>Faktorial dari <?php echo $n; ?>:</h3>
            <p>
                <?php echo $n; ?>! = <?php echo implode(' × ', $steps); ?> =
                <strong style="color: #4CAF50;"><?php echo $factorial; ?></strong>
            </p>

            <h3>Faktorial 1 sampai 10:</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
                <?php for ($num = 1; $num <= 10; $num++): ?>
                    <?php
                    $fact = 1;
                    for ($i = 1; $i <= $num; $i++) {
                        $fact *= $i;
                    }
                    ?>
                    <div class="number-item">
                        <?php echo $num; ?>! = <?php echo number_format($fact); ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Pattern Generator -->
        <div class="pattern-section">
            <h2>🎨 Generator Pattern</h2>

            <h3>Segitiga Bintang:</h3>
            <div style="font-family: monospace; line-height: 1.2;">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div>
                        <?php for ($j = 1; $j <= $i; $j++): ?>
                            <span style="color: #ffeb3b;">★</span>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>

            <h3>Piramida Angka:</h3>
            <div style="font-family: monospace; line-height: 1.2; text-align: center;">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div>
                        <?php
                        // Spasi untuk center
                        for ($space = 1; $space <= (5 - $i); $space++) {
                            echo "&nbsp;&nbsp;";
                        }
                        // Angka naik
                        for ($j = 1; $j <= $i; $j++) {
                            echo "<span style='color: #4CAF50;'>$j</span>";
                        }
                        // Angka turun
                        for ($k = $i - 1; $k >= 1; $k--) {
                            echo "<span style='color: #ff6b6b;'>$k</span>";
                        }
                        ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-style: italic;">
            <small>Generated pada: <?php echo date('d F Y, H:i:s'); ?></small>
        </div>
    </div>
</body>

</html>
