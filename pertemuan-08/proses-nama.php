<?php

/**
 * Pertemuan 8: Proses Form Input
 * File: proses-nama.php
 *
 * Memproses data dari form dan mendemonstrasikan validasi
 */

// Fungsi untuk escape output (mencegah XSS)
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Fungsi validasi nama
function validateName($name)
{
    if (empty($name)) {
        return "Nama wajib diisi";
    }
    if (strlen($name) < 2) {
        return "Nama minimal 2 karakter";
    }
    if (strlen($name) > 100) {
        return "Nama maksimal 100 karakter";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        return "Nama hanya boleh berisi huruf dan spasi";
    }
    return true;
}

// Fungsi validasi email
function validateEmail($email)
{
    if (empty($email)) {
        return "Email wajib diisi";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Format email tidak valid";
    }
    return true;
}

// Fungsi validasi umur
function validateAge($age)
{
    if (empty($age)) {
        return "Umur wajib diisi";
    }
    if (!is_numeric($age)) {
        return "Umur harus berupa angka";
    }
    if ($age < 1 || $age > 120) {
        return "Umur harus antara 1-120 tahun";
    }
    return true;
}

// Deteksi method yang digunakan
$method = $_SERVER['REQUEST_METHOD'];
$data = [];
$errors = [];

// Proses data berdasarkan method
if ($method === 'GET') {
    $data = $_GET;
} elseif ($method === 'POST') {
    $data = $_POST;
}

// Validasi data jika ada
if (!empty($data)) {
    // Validasi nama
    if (isset($data['nama'])) {
        $nameValidation = validateName($data['nama']);
        if ($nameValidation !== true) {
            $errors['nama'] = $nameValidation;
        }
    }

    // Validasi email (jika ada)
    if (isset($data['email'])) {
        $emailValidation = validateEmail($data['email']);
        if ($emailValidation !== true) {
            $errors['email'] = $emailValidation;
        }
    }

    // Validasi umur (jika ada)
    if (isset($data['umur'])) {
        $ageValidation = validateAge($data['umur']);
        if ($ageValidation !== true) {
            $errors['umur'] = $ageValidation;
        }
    }
}

