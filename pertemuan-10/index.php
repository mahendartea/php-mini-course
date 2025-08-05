<?php

/**
 * Pertemuan 10: Dashboard Aplikasi Kontak
 * File: index.php
 *
 * Dashboard utama dengan statistik dan navigasi
 */

// Konfigurasi
define('DATA_FILE', 'data/kontak.json');
define('BACKUP_DIR', 'data/backup/');

// Buat direktori jika belum ada
if (!is_dir('data')) {
    mkdir('data', 0755, true);
}
if (!is_dir(BACKUP_DIR)) {
    mkdir(BACKUP_DIR, 0755, true);
}

// Fungsi untuk memuat data kontak
function loadKontaks()
{
    if (file_exists(DATA_FILE)) {
        $json = file_get_contents(DATA_FILE);
        return json_decode($json, true) ?: [];
    }
    return [];
}

// Fungsi untuk mendapatkan statistik
function getStatistik($kontaks)
{
    $stats = [
        'total' => count($kontaks),
        'kategori' => [],
        'hari_ini' => 0,
        'minggu_ini' => 0,
        'bulan_ini' => 0
    ];

    $today = date('Y-m-d');
    $week_start = date('Y-m-d', strtotime('monday this week'));
    $month_start = date('Y-m-01');

    foreach ($kontaks as $kontak) {
        // Hitung kategori
        $kategori = $kontak['kategori'] ?? 'Lainnya';
        $stats['kategori'][$kategori] = ($stats['kategori'][$kategori] ?? 0) + 1;

        // Hitung berdasarkan tanggal
        $tanggal_dibuat = substr($kontak['tanggal_dibuat'] ?? '', 0, 10);

        if ($tanggal_dibuat === $today) {
            $stats['hari_ini']++;
        }

        if ($tanggal_dibuat >= $week_start) {
            $stats['minggu_ini']++;
        }

        if ($tanggal_dibuat >= $month_start) {
            $stats['bulan_ini']++;
        }
    }

    return $stats;
}

// Fungsi untuk mendapatkan kontak terbaru
function getKontakTerbaru($kontaks, $limit = 5)
{
    // Urutkan berdasarkan tanggal dibuat (terbaru dulu)
    usort($kontaks, function ($a, $b) {
        return strtotime($b['tanggal_dibuat'] ?? '0') - strtotime($a['tanggal_dibuat'] ?? '0');
    });

    return array_slice($kontaks, 0, $limit);
}

// Load data dan statistik
$kontaks = loadKontaks();
$stats = getStatistik($kontaks);
$kontak_terbaru = getKontakTerbaru($kontaks, 5);

