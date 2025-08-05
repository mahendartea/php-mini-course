# Pertemuan 8: Form Input & Validasi Dasar

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami cara kerja form HTML dengan PHP
- Menggunakan metode GET dan POST
- Melakukan validasi input form
- Menangani error dan memberikan feedback
- Mengimplementasikan security dasar (XSS prevention)

## Materi Teori

### 1. Form HTML dan PHP
Form HTML adalah cara utama untuk mengumpulkan input dari user di web. PHP dapat memproses data form melalui superglobal arrays `$_GET`, `$_POST`, dan `$_REQUEST`.

#### Basic Form Structure
```html
<form method="POST" action="process.php">
    <input type="text" name="username" required>
    <input type="email" name="email" required>
    <input type="submit" value="Submit">
</form>
```

### 2. Metode HTTP: GET vs POST

#### GET Method
```html
<form method="GET" action="search.php">
    <input type="text" name="query">
    <input type="submit" value="Search">
</form>
```

**Karakteristik GET:**
- Data dikirim melalui URL query string
- Visible di address bar
- Limited data size (~2048 characters)
- Dapat di-bookmark
- Idempotent (aman untuk diulang)
- Cocok untuk search, filter, pagination

#### POST Method
```html
<form method="POST" action="register.php">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="Register">
</form>
```

**Karakteristik POST:**
- Data dikirim di request body
- Not visible di URL
- No size limit (praktis)
- Cannot be bookmarked
- Not idempotent
- Cocok untuk create, update, delete operations

### 3. Superglobal Arrays

#### $_GET
```php
// URL: page.php?name=John&age=25
echo $_GET['name']; // John
echo $_GET['age'];  // 25
```

#### $_POST
```php
// Form dengan method="POST"
if ($_POST['username']) {
    echo "Username: " . $_POST['username'];
}
```

#### $_REQUEST (tidak disarankan)
```php
// Kombinasi $_GET, $_POST, $_COOKIE
echo $_REQUEST['data']; // bisa dari GET atau POST
```

### 4. Validasi Input

#### Cek Keberadaan Data
```php
// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form
}

// Cek apakah field ada dan tidak kosong
if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = $_POST['username'];
}

// PHP 7+ Null Coalescing
$username = $_POST['username'] ?? '';
```

#### Validasi Required Fields
```php
function validateRequired($data, $fields) {
    $errors = [];
    foreach ($fields as $field) {
        if (empty($data[$field])) {
            $errors[] = "$field is required";
        }
    }
    return $errors;
}

$required = ['name', 'email', 'phone'];
$errors = validateRequired($_POST, $required);
```

#### Validasi Email
```php
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }
    return true;
}
```

#### Validasi Panjang String
```php
function validateLength($value, $min, $max, $fieldName) {
    $length = strlen($value);
    if ($length < $min || $length > $max) {
        return "$fieldName must be between $min-$max characters";
    }
    return true;
}
```

#### Validasi Numerik
```php
function validateNumber($value, $min = null, $max = null) {
    if (!is_numeric($value)) {
        return "Must be a number";
    }

    $num = (float)$value;
    if ($min !== null && $num < $min) {
        return "Must be at least $min";
    }
    if ($max !== null && $num > $max) {
        return "Must be at most $max";
    }

    return true;
}
```

### 5. Security Considerations

#### XSS Prevention
```php
// Selalu escape output
echo htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');

// Function helper
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
echo h($_POST['username']);
```

#### Input Sanitization
```php
// Sanitize string
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

// Sanitize email
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

// Remove whitespace
$username = trim($_POST['username']);
```

#### CSRF Protection (Basic)
```php
// Generate token
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Include in form
echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';

// Validate token
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('CSRF token mismatch');
}
```

### 6. File Upload

#### Basic File Upload
```html
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="upload">
    <input type="submit" value="Upload">
</form>
```

```php
if ($_FILES['upload']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['upload']['name']);

    if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile)) {
        echo "File uploaded successfully";
    }
}
```