// Hitung statistik data
$dataStats = [
    'total_fields' => count($data),
    'total_errors' => count($errors),
    'success_rate' => count($data) > 0 ? ((count($data) - count($errors)) / count($data)) * 100 : 0
];

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Proses Form</title>
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

        .result-section {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .method-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 0.9em;
        }

        .method-get {
            background-color: #2196F3;
        }

        .method-post {
            background-color: #4CAF50;
        }

        .success-box {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .error-box {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .info-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .data-table th {
            background-color: #4CAF50;
            color: white;
        }

        .data-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin: 5px;
        }

        .btn:hover {
            background: #45a049;
        }

        .debug-section {
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
            white-space: pre-wrap;
        }

        .stats-section {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            height: 20px;
            margin: 10px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50, #45a049);
            border-radius: 10px;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📊 Hasil Proses Form</h1>

        <!-- Method Detection -->
        <div class="result-section">
            <h2>🔍 Informasi Request</h2>
            <p>
                Method yang digunakan:
                <span class="method-badge <?php echo strtolower($method) === 'get' ? 'method-get' : 'method-post'; ?>">
                    <?php echo $method; ?>
                </span>
            </p>
            <p><strong>Waktu Request:</strong> <?php echo date('d F Y, H:i:s'); ?></p>
            <p><strong>User Agent:</strong> <?php echo h($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'); ?></p>
            <p><strong>IP Address:</strong> <?php echo $_SERVER['REMOTE_ADDR'] ?? 'Unknown'; ?></p>
        </div>

        <?php if (!empty($data)): ?>
            <!-- Statistics -->
            <div class="stats-section">
                <h2>📈 Statistik Validasi</h2>
                <div class="info-grid">
                    <div class="info-card">
                        <h3><?php echo $dataStats['total_fields']; ?></h3>
                        <p>Total Field</p>
                    </div>
                    <div class="info-card">
                        <h3><?php echo $dataStats['total_errors']; ?></h3>
                        <p>Total Error</p>
                    </div>
                    <div class="info-card">
                        <h3><?php echo number_format($dataStats['success_rate'], 1); ?>%</h3>
                        <p>Success Rate</p>
                    </div>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $dataStats['success_rate']; ?>%"></div>
                </div>
                <p style="text-align: center;">
                    <?php if ($dataStats['success_rate'] == 100): ?>
                        ✅ Semua data valid!
                    <?php elseif ($dataStats['success_rate'] >= 70): ?>
                        ⚠️ Sebagian besar data valid
                    <?php else: ?>
                        ❌ Banyak error yang perlu diperbaiki
                    <?php endif; ?>
                </p>
            </div>

            <!-- Results -->
            <?php if (empty($errors)): ?>
                <div class="success-box">
                    <h3>✅ Data Berhasil Diproses!</h3>
                    <p>Semua data yang dikirim valid dan telah diproses dengan sukses.</p>
                </div>
            <?php else: ?>
                <div class="error-box">
                    <h3>❌ Terdapat Error pada Data</h3>
                    <ul>
                        <?php foreach ($errors as $field => $error): ?>
                            <li><strong><?php echo ucfirst($field); ?>:</strong> <?php echo h($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Data Display -->
            <div class="result-section">
                <h2>📋 Data yang Diterima</h2>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                            <th>Type</th>
                            <th>Length</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $value): ?>
                            <tr>
                                <td><strong><?php echo h($key); ?></strong></td>
                                <td><?php echo h($value); ?></td>
                                <td><?php echo gettype($value); ?></td>
                                <td><?php echo strlen($value); ?> char</td>
                                <td>
                                    <?php if (isset($errors[$key])): ?>
                                        <span style="color: #dc3545;">❌ Error</span>
                                    <?php else: ?>
                                        <span style="color: #28a745;">✅ Valid</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Processed Data Preview -->
            <?php if (empty($errors)): ?>
                <div class="result-section">
                    <h2>🎯 Data Terproses</h2>

                    <?php if (isset($data['nama'])): ?>
                        <div class="success-box">
                            <h4>Selamat datang, <?php echo h(ucwords($data['nama'])); ?>! 👋</h4>

                            <?php if (isset($data['umur'])): ?>
                                <p>Umur Anda: <?php echo h($data['umur']); ?> tahun</p>

                                <?php
                                $kategori_umur = '';
                                $umur = (int)$data['umur'];
                                if ($umur < 13) $kategori_umur = 'Anak-anak';
                                elseif ($umur < 18) $kategori_umur = 'Remaja';
                                elseif ($umur < 60) $kategori_umur = 'Dewasa';
                                else $kategori_umur = 'Lansia';
                                ?>
                                <p>Kategori: <strong><?php echo $kategori_umur; ?></strong></p>
                            <?php endif; ?>

                            <?php if (isset($data['kota'])): ?>
                                <p>Kota asal: <?php echo h($data['kota']); ?></p>
                            <?php endif; ?>

                            <?php if (isset($data['email'])): ?>
                                <p>Email: <?php echo h($data['email']); ?></p>
                            <?php endif; ?>

                            <?php if (isset($data['telepon'])): ?>
                                <p>Telepon: <?php echo h($data['telepon']); ?></p>
                            <?php endif; ?>

                            <?php if (isset($data['pesan'])): ?>
                                <p><strong>Pesan Anda:</strong></p>
                                <div style="background: #f8f9fa; padding: 10px; border-radius: 5px; border-left: 3px solid #007bff;">
                                    <?php echo nl2br(h($data['pesan'])); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($data['newsletter'])): ?>
                                <p>✅ Anda telah berlangganan newsletter</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <!-- No Data -->
            <div class="result-section">
                <h2>❓ Tidak Ada Data</h2>
                <p>Tidak ada data yang dikirim melalui form. Silakan kembali dan isi form terlebih dahulu.</p>
            </div>
        <?php endif; ?>

        <!-- Debug Information -->
        <div class="debug-section">
            <h2>🔧 Debug Information</h2>

            <h3>$_GET Data:</h3>
            <div class="code-block"><?php print_r($_GET); ?></div>

            <h3>$_POST Data:</h3>
            <div class="code-block"><?php print_r($_POST); ?></div>

            <h3>$_SERVER (Request Info):</h3>
            <div class="code-block">
                REQUEST_METHOD: <?php echo $_SERVER['REQUEST_METHOD']; ?>
                REQUEST_URI: <?php echo $_SERVER['REQUEST_URI'] ?? 'N/A'; ?>
                QUERY_STRING: <?php echo $_SERVER['QUERY_STRING'] ?? 'N/A'; ?>
                HTTP_REFERER: <?php echo $_SERVER['HTTP_REFERER'] ?? 'N/A'; ?>
            </div>
        </div>

        <!-- Navigation -->
        <div style="text-align: center; margin-top: 30px;">
            <a href="form-nama.html" class="btn">← Kembali ke Form</a>
            <a href="form-validasi.php" class="btn">Form dengan Validasi Lengkap →</a>
        </div>

        <div style="text-align: center; margin-top: 30px; font-style: italic;">
            <small>Diproses pada: <?php echo date('d F Y, H:i:s'); ?></small>
        </div>
    </div>
</body>

</html>
