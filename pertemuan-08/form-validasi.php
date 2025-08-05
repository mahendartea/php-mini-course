<?php

/**
 * Pertemuan 8: Form dengan Validasi Lengkap
 * File: form-validasi.php
 *
 * Contoh form dengan validasi client-side dan server-side
 */

// Inisialisasi variabel
$errors = [];
$data = [];
$success = false;

// Fungsi validasi
function sanitize($input)
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function validateRequired($value, $fieldName)
{
    if (empty($value)) {
        return "$fieldName wajib diisi";
    }
    return null;
}

function validateName($name)
{
    if (empty($name)) return "Nama wajib diisi";
    if (strlen($name) < 2) return "Nama minimal 2 karakter";
    if (strlen($name) > 50) return "Nama maksimal 50 karakter";
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) return "Nama hanya boleh berisi huruf dan spasi";
    return null;
}

function validateEmail($email)
{
    if (empty($email)) return "Email wajib diisi";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Format email tidak valid";
    return null;
}

function validatePhone($phone)
{
    if (empty($phone)) return "Nomor telepon wajib diisi";
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone) < 10 || strlen($phone) > 15) return "Nomor telepon harus 10-15 digit";
    return null;
}

function validateAge($age)
{
    if (empty($age)) return "Umur wajib diisi";
    if (!is_numeric($age)) return "Umur harus berupa angka";
    if ($age < 1 || $age > 120) return "Umur harus antara 1-120 tahun";
    return null;
}

