<?php

/**
 * Pertemuan 9: Log Viewer
 * File: log-viewer.php
 *
 * Menampilkan log aktivitas file manager
 */

$log_file = 'file_log.txt';
$logs = [];

// Baca log file jika ada
if (file_exists($log_file)) {
    $log_content = file_get_contents($log_file);
    if ($log_content) {
        $log_lines = array_filter(explode("\n", $log_content));

        // Parse setiap baris log
        foreach ($log_lines as $line) {
            if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) - (.+)$/', $line, $matches)) {
                $logs[] = [
                    'timestamp' => $matches[1],
                    'message' => $matches[2],
                    'datetime' => DateTime::createFromFormat('Y-m-d H:i:s', $matches[1])
                ];
            }
        }

        // Urutkan dari yang terbaru
        usort($logs, function ($a, $b) {
            return $b['datetime'] <=> $a['datetime'];
        });
    }
}

// Handle clear log
if (isset($_POST['clear_log'])) {
    file_put_contents($log_file, '');
    header('Location: log-viewer.php');
    exit;
}

// Statistik log
$total_logs = count($logs);
$today_logs = 0;
$today = date('Y-m-d');

foreach ($logs as $log) {
    if (strpos($log['timestamp'], $today) === 0) {
        $today_logs++;
    }
}

// Analisis aktivitas
$activity_stats = [
    'uploads' => 0,
    'downloads' => 0,
    'deletes' => 0
];

