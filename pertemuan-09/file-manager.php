<?php

/**
 * Pertemuan 9: File Manager Sederhana
 * File: file-manager.php
 *
 * Sistem manajemen file dengan fitur upload, download, dan delete
 */

// Konfigurasi
define('UPLOAD_DIR', 'uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['txt', 'pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'gif']);

// Buat direktori upload jika belum ada
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

// Fungsi utility
function formatFileSize($bytes)
{
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, 2) . ' ' . $units[$pow];
}

function getFileIcon($extension)
{
    $icons = [
        'txt' => '📄',
        'pdf' => '📕',
        'doc' => '📘',
        'docx' => '📘',
        'jpg' => '🖼️',
        'jpeg' => '🖼️',
        'png' => '🖼️',
        'gif' => '🖼️'
    ];
    return $icons[$extension] ?? '📁';
}

function sanitizeFilename($filename)
{
    // Hapus path traversal dan karakter berbahaya
    $filename = basename($filename);
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    return $filename;
}

function validateUpload($file)
{
    $errors = [];

    // Cek error upload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error saat upload file';
        return $errors;
    }

    // Cek ukuran file
    if ($file['size'] > MAX_FILE_SIZE) {
        $errors[] = 'File terlalu besar (maksimal ' . formatFileSize(MAX_FILE_SIZE) . ')';
    }

    // Cek ekstensi file
    $filename = $file['name'];
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        $errors[] = 'Ekstensi file tidak diizinkan';
    }

    // Cek apakah benar-benar file
    if (!is_uploaded_file($file['tmp_name'])) {
        $errors[] = 'File tidak valid';
    }

    return $errors;
}

// Proses aksi
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'upload':
            if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
                $errors = validateUpload($_FILES['file']);

                if (empty($errors)) {
                    $original_name = $_FILES['file']['name'];
                    $safe_name = sanitizeFilename($original_name);
                    $target_path = UPLOAD_DIR . $safe_name;

                    // Cek apakah file sudah ada
                    if (file_exists($target_path)) {
                        $info = pathinfo($safe_name);
                        $name = $info['filename'];
                        $ext = $info['extension'] ?? '';
                        $counter = 1;

                        do {
                            $safe_name = $name . '_' . $counter . ($ext ? '.' . $ext : '');
                            $target_path = UPLOAD_DIR . $safe_name;
                            $counter++;
                        } while (file_exists($target_path));
                    }

                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                        $message = "File '$safe_name' berhasil diupload";
                        $message_type = 'success';

                        // Log aktivitas
                        $log_entry = date('Y-m-d H:i:s') . " - File uploaded: $safe_name\n";
                        file_put_contents('file_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
                    } else {
                        $message = 'Gagal mengupload file';
                        $message_type = 'error';
                    }
                } else {
                    $message = implode('<br>', $errors);
                    $message_type = 'error';
                }
            } else {
                $message = 'Pilih file untuk diupload';
                $message_type = 'error';
            }
            break;

        case 'delete':
            $filename = $_POST['filename'] ?? '';
            $file_path = UPLOAD_DIR . basename($filename);

            if (file_exists($file_path)) {
                if (unlink($file_path)) {
                    $message = "File '$filename' berhasil dihapus";
                    $message_type = 'success';

                    // Log aktivitas
                    $log_entry = date('Y-m-d H:i:s') . " - File deleted: $filename\n";
                    file_put_contents('file_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
                } else {
                    $message = 'Gagal menghapus file';
                    $message_type = 'error';
                }
            } else {
                $message = 'File tidak ditemukan';
                $message_type = 'error';
            }
            break;
    }
}

// Handle download
if (isset($_GET['download'])) {
    $filename = basename($_GET['download']);
    $file_path = UPLOAD_DIR . $filename;

    if (file_exists($file_path)) {
        // Log aktivitas
        $log_entry = date('Y-m-d H:i:s') . " - File downloaded: $filename\n";
        file_put_contents('file_log.txt', $log_entry, FILE_APPEND | LOCK_EX);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }
}

