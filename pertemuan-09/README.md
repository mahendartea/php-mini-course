# Pertemuan 9: File Handling & Operasi File

## 🎯 Tujuan Pembelajaran
- Memahami cara membaca dan menulis file di PHP
- Mempelajari fungsi-fungsi file handling
- Implementasi upload file
- Keamanan dalam operasi file

---

## 📚 Teori: File Handling di PHP

### 1. Fungsi Dasar File
PHP menyediakan berbagai fungsi untuk operasi file:

#### Membaca File
```php
// Membaca seluruh file
$content = file_get_contents('file.txt');

// Membaca file baris per baris
$lines = file('file.txt');

// Menggunakan fopen dan fread
$handle = fopen('file.txt', 'r');
$content = fread($handle, filesize('file.txt'));
fclose($handle);
```

#### Menulis File
```php
// Menulis file (overwrite)
file_put_contents('file.txt', 'Konten baru');

// Menulis file (append)
file_put_contents('file.txt', 'Konten tambahan', FILE_APPEND);

// Menggunakan fopen dan fwrite
$handle = fopen('file.txt', 'w');
fwrite($handle, 'Konten file');
fclose($handle);
```

### 2. Mode File
| Mode | Deskripsi |
|------|-----------|
| `r` | Read only, pointer di awal file |
| `w` | Write only, truncate file atau buat baru |
| `a` | Write only, pointer di akhir file (append) |
| `r+` | Read/write, pointer di awal file |
| `w+` | Read/write, truncate file atau buat baru |
| `a+` | Read/write, pointer di akhir file |

### 3. Informasi File
```php
// Cek apakah file ada
if (file_exists('file.txt')) {
    echo "File ada";
}

// Informasi file
$size = filesize('file.txt');
$time = filemtime('file.txt');
$readable = is_readable('file.txt');
$writable = is_writable('file.txt');
```

### 4. Operasi Direktori
```php
// Buat direktori
mkdir('folder_baru');

// Hapus direktori (harus kosong)
rmdir('folder_baru');

// Scan direktori
$files = scandir('.');

// Direktori iterator
$iterator = new DirectoryIterator('.');
foreach ($iterator as $file) {
    if ($file->isFile()) {
        echo $file->getFilename();
    }
}
```

### 5. Upload File
```php
if (isset($_FILES['upload'])) {
    $upload = $_FILES['upload'];

    // Informasi file
    $name = $upload['name'];
    $tmp_name = $upload['tmp_name'];
    $size = $upload['size'];
    $type = $upload['type'];
    $error = $upload['error'];

    // Pindahkan file
    if ($error === 0) {
        move_uploaded_file($tmp_name, 'uploads/' . $name);
    }
}
```

### 6. Keamanan File
- **Path Traversal**: Hindari `../` dalam nama file
- **File Type Validation**: Periksa ekstensi dan MIME type
- **File Size Limit**: Batasi ukuran file
- **Sanitize Filename**: Bersihkan nama file dari karakter berbahaya

```php
function validateUpload($file) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if (!in_array($file['type'], $allowed_types)) {
        return 'File type tidak diizinkan';
    }

    if ($file['size'] > $max_size) {
        return 'File terlalu besar';
    }

    // Sanitize filename
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);

    return null; // Valid
}
```

---

## 💡 Best Practices

### 1. Error Handling
```php
$content = @file_get_contents('file.txt');
if ($content === false) {
    echo "Error membaca file";
}
```

### 2. Lock File
```php
$handle = fopen('file.txt', 'w');
if (flock($handle, LOCK_EX)) {
    fwrite($handle, 'Data penting');
    flock($handle, LOCK_UN);
}
fclose($handle);
```

### 3. Temporary Files
```php
$temp_file = tempnam(sys_get_temp_dir(), 'myapp_');
file_put_contents($temp_file, 'Data sementara');
// ... proses
unlink($temp_file); // Hapus file temporary
```

---

## 🔧 Contoh Praktis

### 1. Log System
```php
function writeLog($message) {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[$timestamp] $message" . PHP_EOL;
    file_put_contents('app.log', $log_entry, FILE_APPEND | LOCK_EX);
}
```

### 2. Configuration File
```php
// Simpan config
$config = [
    'database_host' => 'localhost',
    'database_name' => 'myapp',
    'debug' => true
];
file_put_contents('config.json', json_encode($config, JSON_PRETTY_PRINT));

// Baca config
$config = json_decode(file_get_contents('config.json'), true);
```

### 3. CSV Processing
```php
// Baca CSV
$csv_data = [];
if (($handle = fopen('data.csv', 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        $csv_data[] = $data;
    }
    fclose($handle);
}

// Tulis CSV
$data = [
    ['Nama', 'Umur', 'Kota'],
    ['John', '25', 'Jakarta'],
    ['Jane', '30', 'Surabaya']
];

$handle = fopen('output.csv', 'w');
foreach ($data as $row) {
    fputcsv($handle, $row);
}
fclose($handle);
```

---

## 🚨 Common Errors

1. **File not found**: Periksa path file
2. **Permission denied**: Periksa permission direktori
3. **Disk full**: Handle error saat menulis file
4. **Memory limit**: Untuk file besar, gunakan streaming

---

## 📝 Latihan

1. Buat sistem log sederhana
2. Implementasi upload gambar dengan validasi
3. Buat file manager sederhana
4. Proses file CSV untuk data mahasiswa

## 🎯 Yang Akan Dipelajari Selanjutnya
- **Pertemuan 10**: Mini Project - Aplikasi Kontak dengan File Storage
