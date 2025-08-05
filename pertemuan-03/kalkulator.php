<?php

/**
 * Pertemuan 3: Kalkulator Sederhana
 * File: kalkulator.php
 *
 * Mendemonstrasikan penggunaan operator aritmatika
 */

// Input data
$angka1 = 15;
$angka2 = 4;

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Sederhana</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .calculator {
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

        .input-section {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .operation {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            margin: 10px 0;
            border-radius: 10px;
            border-left: 4px solid #00ff88;
        }

        .operation-title {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 5px;
        }

        .result {
            font-size: 1.3em;
            color: #00ff88;
            font-weight: bold;
        }

        .number {
            color: #ffeb3b;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="calculator">
        <h1>🧮 Kalkulator Sederhana</h1>

        <div class="input-section">
            <h2>Input Data:</h2>
            <p>Angka pertama: <span class="number"><?php echo $angka1; ?></span></p>
            <p>Angka kedua: <span class="number"><?php echo $angka2; ?></span></p>
        </div>

        <h2>Hasil Operasi Aritmatika:</h2>

        <!-- Penambahan -->
        <div class="operation">
            <div class="operation-title">➕ Penambahan</div>
            <div><?php echo $angka1; ?> + <?php echo $angka2; ?> =
                <span class="result"><?php echo $angka1 + $angka2; ?></span>
            </div>
        </div>

        <!-- Pengurangan -->
        <div class="operation">
            <div class="operation-title">➖ Pengurangan</div>
            <div><?php echo $angka1; ?> - <?php echo $angka2; ?> =
                <span class="result"><?php echo $angka1 - $angka2; ?></span>
            </div>
        </div>

        <!-- Perkalian -->
        <div class="operation">
            <div class="operation-title">✖️ Perkalian</div>
            <div><?php echo $angka1; ?> × <?php echo $angka2; ?> =
                <span class="result"><?php echo $angka1 * $angka2; ?></span>
            </div>
        </div>

        <!-- Pembagian -->
        <div class="operation">
            <div class="operation-title">➗ Pembagian</div>
            <div><?php echo $angka1; ?> ÷ <?php echo $angka2; ?> =
                <span class="result"><?php echo round($angka1 / $angka2, 2); ?></span>
            </div>
            <?php if ($angka2 == 0): ?>
                <div style="color: #ff6b6b; font-style: italic;">
                    ⚠️ Pembagian dengan nol tidak dapat dilakukan!
                </div>
            <?php endif; ?>
        </div>

        <!-- Modulus -->
        <div class="operation">
            <div class="operation-title">🔢 Modulus (Sisa Bagi)</div>
            <div><?php echo $angka1; ?> % <?php echo $angka2; ?> =
                <span class="result"><?php echo $angka1 % $angka2; ?></span>
            </div>
        </div>

        <!-- Eksponen (PHP 5.6+) -->
        <div class="operation">
            <div class="operation-title">🔥 Eksponen (Pangkat)</div>
            <div><?php echo $angka1; ?> ** <?php echo $angka2; ?> =
                <span class="result"><?php echo $angka1 ** $angka2; ?></span>
            </div>
        </div>

        <!-- Operasi Tambahan -->
        <h2>Operasi Matematika Lanjutan:</h2>

        <div class="operation">
            <div class="operation-title">📐 Akar Kuadrat</div>
            <div>√<?php echo $angka1; ?> =
                <span class="result"><?php echo round(sqrt($angka1), 2); ?></span>
            </div>
            <div>√<?php echo $angka2; ?> =
                <span class="result"><?php echo round(sqrt($angka2), 2); ?></span>
            </div>
        </div>

        <div class="operation">
            <div class="operation-title">📊 Rata-rata</div>
            <div>Rata-rata dari <?php echo $angka1; ?> dan <?php echo $angka2; ?> =
                <span class="result"><?php echo ($angka1 + $angka2) / 2; ?></span>
            </div>
        </div>

        <div class="operation">
            <div class="operation-title">🔄 Nilai Absolut</div>
            <div>|<?php echo -$angka1; ?>| =
                <span class="result"><?php echo abs(-$angka1); ?></span>
            </div>
        </div>

        <!-- Demo Assignment Operators -->
        <h2>Demo Assignment Operators:</h2>

        <?php
        $demo = $angka1;
        ?>

        <div class="operation">
            <div class="operation-title">📝 Assignment Operators</div>
            <div>Nilai awal: <span class="number"><?php echo $demo; ?></span></div>

            <?php $demo += $angka2; ?>
            <div>Setelah += <?php echo $angka2; ?>: <span class="result"><?php echo $demo; ?></span></div>

            <?php $demo -= 3; ?>
            <div>Setelah -= 3: <span class="result"><?php echo $demo; ?></span></div>

            <?php $demo *= 2; ?>
            <div>Setelah *= 2: <span class="result"><?php echo $demo; ?></span></div>

            <?php $demo /= 4; ?>
            <div>Setelah /= 4: <span class="result"><?php echo $demo; ?></span></div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-style: italic;">
            <small>Kalkulasi dilakukan pada: <?php echo date('d F Y, H:i:s'); ?></small>
        </div>
    </div>
</body>

</html>
