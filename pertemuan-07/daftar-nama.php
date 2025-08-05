<?php

/**
 * Pertemuan 7: Daftar Nama dengan Array
 * File: daftar-nama.php
 *
 * Mendemonstrasikan penggunaan array dan foreach untuk menampilkan data
 */

// Array indexed sederhana
$nama_siswa = ["Budi Santoso", "Siti Nurhaliza", "Ahmad Wijaya", "Rina Kartika", "Doni Prakoso"];

// Array associative dengan data lengkap
$siswa_lengkap = [
    [
        "nama" => "Budi Santoso",
        "umur" => 20,
        "kelas" => "XII-A",
        "nilai" => 85,
        "hobi" => ["Membaca", "Programming", "Olahraga"]
    ],
    [
        "nama" => "Siti Nurhaliza",
        "umur" => 19,
        "kelas" => "XII-A",
        "nilai" => 92,
        "hobi" => ["Menyanyi", "Menari", "Memasak"]
    ],
    [
        "nama" => "Ahmad Wijaya",
        "umur" => 20,
        "kelas" => "XII-B",
        "nilai" => 78,
        "hobi" => ["Sepak Bola", "Game", "Traveling"]
    ],
    [
        "nama" => "Rina Kartika",
        "umur" => 19,
        "kelas" => "XII-B",
        "nilai" => 88,
        "hobi" => ["Melukis", "Fotografi", "Musik"]
    ],
    [
        "nama" => "Doni Prakoso",
        "umur" => 21,
        "kelas" => "XII-C",
        "nilai" => 75,
        "hobi" => ["Coding", "Gaming", "Anime"]
    ]
];

// Fungsi untuk menentukan grade
function tentukanGrade($nilai)
{
    if ($nilai >= 90) return ["grade" => "A", "color" => "#27ae60"];
    elseif ($nilai >= 80) return ["grade" => "B", "color" => "#2980b9"];
    elseif ($nilai >= 70) return ["grade" => "C", "color" => "#f39c12"];
    elseif ($nilai >= 60) return ["grade" => "D", "color" => "#e67e22"];
    else return ["grade" => "E", "color" => "#e74c3c"];
}

// Fungsi untuk menghitung statistik
function hitungStatistik($data)
{
    $total_siswa = count($data);
    $total_nilai = array_sum(array_column($data, 'nilai'));
    $rata_rata = $total_nilai / $total_siswa;
    $nilai_tertinggi = max(array_column($data, 'nilai'));
    $nilai_terendah = min(array_column($data, 'nilai'));

    return [
        'total_siswa' => $total_siswa,
        'rata_rata' => $rata_rata,
        'tertinggi' => $nilai_tertinggi,
        'terendah' => $nilai_terendah
    ];
}

$stats = hitungStatistik($siswa_lengkap);

// Filter siswa berdasarkan kriteria
$siswa_lulus = array_filter($siswa_lengkap, function ($siswa) {
    return $siswa['nilai'] >= 75;
});

