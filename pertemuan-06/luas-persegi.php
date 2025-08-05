<?php

/**
 * Pertemuan 6: Fungsi untuk Menghitung Luas Persegi
 * File: luas-persegi.php
 *
 * Mendemonstrasikan penggunaan fungsi dengan parameter dan return value
 */

// Fungsi untuk menghitung luas persegi
function luasPersegi($sisi)
{
    return $sisi * $sisi;
}

// Fungsi untuk menghitung keliling persegi
function kelilingPersegi($sisi)
{
    return 4 * $sisi;
}

// Fungsi untuk menghitung diagonal persegi
function diagonalPersegi($sisi)
{
    return $sisi * sqrt(2);
}

// Fungsi untuk menghitung semua properti persegi
function hitungSemuaPersegi($sisi)
{
    return [
        'sisi' => $sisi,
        'luas' => luasPersegi($sisi),
        'keliling' => kelilingPersegi($sisi),
        'diagonal' => diagonalPersegi($sisi)
    ];
}

// Fungsi untuk memformat angka
function formatAngka($angka, $desimal = 2)
{
    return number_format($angka, $desimal, ',', '.');
}

// Fungsi validasi input
function validasiSisi($sisi)
{
    if (!is_numeric($sisi)) {
        return "Sisi harus berupa angka";
    }
    if ($sisi <= 0) {
        return "Sisi harus lebih besar dari 0";
    }
    return true;
}