foreach ($logs as $log) {
    if (strpos($log['message'], 'uploaded') !== false) {
        $activity_stats['uploads']++;
    } elseif (strpos($log['message'], 'downloaded') !== false) {
        $activity_stats['downloads']++;
    } elseif (strpos($log['message'], 'deleted') !== false) {
        $activity_stats['deletes']++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Viewer - File Manager</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            padding: 30px;
            background: #f8f9fa;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .stat-card.uploads h3 {
            color: #27ae60;
        }

        .stat-card.downloads h3 {
            color: #3498db;
        }

        .stat-card.deletes h3 {
            color: #e74c3c;
        }

        .stat-card.total h3 {
            color: #9b59b6;
        }

        .stat-card.today h3 {
            color: #f39c12;
        }

        .content {
            padding: 30px;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .log-container {
            background: #2c3e50;
            border-radius: 10px;
            padding: 0;
            max-height: 600px;
            overflow-y: auto;
        }

        .log-header {
            background: #34495e;
            color: white;
            padding: 15px 20px;
            border-bottom: 1px solid #4a5f7a;
            font-weight: bold;
        }

        .log-entry {
            padding: 15px 20px;
            border-bottom: 1px solid #34495e;
            color: #ecf0f1;
            font-family: 'Courier New', monospace;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .log-entry:last-child {
            border-bottom: none;
        }

        .log-entry:hover {
            background: rgba(52, 73, 94, 0.5);
        }

        .log-time {
            color: #3498db;
            font-weight: bold;
            min-width: 150px;
            flex-shrink: 0;
        }

        .log-message {
            flex: 1;
        }

        .log-icon {
            font-size: 1.2em;
            min-width: 20px;
        }

        .log-upload .log-icon {
            color: #27ae60;
        }

        .log-download .log-icon {
            color: #3498db;
        }

        .log-delete .log-icon {
            color: #e74c3c;
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            color: #7f8c8d;
        }

        .empty-state .icon {
            font-size: 4em;
            margin-bottom: 20px;
        }

        .filter-section {
            margin-bottom: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .filter-section input,
        .filter-section select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .controls {
                flex-direction: column;
                align-items: stretch;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .log-entry {
                flex-direction: column;
                gap: 5px;
            }

            .log-time {
                min-width: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📊 Log Aktivitas</h1>
            <p>Riwayat aktivitas File Manager</p>
        </div>

        <div class="stats">
            <div class="stat-card uploads">
                <h3><?php echo $activity_stats['uploads']; ?></h3>
                <p>📤 Upload</p>
            </div>
            <div class="stat-card downloads">
                <h3><?php echo $activity_stats['downloads']; ?></h3>
                <p>📥 Download</p>
            </div>
            <div class="stat-card deletes">
                <h3><?php echo $activity_stats['deletes']; ?></h3>
                <p>🗑️ Delete</p>
            </div>
            <div class="stat-card total">
                <h3><?php echo $total_logs; ?></h3>
                <p>📝 Total Log</p>
            </div>
            <div class="stat-card today">
                <h3><?php echo $today_logs; ?></h3>
                <p>📅 Hari Ini</p>
            </div>
        </div>

        <div class="content">
            <div class="controls">
                <div>
                    <h2>📋 Riwayat Aktivitas</h2>
                </div>
                <div>
                    <a href="file-manager.php" class="btn btn-primary">← Kembali ke File Manager</a>
                    <?php if (!empty($logs)): ?>
                        <form method="POST" style="display: inline;"
                            onsubmit="return confirm('Yakin ingin menghapus semua log?')">
                            <button type="submit" name="clear_log" class="btn btn-danger">🗑️ Hapus Log</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (empty($logs)): ?>
                <div class="empty-state">
                    <div class="icon">📄</div>
                    <h3>Belum ada log aktivitas</h3>
                    <p>Log akan muncul setelah Anda melakukan aktivitas di File Manager</p>
                </div>
            <?php else: ?>
                <div class="filter-section">
                    <h3>🔍 Filter Log</h3>
                    <input type="text" id="searchFilter" placeholder="Cari dalam log..." onkeyup="filterLogs()">
                    <select id="typeFilter" onchange="filterLogs()">
                        <option value="">Semua Aktivitas</option>
                        <option value="uploaded">Upload</option>
                        <option value="downloaded">Download</option>
                        <option value="deleted">Delete</option>
                    </select>
                    <input type="date" id="dateFilter" value="<?php echo date('Y-m-d'); ?>" onchange="filterLogs()">
                </div>

                <div class="log-container">
                    <div class="log-header">
                        Menampilkan <?php echo count($logs); ?> entri log
                    </div>

                    <?php foreach ($logs as $index => $log): ?>
                        <?php
                        $log_class = '';
                        $icon = '📝';

                        if (strpos($log['message'], 'uploaded') !== false) {
                            $log_class = 'log-upload';
                            $icon = '📤';
                        } elseif (strpos($log['message'], 'downloaded') !== false) {
                            $log_class = 'log-download';
                            $icon = '📥';
                        } elseif (strpos($log['message'], 'deleted') !== false) {
                            $log_class = 'log-delete';
                            $icon = '🗑️';
                        }
                        ?>
                        <div class="log-entry <?php echo $log_class; ?>"
                            data-message="<?php echo strtolower($log['message']); ?>"
                            data-date="<?php echo date('Y-m-d', strtotime($log['timestamp'])); ?>">
                            <span class="log-icon"><?php echo $icon; ?></span>
                            <span class="log-time"><?php echo date('d/m/Y H:i:s', strtotime($log['timestamp'])); ?></span>
                            <span class="log-message"><?php echo htmlspecialchars($log['message']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (file_exists($log_file)): ?>
                <div style="margin-top: 30px; text-align: center;">
                    <p style="color: #666; font-size: 14px;">
                        Log file: <?php echo $log_file; ?>
                        (<?php echo number_format(filesize($log_file)); ?> bytes)
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function filterLogs() {
            const searchTerm = document.getElementById('searchFilter').value.toLowerCase();
            const typeFilter = document.getElementById('typeFilter').value;
            const dateFilter = document.getElementById('dateFilter').value;
            const logEntries = document.querySelectorAll('.log-entry');

            let visibleCount = 0;

            logEntries.forEach(entry => {
                const message = entry.getAttribute('data-message');
                const date = entry.getAttribute('data-date');

                let showEntry = true;

                // Filter berdasarkan pencarian teks
                if (searchTerm && !message.includes(searchTerm)) {
                    showEntry = false;
                }

                // Filter berdasarkan tipe aktivitas
                if (typeFilter && !message.includes(typeFilter)) {
                    showEntry = false;
                }

                // Filter berdasarkan tanggal
                if (dateFilter && date !== dateFilter) {
                    showEntry = false;
                }

                entry.style.display = showEntry ? 'flex' : 'none';
                if (showEntry) visibleCount++;
            });

            // Update header dengan jumlah yang terfilter
            const header = document.querySelector('.log-header');
            if (header) {
                header.textContent = `Menampilkan ${visibleCount} entri log`;
            }
        }

        // Real-time search
        document.getElementById('searchFilter').addEventListener('input', filterLogs);

        // Set default date filter to today
        document.addEventListener('DOMContentLoaded', function() {
            const dateFilter = document.getElementById('dateFilter');
            if (dateFilter) {
                dateFilter.value = new Date().toISOString().split('T')[0];
            }
        });
    </script>
</body>

</html>
