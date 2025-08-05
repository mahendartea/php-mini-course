<?php

/**
 * Pertemuan 4: Sistem Penilaian
 * File: cek-nilai.php
 *
 * Mendemonstrasikan penggunaan if-else untuk sistem penilaian
 */

// Data nilai siswa
$siswa = [
    ["nama" => "Ahmad Budi", "nilai" => 85],
    ["nama" => "Siti Nurhaliza", "nilai" => 92],
    ["nama" => "Dodi Pratama", "nilai" => 67],
    ["nama" => "Lisa Putri", "nilai" => 78],
    ["nama" => "Rudi Hermawan", "nilai" => 45]
];

// Fungsi untuk menentukan grade
function tentukanGrade($nilai)
{
    if ($nilai >= 90) {
        return "A";
    } elseif ($nilai >= 80) {
        return "B";
    } elseif ($nilai >= 70) {
        return "C";
    } elseif ($nilai >= 60) {
        return "D";
    } else {
        return "E";
    }
}

// Fungsi untuk menentukan status kelulusan
function tentukanStatus($nilai)
{
    return ($nilai >= 70) ? "LULUS" : "TIDAK LULUS";
}

// Fungsi untuk menentukan predikat
function tentukanPredikat($nilai)
{
    switch (true) {
        case ($nilai >= 90):
            return "Sangat Baik";
        case ($nilai >= 80):
            return "Baik";
        case ($nilai >= 70):
            return "Cukup";
        case ($nilai >= 60):
            return "Kurang";
        default:
            return "Sangat Kurang";
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Siswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
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

        .grade-table {
            background: rgba(255, 255, 255, 0.95);
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
            background-color: #74b9ff;
            color: white;
            font-weight: bold;
        }

        .grade-A {
            background-color: #00b894;
            color: white;
        }

        .grade-B {
            background-color: #fdcb6e;
            color: white;
        }

        .grade-C {
            background-color: #e17055;
            color: white;
        }

        .grade-D {
            background-color: #fd79a8;
            color: white;
        }

        .grade-E {
            background-color: #e84393;
            color: white;
        }

        .lulus {
            background-color: #00b894;
            color: white;
            font-weight: bold;
        }

        .tidak-lulus {
            background-color: #d63031;
            color: white;
            font-weight: bold;
        }

        .info-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .demo-section {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📊 Sistem Penilaian Siswa</h1>

        <!-- Tabel Kriteria Penilaian -->
        <div class="grade-table">
            <h2>📋 Kriteria Penilaian</h2>
            <table>
                <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Rentang Nilai</th>
                        <th>Predikat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="grade-A">A</td>
                        <td>90 - 100</td>
                        <td>Sangat Baik</td>
                        <td class="lulus">LULUS</td>
                    </tr>
                    <tr>
                        <td class="grade-B">B</td>
                        <td>80 - 89</td>
                        <td>Baik</td>
                        <td class="lulus">LULUS</td>
                    </tr>
                    <tr>
                        <td class="grade-C">C</td>
                        <td>70 - 79</td>
                        <td>Cukup</td>
                        <td class="lulus">LULUS</td>
                    </tr>
                    <tr>
                        <td class="grade-D">D</td>
                        <td>60 - 69</td>
                        <td>Kurang</td>
                        <td class="tidak-lulus">TIDAK LULUS</td>
                    </tr>
                    <tr>
                        <td class="grade-E">E</td>
                        <td>0 - 59</td>
                        <td>Sangat Kurang</td>
                        <td class="tidak-lulus">TIDAK LULUS</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Hasil Penilaian Siswa -->
        <div class="grade-table">
            <h2>🎓 Hasil Penilaian Siswa</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Nilai</th>
                        <th>Grade</th>
                        <th>Predikat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siswa as $index => $data): ?>
                        <?php
                        $nilai = $data['nilai'];
                        $grade = tentukanGrade($nilai);
                        $status = tentukanStatus($nilai);
                        $predikat = tentukanPredikat($nilai);
                        ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td style="text-align: left;"><?php echo $data['nama']; ?></td>
                            <td><strong><?php echo $nilai; ?></strong></td>
                            <td class="grade-<?php echo $grade; ?>"><?php echo $grade; ?></td>
                            <td><?php echo $predikat; ?></td>
                            <td class="<?php echo strtolower(str_replace(' ', '-', $status)); ?>">
                                <?php echo $status; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Statistik -->
        <div class="info-box">
            <h2>📈 Statistik Kelas</h2>
            <?php
            $total_siswa = count($siswa);
            $total_lulus = 0;
            $total_nilai = 0;
            $nilai_tertinggi = 0;
            $nilai_terendah = 100;
            $grade_count = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0];

            foreach ($siswa as $data) {
                $nilai = $data['nilai'];
                $total_nilai += $nilai;

                if ($nilai >= 70) $total_lulus++;
                if ($nilai > $nilai_tertinggi) $nilai_tertinggi = $nilai;
                if ($nilai < $nilai_terendah) $nilai_terendah = $nilai;

                $grade = tentukanGrade($nilai);
                $grade_count[$grade]++;
            }

            $rata_rata = $total_nilai / $total_siswa;
            $persentase_lulus = ($total_lulus / $total_siswa) * 100;
            ?>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px; text-align: center;">
                    <h3>👥 Total Siswa</h3>
                    <div style="font-size: 2em; font-weight: bold;"><?php echo $total_siswa; ?></div>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px; text-align: center;">
                    <h3>✅ Siswa Lulus</h3>
                    <div style="font-size: 2em; font-weight: bold; color: #00b894;"><?php echo $total_lulus; ?></div>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px; text-align: center;">
                    <h3>📊 Rata-rata</h3>
                    <div style="font-size: 2em; font-weight: bold;"><?php echo number_format($rata_rata, 1); ?></div>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px; text-align: center;">
                    <h3>📈 % Kelulusan</h3>
                    <div style="font-size: 2em; font-weight: bold; color: #fdcb6e;"><?php echo number_format($persentase_lulus, 1); ?>%</div>
                </div>
            </div>

            <h3>🏆 Distribusi Grade:</h3>
            <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
                <?php foreach ($grade_count as $grade => $count): ?>
                    <div style="background: rgba(255,255,255,0.1); padding: 10px 20px; border-radius: 8px; text-align: center;">
                        <div class="grade-<?php echo $grade; ?>" style="padding: 5px 10px; border-radius: 5px; margin-bottom: 5px;">
                            Grade <?php echo $grade; ?>
                        </div>
                        <strong><?php echo $count; ?> siswa</strong>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Demo Kondisi -->
        <div class="demo-section">
            <h2>🔍 Demo Penggunaan Kondisi</h2>

            <h3>1. If-Else Sederhana</h3>
            <?php $test_nilai = 75; ?>
            <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px;">
                <p><strong>Nilai test: <?php echo $test_nilai; ?></strong></p>
                <?php if ($test_nilai >= 70): ?>
                    <p style="color: #00b894;">✅ Selamat! Anda LULUS</p>
                <?php else: ?>
                    <p style="color: #d63031;">❌ Maaf, Anda TIDAK LULUS</p>
                <?php endif; ?>
            </div>

            <h3>2. If-Elseif-Else</h3>
            <?php $test_nilai2 = 88; ?>
            <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px;">
                <p><strong>Nilai test: <?php echo $test_nilai2; ?></strong></p>
                <?php
                if ($test_nilai2 >= 90) {
                    echo "<p style='color: #00b894;'>🌟 Excellent! Grade A</p>";
                } elseif ($test_nilai2 >= 80) {
                    echo "<p style='color: #fdcb6e;'>👍 Good! Grade B</p>";
                } elseif ($test_nilai2 >= 70) {
                    echo "<p style='color: #e17055;'>👌 Fair! Grade C</p>";
                } else {
                    echo "<p style='color: #d63031;'>😔 Need improvement!</p>";
                }
                ?>
            </div>

            <h3>3. Switch Case</h3>
            <?php $hari = date('N'); // 1=Senin, 7=Minggu 
            ?>
            <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px;">
                <p><strong>Hari ini:</strong>
                    <?php
                    switch ($hari) {
                        case 1:
                            echo "Senin - Semangat memulai minggu!";
                            break;
                        case 2:
                            echo "Selasa - Tetap semangat!";
                            break;
                        case 3:
                            echo "Rabu - Pertengahan minggu!";
                            break;
                        case 4:
                            echo "Kamis - Hampir weekend!";
                            break;
                        case 5:
                            echo "Jumat - Weekend loading...";
                            break;
                        case 6:
                            echo "Sabtu - Weekend time!";
                            break;
                        case 7:
                            echo "Minggu - Relax day!";
                            break;
                        default:
                            echo "Hari tidak dikenali";
                    }
                    ?>
                </p>
            </div>

            <h3>4. Operator Ternary</h3>
            <?php $waktu = date('H'); ?>
            <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px;">
                <p><strong>Sekarang jam <?php echo $waktu; ?>:00</strong></p>
                <p>
                    <?php
                    $sapaan = ($waktu < 12) ? "Selamat Pagi! ☀️" : (($waktu < 17) ? "Selamat Siang! 🌤️" : "Selamat Malam! 🌙");
                    echo $sapaan;
                    ?>
                </p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-style: italic;">
            <small>Laporan dibuat pada: <?php echo date('d F Y, H:i:s'); ?></small>
        </div>
    </div>
</body>

</html>
