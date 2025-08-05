# Pertemuan 6: Fungsi (Function)

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami konsep dan kegunaan fungsi dalam pemrograman
- Membuat dan memanggil fungsi dengan benar
- Menggunakan parameter dan return value
- Memahami scope variabel (global vs local)
- Menggunakan fungsi built-in PHP yang umum

## Materi Teori

### 1. Konsep Fungsi
Fungsi adalah blok kode yang dapat dipanggil berulang kali untuk melakukan tugas tertentu. Fungsi membantu:
- **Modularitas**: Memecah program menjadi bagian-bagian kecil
- **Reusability**: Kode dapat digunakan berulang kali
- **Maintainability**: Mudah untuk dipelihara dan diubah
- **Readability**: Kode lebih mudah dibaca dan dipahami

### 2. Sintaks Dasar Fungsi

#### Deklarasi Fungsi
```php
function namaFungsi() {
    // kode yang akan dijalankan
}
```

#### Memanggil Fungsi
```php
namaFungsi(); // memanggil fungsi
```

#### Contoh Sederhana
```php
function sapa() {
    echo "Halo, selamat datang!";
}

sapa(); // Output: Halo, selamat datang!
```

### 3. Parameter dan Argument

#### Fungsi dengan Parameter
```php
function sapa($nama) {
    echo "Halo, $nama!";
}

sapa("Budi"); // Output: Halo, Budi!
```

#### Multiple Parameter
```php
function perkenalan($nama, $umur, $kota) {
    echo "Nama saya $nama, umur $umur tahun, dari $kota";
}

perkenalan("Siti", 20, "Jakarta");
```

#### Default Parameter Value
```php
function salam($nama, $waktu = "pagi") {
    echo "Selamat $waktu, $nama!";
}

salam("Ahmad");           // Selamat pagi, Ahmad!
salam("Ahmad", "malam");  // Selamat malam, Ahmad!
```

#### Parameter dengan Type Hint (PHP 7+)
```php
function tambah(int $a, int $b): int {
    return $a + $b;
}

function cetakArray(array $data): void {
    foreach ($data as $item) {
        echo "$item ";
    }
}
```

### 4. Return Value

#### Return Sederhana
```php
function kuadrat($angka) {
    return $angka * $angka;
}

$hasil = kuadrat(5); // $hasil = 25
echo $hasil;
```

#### Return Multiple Values
```php
function hitungLingkaran($radius) {
    $luas = 3.14 * $radius * $radius;
    $keliling = 2 * 3.14 * $radius;

    return [$luas, $keliling]; // return array
}

list($luas, $keliling) = hitungLingkaran(7);
// atau
[$luas, $keliling] = hitungLingkaran(7); // PHP 7.1+
```

#### Return Associative Array
```php
function dataMahasiswa($nama, $nim) {
    return [
        'nama' => $nama,
        'nim' => $nim,
        'status' => 'aktif',
        'tanggal_daftar' => date('Y-m-d')
    ];
}

$mahasiswa = dataMahasiswa("Rina", "123456");
echo $mahasiswa['nama']; // Rina
```

### 5. Scope Variabel

#### Local Scope
```php
function testLocal() {
    $x = 10; // variabel lokal
    echo $x;
}

testLocal(); // Output: 10
// echo $x; // Error: variabel tidak terdefinisi
```

#### Global Scope
```php
$y = 20; // variabel global

function testGlobal() {
    global $y; // akses variabel global
    echo $y;
}

testGlobal(); // Output: 20
```

#### Static Variables
```php
function counter() {
    static $count = 0; // static variable
    $count++;
    echo "Count: $count<br>";
}

counter(); // Count: 1
counter(); // Count: 2
counter(); // Count: 3
```

### 6. Variable Functions

#### Function Variables
```php
function halo() {
    echo "Halo!";
}

$func = "halo";
$func(); // Output: Halo!
```

#### Anonymous Functions (Closures)
```php
$tambah = function($a, $b) {
    return $a + $b;
};

echo $tambah(5, 3); // Output: 8
```

#### Arrow Functions (PHP 7.4+)
```php
$kali = fn($a, $b) => $a * $b;
echo $kali(4, 5); // Output: 20
```

### 7. Fungsi Built-in PHP yang Umum

#### String Functions
```php
strlen($string)        // panjang string
strtoupper($string)    // uppercase
strtolower($string)    // lowercase
substr($string, $start, $length) // substring
str_replace($search, $replace, $string) // replace
explode($delimiter, $string) // split string
implode($delimiter, $array)  // join array
```