// Proses form jika method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitize data
    $data['nama'] = sanitize($_POST['nama'] ?? '');
    $data['email'] = sanitize($_POST['email'] ?? '');
    $data['telepon'] = sanitize($_POST['telepon'] ?? '');
    $data['umur'] = sanitize($_POST['umur'] ?? '');
    $data['jenis_kelamin'] = sanitize($_POST['jenis_kelamin'] ?? '');
    $data['kota'] = sanitize($_POST['kota'] ?? '');
    $data['hobi'] = $_POST['hobi'] ?? [];
    $data['pesan'] = sanitize($_POST['pesan'] ?? '');
    $data['newsletter'] = isset($_POST['newsletter']);

    // Validasi setiap field
    if ($error = validateName($data['nama'])) $errors['nama'] = $error;
    if ($error = validateEmail($data['email'])) $errors['email'] = $error;
    if ($error = validatePhone($data['telepon'])) $errors['telepon'] = $error;
    if ($error = validateAge($data['umur'])) $errors['umur'] = $error;
    if ($error = validateRequired($data['jenis_kelamin'], 'Jenis kelamin')) $errors['jenis_kelamin'] = $error;
    if ($error = validateRequired($data['kota'], 'Kota')) $errors['kota'] = $error;

    // Validasi hobi (minimal 1)
    if (empty($data['hobi'])) {
        $errors['hobi'] = 'Pilih minimal 1 hobi';
    }

    // Validasi pesan
    if (empty($data['pesan'])) {
        $errors['pesan'] = 'Pesan wajib diisi';
    } elseif (strlen($data['pesan']) > 500) {
        $errors['pesan'] = 'Pesan maksimal 500 karakter';
    }

    // Jika tidak ada error, proses berhasil
    if (empty($errors)) {
        $success = true;
        // Di sini bisa ditambahkan kode untuk menyimpan ke database
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form dengan Validasi Lengkap</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        .required {
            color: #e74c3c;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        .error {
            border-color: #e74c3c !important;
            box-shadow: 0 0 10px rgba(231, 76, 60, 0.3) !important;
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .checkbox-group,
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        .checkbox-item,
        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input[type="checkbox"],
        input[type="radio"] {
            width: auto;
            margin: 0;
        }

        .btn {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .btn:hover {
            background: linear-gradient(45deg, #45a049, #4CAF50);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #6c757d;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .checkbox-group,
            .radio-group {
                flex-direction: column;
            }
        }

        .counter {
            font-size: 12px;
            color: #666;
            text-align: right;
            margin-top: 5px;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #f0f0f0;
            border-radius: 3px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50, #45a049);
            border-radius: 3px;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📝 Form Biodata Lengkap</h1>

        <!-- Progress Bar -->
        <div class="progress-bar">
            <div class="progress-fill" id="progressBar" style="width: 0%"></div>
        </div>

        <?php if ($success): ?>
            <div class="success-message">
                <h3>✅ Data Berhasil Dikirim!</h3>
                <p>Terima kasih <strong><?php echo htmlspecialchars($data['nama']); ?></strong>, data Anda telah berhasil diproses.</p>

                <h4>Ringkasan Data:</h4>
                <ul>
                    <li><strong>Nama:</strong> <?php echo htmlspecialchars($data['nama']); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></li>
                    <li><strong>Telepon:</strong> <?php echo htmlspecialchars($data['telepon']); ?></li>
                    <li><strong>Umur:</strong> <?php echo htmlspecialchars($data['umur']); ?> tahun</li>
                    <li><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($data['jenis_kelamin']); ?></li>
                    <li><strong>Kota:</strong> <?php echo htmlspecialchars($data['kota']); ?></li>
                    <li><strong>Hobi:</strong> <?php echo implode(', ', $data['hobi']); ?></li>
                    <li><strong>Newsletter:</strong> <?php echo $data['newsletter'] ? 'Ya' : 'Tidak'; ?></li>
                </ul>

                <button type="button" class="btn" onclick="window.location.reload();">Isi Form Lagi</button>
            </div>
        <?php else: ?>
            <form method="POST" id="biodataForm" novalidate>
                <!-- Nama dan Email -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="nama" name="nama"
                            value="<?php echo htmlspecialchars($data['nama'] ?? ''); ?>"
                            class="<?php echo isset($errors['nama']) ? 'error' : ''; ?>"
                            required>
                        <?php if (isset($errors['nama'])): ?>
                            <span class="error-message"><?php echo $errors['nama']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email"
                            value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>"
                            class="<?php echo isset($errors['email']) ? 'error' : ''; ?>"
                            required>
                        <?php if (isset($errors['email'])): ?>
                            <span class="error-message"><?php echo $errors['email']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Telepon dan Umur -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon <span class="required">*</span></label>
                        <input type="tel" id="telepon" name="telepon"
                            value="<?php echo htmlspecialchars($data['telepon'] ?? ''); ?>"
                            class="<?php echo isset($errors['telepon']) ? 'error' : ''; ?>"
                            placeholder="081234567890"
                            required>
                        <?php if (isset($errors['telepon'])): ?>
                            <span class="error-message"><?php echo $errors['telepon']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="umur">Umur <span class="required">*</span></label>
                        <input type="number" id="umur" name="umur"
                            value="<?php echo htmlspecialchars($data['umur'] ?? ''); ?>"
                            class="<?php echo isset($errors['umur']) ? 'error' : ''; ?>"
                            min="1" max="120"
                            required>
                        <?php if (isset($errors['umur'])): ?>
                            <span class="error-message"><?php echo $errors['umur']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group">
                    <label>Jenis Kelamin <span class="required">*</span></label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki"
                                <?php echo (($data['jenis_kelamin'] ?? '') === 'Laki-laki') ? 'checked' : ''; ?>>
                            <label for="laki">Laki-laki</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                                <?php echo (($data['jenis_kelamin'] ?? '') === 'Perempuan') ? 'checked' : ''; ?>>
                            <label for="perempuan">Perempuan</label>
                        </div>
                    </div>
                    <?php if (isset($errors['jenis_kelamin'])): ?>
                        <span class="error-message"><?php echo $errors['jenis_kelamin']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Kota -->
                <div class="form-group">
                    <label for="kota">Kota Asal <span class="required">*</span></label>
                    <select id="kota" name="kota" class="<?php echo isset($errors['kota']) ? 'error' : ''; ?>" required>
                        <option value="">Pilih Kota</option>
                        <option value="Jakarta" <?php echo (($data['kota'] ?? '') === 'Jakarta') ? 'selected' : ''; ?>>Jakarta</option>
                        <option value="Surabaya" <?php echo (($data['kota'] ?? '') === 'Surabaya') ? 'selected' : ''; ?>>Surabaya</option>
                        <option value="Bandung" <?php echo (($data['kota'] ?? '') === 'Bandung') ? 'selected' : ''; ?>>Bandung</option>
                        <option value="Medan" <?php echo (($data['kota'] ?? '') === 'Medan') ? 'selected' : ''; ?>>Medan</option>
                        <option value="Semarang" <?php echo (($data['kota'] ?? '') === 'Semarang') ? 'selected' : ''; ?>>Semarang</option>
                        <option value="Makassar" <?php echo (($data['kota'] ?? '') === 'Makassar') ? 'selected' : ''; ?>>Makassar</option>
                        <option value="Yogyakarta" <?php echo (($data['kota'] ?? '') === 'Yogyakarta') ? 'selected' : ''; ?>>Yogyakarta</option>
                        <option value="Lainnya" <?php echo (($data['kota'] ?? '') === 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                    </select>
                    <?php if (isset($errors['kota'])): ?>
                        <span class="error-message"><?php echo $errors['kota']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Hobi -->
                <div class="form-group">
                    <label>Hobi <span class="required">*</span></label>
                    <div class="checkbox-group">
                        <?php
                        $hobi_options = ['Membaca', 'Menulis', 'Olahraga', 'Musik', 'Gaming', 'Traveling', 'Fotografi', 'Memasak'];
                        $selected_hobi = $data['hobi'] ?? [];
                        ?>
                        <?php foreach ($hobi_options as $hobi): ?>
                            <div class="checkbox-item">
                                <input type="checkbox" id="hobi_<?php echo strtolower($hobi); ?>" name="hobi[]" value="<?php echo $hobi; ?>"
                                    <?php echo in_array($hobi, $selected_hobi) ? 'checked' : ''; ?>>
                                <label for="hobi_<?php echo strtolower($hobi); ?>"><?php echo $hobi; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (isset($errors['hobi'])): ?>
                        <span class="error-message"><?php echo $errors['hobi']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Pesan -->
                <div class="form-group">
                    <label for="pesan">Pesan / Komentar <span class="required">*</span></label>
                    <textarea id="pesan" name="pesan" rows="4"
                        class="<?php echo isset($errors['pesan']) ? 'error' : ''; ?>"
                        placeholder="Ceritakan tentang diri Anda..."
                        maxlength="500"
                        required><?php echo htmlspecialchars($data['pesan'] ?? ''); ?></textarea>
                    <div class="counter">
                        <span id="charCount">0</span>/500 karakter
                    </div>
                    <?php if (isset($errors['pesan'])): ?>
                        <span class="error-message"><?php echo $errors['pesan']; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Newsletter -->
                <div class="form-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="newsletter" name="newsletter" value="1"
                            <?php echo ($data['newsletter'] ?? false) ? 'checked' : ''; ?>>
                        <label for="newsletter">Saya ingin berlangganan newsletter</label>
                    </div>
                </div>

                <button type="submit" class="btn" id="submitBtn">📤 Kirim Data</button>
                <button type="reset" class="btn btn-secondary">🔄 Reset Form</button>
            </form>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 30px;">
            <a href="form-nama.html" style="color: #666; text-decoration: none;">← Kembali ke Form Sederhana</a>
        </div>
    </div>

    <script>
        // Real-time validation dan progress tracking
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('biodataForm');
            const progressBar = document.getElementById('progressBar');
            const charCount = document.getElementById('charCount');
            const pesanField = document.getElementById('pesan');

            // Update character count
            function updateCharCount() {
                const count = pesanField.value.length;
                charCount.textContent = count;
                charCount.style.color = count > 450 ? '#e74c3c' : '#666';
            }

            // Calculate form completion progress
            function updateProgress() {
                const requiredFields = form.querySelectorAll('[required]');
                const radioGroups = form.querySelectorAll('input[type="radio"]');
                const checkboxGroups = form.querySelectorAll('input[type="checkbox"][name="hobi[]"]');

                let filledFields = 0;
                let totalFields = requiredFields.length;

                // Check regular required fields
                requiredFields.forEach(field => {
                    if (field.type === 'radio') return; // Skip radio, handle separately
                    if (field.name === 'hobi[]') return; // Skip hobi checkboxes, handle separately

                    if (field.value.trim() !== '') {
                        filledFields++;
                    }
                });

                // Check radio groups (jenis_kelamin)
                const selectedRadio = form.querySelector('input[name="jenis_kelamin"]:checked');
                if (selectedRadio) {
                    filledFields++;
                } else {
                    totalFields++; // Add to total if not counted yet
                }

                // Check hobi checkboxes (at least one must be selected)
                const selectedHobi = form.querySelectorAll('input[name="hobi[]"]:checked');
                if (selectedHobi.length > 0) {
                    filledFields++;
                } else {
                    totalFields++; // Add to total if not counted yet
                }

                // Adjust total fields count
                totalFields = 7; // nama, email, telepon, umur, jenis_kelamin, kota, hobi, pesan

                const progress = (filledFields / totalFields) * 100;
                progressBar.style.width = progress + '%';
            }

            // Event listeners
            if (pesanField) {
                pesanField.addEventListener('input', updateCharCount);
                updateCharCount(); // Initial count
            }

            // Add event listeners to all form fields
            const allFields = form.querySelectorAll('input, select, textarea');
            allFields.forEach(field => {
                field.addEventListener('input', updateProgress);
                field.addEventListener('change', updateProgress);
            });

            // Initial progress calculation
            updateProgress();

            // Client-side validation
            form.addEventListener('submit', function(e) {
                let hasErrors = false;

                // Remove previous error states
                form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
                form.querySelectorAll('.error-message').forEach(el => el.remove());

                // Validate nama
                const nama = form.nama.value.trim();
                if (nama.length < 2) {
                    showError(form.nama, 'Nama minimal 2 karakter');
                    hasErrors = true;
                }

                // Validate email
                const email = form.email.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    showError(form.email, 'Format email tidak valid');
                    hasErrors = true;
                }

                // Validate telepon
                const telepon = form.telepon.value.replace(/[^0-9]/g, '');
                if (telepon.length < 10 || telepon.length > 15) {
                    showError(form.telepon, 'Nomor telepon harus 10-15 digit');
                    hasErrors = true;
                }

                // Validate umur
                const umur = parseInt(form.umur.value);
                if (umur < 1 || umur > 120) {
                    showError(form.umur, 'Umur harus antara 1-120 tahun');
                    hasErrors = true;
                }

                // Validate jenis kelamin
                const jenisKelamin = form.querySelector('input[name="jenis_kelamin"]:checked');
                if (!jenisKelamin) {
                    showError(form.querySelector('input[name="jenis_kelamin"]'), 'Pilih jenis kelamin');
                    hasErrors = true;
                }

                // Validate hobi
                const hobi = form.querySelectorAll('input[name="hobi[]"]:checked');
                if (hobi.length === 0) {
                    showError(form.querySelector('input[name="hobi[]"]'), 'Pilih minimal 1 hobi');
                    hasErrors = true;
                }

                // Validate pesan
                const pesan = form.pesan.value.trim();
                if (pesan.length === 0) {
                    showError(form.pesan, 'Pesan wajib diisi');
                    hasErrors = true;
                } else if (pesan.length > 500) {
                    showError(form.pesan, 'Pesan maksimal 500 karakter');
                    hasErrors = true;
                }

                if (hasErrors) {
                    e.preventDefault();
                    form.querySelector('.error').scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });

            function showError(field, message) {
                field.classList.add('error');
                const errorSpan = document.createElement('span');
                errorSpan.className = 'error-message';
                errorSpan.textContent = message;
                field.parentNode.appendChild(errorSpan);
            }
        });
    </script>
</body>

</html>