#### File Upload Validation
```php
function validateFileUpload($file, $allowedTypes = [], $maxSize = 2097152) {
    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "Upload error occurred";
    }

    // Check file size
    if ($file['size'] > $maxSize) {
        return "File too large";
    }

    // Check file type
    if (!empty($allowedTypes)) {
        $fileType = mime_content_type($file['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            return "File type not allowed";
        }
    }

    return true;
}
```

### 7. Form State Management

#### Preserve Form Values
```php
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
?>
<form method="POST">
    <input type="text" name="name" value="<?php echo h($name); ?>">
    <input type="email" name="email" value="<?php echo h($email); ?>">
    <input type="submit" value="Submit">
</form>
```

#### Remember Selections
```php
$selectedCountry = $_POST['country'] ?? '';
$countries = ['ID' => 'Indonesia', 'MY' => 'Malaysia', 'SG' => 'Singapore'];
?>
<select name="country">
    <?php foreach ($countries as $code => $name): ?>
        <option value="<?php echo $code; ?>"
                <?php echo $selectedCountry === $code ? 'selected' : ''; ?>>
            <?php echo $name; ?>
        </option>
    <?php endforeach; ?>
</select>
```

### 8. Error Handling dan Display

#### Error Collection
```php
class FormValidator {
    private $errors = [];

    public function addError($field, $message) {
        $this->errors[$field][] = $message;
    }

    public function hasErrors() {
        return !empty($this->errors);
    }

    public function getErrors($field = null) {
        if ($field) {
            return $this->errors[$field] ?? [];
        }
        return $this->errors;
    }

    public function displayErrors($field) {
        $errors = $this->getErrors($field);
        if (!empty($errors)) {
            echo '<div class="error">' . implode('<br>', $errors) . '</div>';
        }
    }
}
```

#### Success Messages
```php
session_start();

// Set success message
$_SESSION['success'] = "Data saved successfully!";

// Display and clear
if (isset($_SESSION['success'])) {
    echo '<div class="success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
```

### 9. Complete Form Example

```php
<?php
session_start();
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        $errors[] = 'Invalid request';
    } else {
        // Validate inputs
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $age = trim($_POST['age'] ?? '');

        if (empty($name)) {
            $errors['name'][] = 'Name is required';
        }

        if (empty($email)) {
            $errors['email'][] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Invalid email format';
        }

        if (empty($age)) {
            $errors['age'][] = 'Age is required';
        } elseif (!is_numeric($age) || $age < 1 || $age > 120) {
            $errors['age'][] = 'Age must be between 1-120';
        }

        // If no errors, process data
        if (empty($errors)) {
            // Save to database or file
            $_SESSION['success'] = 'Registration successful!';
            $success = true;

            // Clear form data
            $name = $email = $age = '';
        }
    }
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
```

## Praktikum

### Latihan 1: Form Nama Sederhana
File: `form-nama.html` dan `proses-nama.php`

### Latihan 2: Form Registrasi Lengkap
File: `form-registrasi.php`

### Latihan 3: Form dengan Validasi
File: `form-validasi.php`

### Latihan 4: Upload File
File: `upload-form.php`

## Best Practices

### 1. Always Validate on Server Side
```php
// ❌ Never trust client-side validation alone
// ✅ Always validate on server side
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email required';
}
```

### 2. Sanitize Input, Escape Output
```php
// Sanitize input
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));

// Escape output
echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
```

### 3. Use POST for Sensitive Data
```php
// ❌ Don't use GET for passwords
// ✅ Use POST for sensitive data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
}
```

### 4. Provide Good User Experience
```php
// Preserve form values on error
$email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);
echo '<input type="email" name="email" value="' . $email . '">';

// Show specific error messages
if (isset($errors['email'])) {
    echo '<div class="error">' . implode('<br>', $errors['email']) . '</div>';
}
```

## Tugas
1. Buat form pendaftaran dengan validasi lengkap
2. Implementasikan form upload file dengan validasi
3. Buat sistem feedback dengan rating dan komentar
4. Buat form multi-step dengan session management

---
**Pertemuan Sebelumnya**: Array & Manipulasinya
**Pertemuan Selanjutnya**: Dasar Pemrograman Berbasis File