$siswa_kelas_a = array_filter($siswa_lengkap, function ($siswa) {
    return $siswa['kelas'] === 'XII-A';
});

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nama Siswa - Array Demo</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
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

        h1,
        h2 {
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #00ff88;
            margin-bottom: 5px;
        }

        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .student-card {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .student-header {
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .student-name {
            font-size: 1.3em;
            font-weight: bold;
            color: #2c3e50;
        }

        .grade-badge {
            padding: 5px 12px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 0.9em;
            float: right;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 5px 0;
        }

        .hobi-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 10px;
        }

        .hobi-tag {
            background: #3498db;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8em;
        }

        .simple-list {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .simple-list ol {
            font-size: 1.1em;
            line-height: 2;
        }

        .array-demo {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .code-block {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            overflow-x: auto;
            margin: 10px 0;
        }

        .filter-section {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .highlight {
            background-color: #fff3cd !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📋 Daftar Nama Siswa - Demo Array</h1>

        <!-- Statistik -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['total_siswa']; ?></div>
                <div>Total Siswa</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo number_format($stats['rata_rata'], 1); ?></div>
                <div>Rata-rata Nilai</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['tertinggi']; ?></div>
                <div>Nilai Tertinggi</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['terendah']; ?></div>
                <div>Nilai Terendah</div>
            </div>
        </div>

        <!-- Daftar Nama Sederhana -->
        <div class="simple-list">
            <h2>📝 Daftar Nama Sederhana (Array Indexed)</h2>
            <ol>
                <?php foreach ($nama_siswa as $nama): ?>
                    <li><?php echo $nama; ?></li>
                <?php endforeach; ?>
            </ol>
        </div>

        <!-- Demo Foreach dengan Index -->
        <div class="array-demo">
            <h2>🔄 Demo Foreach dengan Index</h2>
            <div class="code-block">
                foreach ($nama_siswa as $index => $nama) {
                echo ($index + 1) . ". " . $nama;
                }
            </div>
            <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px;">
                <?php foreach ($nama_siswa as $index => $nama): ?>
                    <div><?php echo ($index + 1) . ". " . $nama; ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Data Siswa Lengkap -->
        <h2>👥 Data Siswa Lengkap (Array Multidimensi)</h2>
        <div class="student-grid">
            <?php foreach ($siswa_lengkap as $siswa): ?>
                <?php $grade_info = tentukanGrade($siswa['nilai']); ?>
                <div class="student-card">
                    <div class="student-header">
                        <div class="student-name"><?php echo $siswa['nama']; ?></div>
                        <div class="grade-badge" style="background-color: <?php echo $grade_info['color']; ?>">
                            Grade <?php echo $grade_info['grade']; ?>
                        </div>
                        <div style="clear: both;"></div>
                    </div>

                    <div class="info-row">
                        <span><strong>Umur:</strong></span>
                        <span><?php echo $siswa['umur']; ?> tahun</span>
                    </div>

                    <div class="info-row">
                        <span><strong>Kelas:</strong></span>
                        <span><?php echo $siswa['kelas']; ?></span>
                    </div>

                    <div class="info-row">
                        <span><strong>Nilai:</strong></span>
                        <span><?php echo $siswa['nilai']; ?></span>
                    </div>

                    <div>
                        <strong>Hobi:</strong>
                        <div class="hobi-list">
                            <?php foreach ($siswa['hobi'] as $hobi): ?>
                                <span class="hobi-tag"><?php echo $hobi; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Tabel Data -->
        <div class="filter-section">
            <h2>📊 Tabel Data Siswa</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Kelas</th>
                        <th>Nilai</th>
                        <th>Grade</th>
                        <th>Hobi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siswa_lengkap as $index => $siswa): ?>
                        <?php $grade_info = tentukanGrade($siswa['nilai']); ?>
                        <tr class="<?php echo $siswa['nilai'] >= 85 ? 'highlight' : ''; ?>">
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $siswa['nama']; ?></td>
                            <td><?php echo $siswa['umur']; ?></td>
                            <td><?php echo $siswa['kelas']; ?></td>
                            <td><?php echo $siswa['nilai']; ?></td>
                            <td>
                                <span style="color: <?php echo $grade_info['color']; ?>; font-weight: bold;">
                                    <?php echo $grade_info['grade']; ?>
                                </span>
                            </td>
                            <td><?php echo implode(', ', $siswa['hobi']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Filter Demo -->
        <div class="filter-section">
            <h2>🔍 Demo Array Filter</h2>

            <h3>Siswa yang Lulus (Nilai ≥ 75):</h3>
            <ul>
                <?php foreach ($siswa_lulus as $siswa): ?>
                    <li><strong><?php echo $siswa['nama']; ?></strong> - Nilai: <?php echo $siswa['nilai']; ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Siswa Kelas XII-A:</h3>
            <ul>
                <?php foreach ($siswa_kelas_a as $siswa): ?>
                    <li><strong><?php echo $siswa['nama']; ?></strong> - Nilai: <?php echo $siswa['nilai']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Demo Fungsi Array -->
        <div class="array-demo">
            <h2>🛠️ Demo Fungsi Array Built-in</h2>

            <h3>1. Array Functions untuk Data Nilai</h3>
            <?php $nilai_array = array_column($siswa_lengkap, 'nilai'); ?>
            <div class="code-block">
                $nilai_array = [<?php echo implode(', ', $nilai_array); ?>];

                count($nilai_array) = <?php echo count($nilai_array); ?>
                max($nilai_array) = <?php echo max($nilai_array); ?>
                min($nilai_array) = <?php echo min($nilai_array); ?>
                array_sum($nilai_array) = <?php echo array_sum($nilai_array); ?>
                sort($nilai_array) = [<?php $sorted = $nilai_array;
                                        sort($sorted);
                                        echo implode(', ', $sorted); ?>]
            </div>

            <h3>2. Array Map - Transform Data</h3>
            <?php
            $nama_uppercase = array_map(function ($siswa) {
                return strtoupper($siswa['nama']);
            }, $siswa_lengkap);
            ?>
            <div class="code-block">
                // Mengubah semua nama menjadi uppercase
                $nama_uppercase = array_map(function($siswa) {
                return strtoupper($siswa['nama']);
                }, $siswa_lengkap);

                Result: [<?php echo '"' . implode('", "', $nama_uppercase) . '"'; ?>]
            </div>

            <h3>3. Array Reduce - Hitung Total</h3>
            <?php
            $total_umur = array_reduce($siswa_lengkap, function ($carry, $siswa) {
                return $carry + $siswa['umur'];
            }, 0);
            ?>
            <div class="code-block">
                // Menghitung total umur semua siswa
                $total_umur = array_reduce($siswa_lengkap, function($carry, $siswa) {
                return $carry + $siswa['umur'];
                }, 0);

                Total umur: <?php echo $total_umur; ?> tahun
                Rata-rata umur: <?php echo number_format($total_umur / count($siswa_lengkap), 1); ?> tahun
            </div>

            <h3>4. Array Column - Extract Kolom</h3>
            <?php
            $daftar_nama = array_column($siswa_lengkap, 'nama');
            $daftar_kelas = array_column($siswa_lengkap, 'kelas');
            ?>
            <div class="code-block">
                $daftar_nama = array_column($siswa_lengkap, 'nama');
                $daftar_kelas = array_column($siswa_lengkap, 'kelas');

                Nama: [<?php echo '"' . implode('", "', $daftar_nama) . '"'; ?>]
                Kelas: [<?php echo '"' . implode('", "', array_unique($daftar_kelas)) . '"'; ?>]
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-style: italic;">
            <small>Data diproses pada: <?php echo date('d F Y, H:i:s'); ?></small>
        </div>
    </div>
</body>

</html>