// Handle quick actions
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'backup') {
        if (!empty($kontaks)) {
            $backup_file = BACKUP_DIR . 'backup_' . date('Y-m-d_H-i-s') . '.json';
            if (file_put_contents($backup_file, json_encode($kontaks, JSON_PRETTY_PRINT))) {
                $message = 'Backup berhasil dibuat: ' . basename($backup_file);
                $message_type = 'success';
            } else {
                $message = 'Gagal membuat backup';
                $message_type = 'error';
            }
        } else {
            $message = 'Tidak ada data untuk di-backup';
            $message_type = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Kontak</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: #4CAF50;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            padding: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: #4CAF50;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .hero {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .hero h1 {
            font-size: 3em;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #4CAF50, #45a049);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 30px;
        }

        .quick-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
        }

        .btn-info {
            background: linear-gradient(45deg, #9b59b6, #8e44ad);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 3em;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 1.1em;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            margin-bottom: 20px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kontak-item {
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .kontak-item:hover {
            background: #f8f9fa;
            border-color: #4CAF50;
        }

        .kontak-item h4 {
            margin-bottom: 5px;
            color: #333;
        }

        .kontak-item p {
            color: #666;
            margin: 3px 0;
            font-size: 0.9em;
        }

        .kategori-chart {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .kategori-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .kategori-bar {
            height: 8px;
            background: #4CAF50;
            border-radius: 4px;
            margin-top: 5px;
        }

        .empty-state {
            text-align: center;
            color: #666;
            padding: 40px;
        }

        .empty-state .icon {
            font-size: 4em;
            margin-bottom: 20px;
        }

        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .message-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                justify-content: center;
            }

            .hero h1 {
                font-size: 2em;
            }

            .quick-actions {
                flex-direction: column;
                align-items: center;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">📇 Kontak App</div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">🏠 Dashboard</a></li>
                <li><a href="kontak-daftar.php">📋 Daftar Kontak</a></li>
                <li><a href="kontak-tambah.php">➕ Tambah Kontak</a></li>
                <li><a href="import-export.php">💾 Import/Export</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Hero Section -->
        <div class="hero">
            <h1>📇 Aplikasi Kontak</h1>
            <p>Kelola kontak Anda dengan mudah dan terorganisir</p>

            <div class="quick-actions">
                <a href="kontak-tambah.php" class="btn btn-primary">
                    ➕ Tambah Kontak Baru
                </a>
                <a href="kontak-daftar.php" class="btn btn-secondary">
                    📋 Lihat Semua Kontak
                </a>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="backup">
                    <button type="submit" class="btn btn-info">
                        💾 Backup Data
                    </button>
                </form>
            </div>
        </div>

        <!-- Messages -->
        <?php if ($message): ?>
            <div class="message message-<?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-number"><?php echo $stats['total']; ?></div>
                <div class="stat-label">Total Kontak</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-number"><?php echo $stats['hari_ini']; ?></div>
                <div class="stat-label">Ditambah Hari Ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-number"><?php echo $stats['minggu_ini']; ?></div>
                <div class="stat-label">Minggu Ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-number"><?php echo $stats['bulan_ini']; ?></div>
                <div class="stat-label">Bulan Ini</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Kontak Terbaru -->
            <div class="card">
                <h2>🕒 Kontak Terbaru</h2>

                <?php if (empty($kontak_terbaru)): ?>
                    <div class="empty-state">
                        <div class="icon">📭</div>
                        <h3>Belum ada kontak</h3>
                        <p>Mulai dengan menambahkan kontak pertama Anda</p>
                        <br>
                        <a href="kontak-tambah.php" class="btn btn-primary">➕ Tambah Kontak</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($kontak_terbaru as $kontak): ?>
                        <div class="kontak-item" onclick="window.location.href='kontak-detail.php?id=<?php echo urlencode($kontak['id']); ?>'">
                            <h4><?php echo htmlspecialchars($kontak['nama']); ?></h4>
                            <p>📧 <?php echo htmlspecialchars($kontak['email']); ?></p>
                            <p>📱 <?php echo htmlspecialchars($kontak['telepon']); ?></p>
                            <p>🏷️ <?php echo htmlspecialchars($kontak['kategori'] ?? 'Lainnya'); ?></p>
                            <p style="font-size: 0.8em; color: #999;">
                                <?php echo date('d/m/Y H:i', strtotime($kontak['tanggal_dibuat'])); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>

                    <div style="text-align: center; margin-top: 20px;">
                        <a href="kontak-daftar.php" class="btn btn-secondary">Lihat Semua →</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Statistik Kategori -->
            <div class="card">
                <h2>📊 Kontak per Kategori</h2>

                <?php if (empty($stats['kategori'])): ?>
                    <div class="empty-state">
                        <div class="icon">📈</div>
                        <p>Belum ada data kategori</p>
                    </div>
                <?php else: ?>
                    <div class="kategori-chart">
                        <?php
                        $max_count = max($stats['kategori']);
                        foreach ($stats['kategori'] as $kategori => $count):
                            $percentage = $max_count > 0 ? ($count / $max_count) * 100 : 0;
                        ?>
                            <div class="kategori-item">
                                <div>
                                    <strong><?php echo htmlspecialchars($kategori); ?></strong>
                                    <div class="kategori-bar" style="width: <?php echo $percentage; ?>%"></div>
                                </div>
                                <span><?php echo $count; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="card">
            <h2>🔗 Aksi Cepat</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <a href="kontak-tambah.php" class="btn btn-primary" style="justify-content: center;">
                    ➕ Tambah Kontak
                </a>
                <a href="kontak-daftar.php" class="btn btn-secondary" style="justify-content: center;">
                    📋 Lihat Semua
                </a>
                <a href="import-export.php" class="btn btn-info" style="justify-content: center;">
                    💾 Import/Export
                </a>
                <?php if (!empty($kontaks)): ?>
                    <a href="kontak-daftar.php?search=" class="btn" style="background: #e74c3c; color: white; justify-content: center;">
                        🔍 Cari Kontak
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer Info -->
        <div style="text-align: center; margin-top: 40px; color: rgba(255,255,255,0.8);">
            <p>© 2024 Aplikasi Kontak - PHP Mini Course Pertemuan 10</p>
            <p style="font-size: 0.9em; margin-top: 10px;">
                💾 Data disimpan dalam file JSON • 🔒 Tanpa database eksternal
            </p>
        </div>
    </div>

    <script>
        // Auto-refresh statistik setiap 30 detik jika ada perubahan
        let lastUpdateTime = Date.now();

        function checkForUpdates() {
            // Implementasi sederhana untuk update otomatis
            // Dalam aplikasi nyata, bisa menggunakan AJAX
        }

        // Animasi counter untuk statistik
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.stat-number');

            counters.forEach(counter => {
                const target = parseInt(counter.textContent);
                const increment = target / 50;
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 20);
            });
        });

        // Efek klik untuk kontak items
        document.querySelectorAll('.kontak-item').forEach(item => {
            item.style.cursor = 'pointer';

            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    </script>
</body>

</html>