// Data untuk demo
$sisi_demo = [4, 7.5, 10, 12.3, 15];

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Persegi dengan Fungsi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
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

        .calculator-section {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .input-group {
            margin: 15px 0;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .btn {
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }

        .btn:hover {
            background: #45a049;
        }

        .result-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid #4CAF50;
        }

        .demo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .demo-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .property {
            margin: 8px 0;
            padding: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }

        .error {
            color: #e74c3c;
            font-weight: bold;
        }

        .success {
            color: #27ae60;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .function-demo {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }

        code {
            background: rgba(0, 0, 0, 0.2);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📐 Kalkulator Persegi dengan Fungsi</h1>

        <!-- Interactive Calculator -->
        <div class="calculator-section">
            <h2>🧮 Kalkulator Interaktif</h2>
            <form method="GET">
                <div class="input-group">
                    <label for="sisi">Panjang Sisi (cm):</label>
                    <input type="number" name="sisi" id="sisi" step="0.1" value="<?php echo $_GET['sisi'] ?? ''; ?>" placeholder="Masukkan panjang sisi">
                </div>
                <button type="submit" class="btn">Hitung</button>
                <button type="button" class="btn" onclick="document.getElementById('sisi').value=''; window.location.href=window.location.pathname;">Reset</button>
            </form>

            <?php if (isset($_GET['sisi']) && !empty($_GET['sisi'])): ?>
                <?php
                $sisi_input = $_GET['sisi'];
                $validasi = validasiSisi($sisi_input);
                ?>

                <?php if ($validasi === true): ?>
                    <?php $hasil = hitungSemuaPersegi($sisi_input); ?>
                    <div class="result-box">
                        <h3>✅ Hasil Perhitungan untuk Sisi = <?php echo $sisi_input; ?> cm</h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                            <div class="property">
                                <strong>Luas:</strong><br>
                                <?php echo formatAngka($hasil['luas']); ?> cm²
                            </div>
                            <div class="property">
                                <strong>Keliling:</strong><br>
                                <?php echo formatAngka($hasil['keliling']); ?> cm
                            </div>
                            <div class="property">
                                <strong>Diagonal:</strong><br>
                                <?php echo formatAngka($hasil['diagonal']); ?> cm
                            </div>
                        </div>

                        <h4>🧮 Cara Perhitungan:</h4>
                        <ul>
                            <li>Luas = sisi × sisi = <?php echo $sisi_input; ?> × <?php echo $sisi_input; ?> = <?php echo formatAngka($hasil['luas']); ?> cm²</li>
                            <li>Keliling = 4 × sisi = 4 × <?php echo $sisi_input; ?> = <?php echo formatAngka($hasil['keliling']); ?> cm</li>
                            <li>Diagonal = sisi × √2 = <?php echo $sisi_input; ?> × <?php echo formatAngka(sqrt(2)); ?> = <?php echo formatAngka($hasil['diagonal']); ?> cm</li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="result-box" style="border-left-color: #e74c3c;">
                        <h3 class="error">❌ Error</h3>
                        <p class="error"><?php echo $validasi; ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Demo dengan Multiple Values -->
        <div class="function-demo">
            <h2>📊 Demo dengan Berbagai Nilai</h2>
            <div class="demo-grid">
                <?php foreach ($sisi_demo as $sisi): ?>
                    <?php $hasil = hitungSemuaPersegi($sisi); ?>
                    <div class="demo-card">
                        <h3>Sisi: <?php echo $sisi; ?> cm</h3>
                        <div class="property">Luas: <?php echo formatAngka($hasil['luas']); ?> cm²</div>
                        <div class="property">Keliling: <?php echo formatAngka($hasil['keliling']); ?> cm</div>
                        <div class="property">Diagonal: <?php echo formatAngka($hasil['diagonal']); ?> cm</div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tabel Perbandingan -->
        <div class="calculator-section">
            <h2>📋 Tabel Perbandingan</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sisi (cm)</th>
                        <th>Luas (cm²)</th>
                        <th>Keliling (cm)</th>
                        <th>Diagonal (cm)</th>
                        <th>Rasio L/K</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sisi_demo as $sisi): ?>
                        <?php
                        $hasil = hitungSemuaPersegi($sisi);
                        $rasio = $hasil['luas'] / $hasil['keliling'];
                        ?>
                        <tr>
                            <td><?php echo $sisi; ?></td>
                            <td><?php echo formatAngka($hasil['luas']); ?></td>
                            <td><?php echo formatAngka($hasil['keliling']); ?></td>
                            <td><?php echo formatAngka($hasil['diagonal']); ?></td>
                            <td><?php echo formatAngka($rasio); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Demo Fungsi-Fungsi Lain -->
        <div class="function-demo">
            <h2>🔧 Demo Fungsi-Fungsi PHP</h2>

            <h3>1. Fungsi Matematika Built-in</h3>
            <?php
            $angka = 15.7;
            ?>
            <div class="result-box">
                <p>Angka: <code><?php echo $angka; ?></code></p>
                <ul>
                    <li><code>abs(<?php echo $angka; ?>)</code> = <?php echo abs($angka); ?></li>
                    <li><code>ceil(<?php echo $angka; ?>)</code> = <?php echo ceil($angka); ?></li>
                    <li><code>floor(<?php echo $angka; ?>)</code> = <?php echo floor($angka); ?></li>
                    <li><code>round(<?php echo $angka; ?>)</code> = <?php echo round($angka); ?></li>
                    <li><code>sqrt(<?php echo $angka; ?>)</code> = <?php echo formatAngka(sqrt($angka)); ?></li>
                    <li><code>pow(<?php echo $angka; ?>, 2)</code> = <?php echo formatAngka(pow($angka, 2)); ?></li>
                </ul>
            </div>

            <h3>2. Fungsi String</h3>
            <?php
            $teks = "Belajar PHP Fungsi";
            ?>
            <div class="result-box">
                <p>String: <code>"<?php echo $teks; ?>"</code></p>
                <ul>
                    <li><code>strlen()</code> = <?php echo strlen($teks); ?> karakter</li>
                    <li><code>strtoupper()</code> = "<?php echo strtoupper($teks); ?>"</li>
                    <li><code>strtolower()</code> = "<?php echo strtolower($teks); ?>"</li>
                    <li><code>str_replace("PHP", "JavaScript")</code> = "<?php echo str_replace("PHP", "JavaScript", $teks); ?>"</li>
                    <li><code>substr(0, 7)</code> = "<?php echo substr($teks, 0, 7); ?>"</li>
                </ul>
            </div>

            <h3>3. Fungsi Array</h3>
            <?php
            $array_demo = [10, 25, 7, 33, 15, 8];
            ?>
            <div class="result-box">
                <p>Array: <code>[<?php echo implode(', ', $array_demo); ?>]</code></p>
                <ul>
                    <li><code>count()</code> = <?php echo count($array_demo); ?> elemen</li>
                    <li><code>max()</code> = <?php echo max($array_demo); ?></li>
                    <li><code>min()</code> = <?php echo min($array_demo); ?></li>
                    <li><code>array_sum()</code> = <?php echo array_sum($array_demo); ?></li>
                    <li><code>sort()</code> = [<?php $sorted = $array_demo;
                                                sort($sorted);
                                                echo implode(', ', $sorted); ?>]</li>
                </ul>
            </div>

            <h3>4. Fungsi Tanggal/Waktu</h3>
            <div class="result-box">
                <ul>
                    <li><code>date('Y-m-d')</code> = <?php echo date('Y-m-d'); ?></li>
                    <li><code>date('H:i:s')</code> = <?php echo date('H:i:s'); ?></li>
                    <li><code>date('l, d F Y')</code> = <?php echo date('l, d F Y'); ?></li>
                    <li><code>time()</code> = <?php echo time(); ?> (timestamp)</li>
                </ul>
            </div>
        </div>

        <!-- Source Code Demo -->
        <div class="calculator-section">
            <h2>💻 Source Code Fungsi</h2>
            <div style="background: #2d3748; color: #e2e8f0; padding: 20px; border-radius: 10px; font-family: 'Courier New', monospace; overflow-x: auto;">
                <pre>
// Fungsi untuk menghitung luas persegi
function luasPersegi($sisi) {
    return $sisi * $sisi;
}

// Fungsi untuk menghitung keliling persegi
function kelilingPersegi($sisi) {
    return 4 * $sisi;
}

// Fungsi untuk menghitung diagonal persegi
function diagonalPersegi($sisi) {
    return $sisi * sqrt(2);
}

// Fungsi untuk menghitung semua properti
function hitungSemuaPersegi($sisi) {
    return [
        'sisi' => $sisi,
        'luas' => luasPersegi($sisi),
        'keliling' => kelilingPersegi($sisi),
        'diagonal' => diagonalPersegi($sisi)
    ];
}
</pre>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-style: italic;">
            <small>Perhitungan dilakukan pada: <?php echo date('d F Y, H:i:s'); ?></small>
        </div>
    </div>
</body>

</html>