#### Array Functions
```php
count($array)          // jumlah elemen
array_push($array, $value) // tambah elemen
array_pop($array)      // hapus elemen terakhir
array_merge($array1, $array2) // gabung array
in_array($value, $array) // cek nilai dalam array
array_keys($array)     // ambil semua key
array_values($array)   // ambil semua value
```

#### Math Functions
```php
abs($number)           // nilai absolut
ceil($number)          // pembulatan ke atas
floor($number)         // pembulatan ke bawah
round($number, $precision) // pembulatan
max($array)            // nilai maksimum
min($array)            // nilai minimum
rand($min, $max)       // random number
```

#### Date/Time Functions
```php
date($format)          // format tanggal
time()                 // timestamp sekarang
strtotime($string)     // convert string ke timestamp
mktime($hour, $minute, $second, $month, $day, $year)
```

### 8. Best Practices

#### 1. Penamaan Fungsi
```php
// ✅ Gunakan nama yang deskriptif
function hitungLuasSegitiga($alas, $tinggi) {
    return 0.5 * $alas * $tinggi;
}

// ❌ Nama tidak jelas
function hitung($a, $b) {
    return 0.5 * $a * $b;
}
```

#### 2. Single Responsibility
```php
// ✅ Satu fungsi satu tugas
function validasiEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function simpanUser($data) {
    // logic penyimpanan
}

// ❌ Fungsi terlalu banyak tugas
function prosesUser($email, $data) {
    // validasi email
    // simpan data
    // kirim email
    // log activity
}
```

#### 3. Parameter Validation
```php
function bagi($a, $b) {
    if ($b == 0) {
        throw new InvalidArgumentException("Pembagi tidak boleh nol");
    }
    return $a / $b;
}
```

### 9. Recursive Functions

#### Contoh Faktorial
```php
function faktorial($n) {
    if ($n <= 1) {
        return 1;
    }
    return $n * faktorial($n - 1);
}

echo faktorial(5); // Output: 120
```

#### Contoh Fibonacci
```php
function fibonacci($n) {
    if ($n <= 1) {
        return $n;
    }
    return fibonacci($n - 1) + fibonacci($n - 2);
}
```

### 10. Higher Order Functions

#### Function sebagai Parameter
```php
function operasi($a, $b, $callback) {
    return $callback($a, $b);
}

$tambah = function($x, $y) { return $x + $y; };
$kali = function($x, $y) { return $x * $y; };

echo operasi(5, 3, $tambah); // 8
echo operasi(5, 3, $kali);   // 15
```

#### Array Functions dengan Callback
```php
$angka = [1, 2, 3, 4, 5];

// array_map - transform setiap elemen
$kuadrat = array_map(function($x) { return $x * $x; }, $angka);
// [1, 4, 9, 16, 25]

// array_filter - filter elemen
$genap = array_filter($angka, function($x) { return $x % 2 == 0; });
// [2, 4]

// array_reduce - reduce ke satu nilai
$jumlah = array_reduce($angka, function($carry, $item) {
    return $carry + $item;
}, 0);
// 15
```

## Praktikum

### Latihan 1: Kalkulator dengan Fungsi
File: `kalkulator-fungsi.php`

### Latihan 2: Utility Functions
File: `utility-functions.php`

### Latihan 3: Math Library
File: `math-library.php`

### Latihan 4: String Processor
File: `string-processor.php`

## Contoh Aplikasi Nyata

### 1. Validation Library
```php
function validateRequired($value, $fieldName) {
    if (empty($value)) {
        return "$fieldName wajib diisi";
    }
    return true;
}

function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Format email tidak valid";
    }
    return true;
}

function validateLength($value, $min, $max, $fieldName) {
    $length = strlen($value);
    if ($length < $min || $length > $max) {
        return "$fieldName harus antara $min-$max karakter";
    }
    return true;
}
```

### 2. Database Helper
```php
function connectDB() {
    $host = 'localhost';
    $dbname = 'myapp';
    $username = 'user';
    $password = 'pass';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function getUser($id) {
    $db = connectDB();
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}
```

### 3. Template Engine Sederhana
```php
function loadTemplate($template, $data = []) {
    extract($data); // extract array ke variabel

    ob_start();
    include "templates/$template.php";
    return ob_get_clean();
}

function renderPage($title, $content, $data = []) {
    $data['title'] = $title;
    $data['content'] = $content;
    return loadTemplate('layout', $data);
}
```

## Tugas
1. Buat library fungsi matematika (trigonometri, geometri)
2. Buat sistem validasi form dengan berbagai fungsi validator
3. Buat fungsi untuk manipulasi tanggal dan waktu
4. Buat fungsi rekursif untuk traversal struktur data

---
**Pertemuan Sebelumnya**: Perulangan (Looping)
**Pertemuan Selanjutnya**: Array & Manipulasinya