// Ambil daftar file
$files = [];
if (is_dir(UPLOAD_DIR)) {
    $scan = scandir(UPLOAD_DIR);
    foreach ($scan as $file) {
        if ($file !== '.' && $file !== '..' && is_file(UPLOAD_DIR . $file)) {
            $file_path = UPLOAD_DIR . $file;
            $files[] = [
                'name' => $file,
                'size' => filesize($file_path),
                'modified' => filemtime($file_path),
                'extension' => strtolower(pathinfo($file, PATHINFO_EXTENSION))
            ];
        }
    }

    // Urutkan berdasarkan waktu modifikasi terbaru
    usort($files, function ($a, $b) {
        return $b['modified'] - $a['modified'];
    });
}

// Statistik
$total_files = count($files);
$total_size = array_sum(array_column($files, 'size'));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
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
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(45deg, #4CAF50, #45a049);
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
            font-size: 2em;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
        }

        .upload-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .upload-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: end;
        }

        .file-input {
            flex: 1;
            min-width: 200px;
        }

        .file-input input {
            width: 100%;
            padding: 12px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            background: white;
            cursor: pointer;
        }

        .file-input input:hover {
            border-color: #4CAF50;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background: #45a049;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
            font-size: 14px;
            padding: 8px 16px;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .btn-info {
            background: #3498db;
            color: white;
            font-size: 14px;
            padding: 8px 16px;
        }

        .btn-info:hover {
            background: #2980b9;
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

        .files-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .files-table th {
            background: #4CAF50;
            color: white;
            padding: 15px;
            text-align: left;
        }

        .files-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .files-table tr:hover {
            background: #f8f9fa;
        }

        .file-icon {
            font-size: 1.5em;
            margin-right: 10px;
        }

        .file-actions {
            display: flex;
            gap: 10px;
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            color: #666;
        }

        .empty-state .icon {
            font-size: 4em;
            margin-bottom: 20px;
        }

        .allowed-types {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .upload-form {
                flex-direction: column;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .files-table {
                font-size: 14px;
            }

            .file-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📁 File Manager</h1>
            <p>Sistem manajemen file sederhana dengan PHP</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3><?php echo $total_files; ?></h3>
                <p>Total File</p>
            </div>
            <div class="stat-card">
                <h3><?php echo formatFileSize($total_size); ?></h3>
                <p>Total Ukuran</p>
            </div>
            <div class="stat-card">
                <h3><?php echo formatFileSize(MAX_FILE_SIZE); ?></h3>
                <p>Maks Per File</p>
            </div>
        </div>

        <div class="content">
            <!-- Upload Section -->
            <div class="upload-section">
                <h2>📤 Upload File</h2>
                <form method="POST" enctype="multipart/form-data" class="upload-form">
                    <input type="hidden" name="action" value="upload">
                    <div class="file-input">
                        <input type="file" name="file" required>
                        <div class="allowed-types">
                            Tipe file yang diizinkan: <?php echo implode(', ', ALLOWED_EXTENSIONS); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>

            <!-- Messages -->
            <?php if ($message): ?>
                <div class="message message-<?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <!-- Files List -->
            <h2>📋 Daftar File</h2>
            <?php if (empty($files)): ?>
                <div class="empty-state">
                    <div class="icon">📂</div>
                    <h3>Belum ada file</h3>
                    <p>Upload file pertama Anda menggunakan form di atas</p>
                </div>
            <?php else: ?>
                <table class="files-table">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Ukuran</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($files as $file): ?>
                            <tr>
                                <td>
                                    <span class="file-icon"><?php echo getFileIcon($file['extension']); ?></span>
                                    <?php echo htmlspecialchars($file['name']); ?>
                                </td>
                                <td><?php echo formatFileSize($file['size']); ?></td>
                                <td><?php echo date('d/m/Y H:i', $file['modified']); ?></td>
                                <td>
                                    <div class="file-actions">
                                        <a href="?download=<?php echo urlencode($file['name']); ?>"
                                            class="btn btn-info">Download</a>

                                        <form method="POST" style="display: inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="filename" value="<?php echo htmlspecialchars($file['name']); ?>">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <div style="text-align: center; margin-top: 30px;">
                <a href="log-viewer.php" class="btn btn-info">📄 Lihat Log Aktivitas</a>
                <a href="../pertemuan-10/" class="btn btn-primary">➡️ Lanjut ke Pertemuan 10</a>
            </div>
        </div>
    </div>
</body>

</html>
