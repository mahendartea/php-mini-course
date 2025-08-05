# Pertemuan 7: Array & Manipulasinya

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami konsep dan jenis-jenis array dalam PHP
- Membuat dan memanipulasi array indexed dan associative
- Menggunakan fungsi-fungsi built-in PHP untuk array
- Bekerja dengan multidimensional array
- Memahami cara iterasi array dengan berbagai metode

## Materi Teori

### 1. Konsep Array
Array adalah struktur data yang dapat menyimpan multiple nilai dalam satu variabel. PHP mendukung tiga jenis array:
- **Indexed Array**: menggunakan index numerik
- **Associative Array**: menggunakan key berupa string
- **Multidimensional Array**: array yang berisi array lain

### 2. Indexed Array

#### Membuat Indexed Array
```php
// Method 1: array() function
$buah = array("apel", "jeruk", "pisang");

// Method 2: Short syntax (PHP 5.4+)
$buah = ["apel", "jeruk", "pisang"];

// Method 3: Manual assignment
$buah[0] = "apel";
$buah[1] = "jeruk";
$buah[2] = "pisang";
```

#### Mengakses Elemen
```php
echo $buah[0]; // Output: apel
echo $buah[1]; // Output: jeruk
```

#### Menambah Elemen
```php
$buah[] = "mangga";        // Tambah di akhir
$buah[10] = "durian";      // Tambah di index tertentu
array_push($buah, "rambutan"); // Tambah di akhir
```

### 3. Associative Array

#### Membuat Associative Array
```php
// Method 1
$siswa = array(
    "nama" => "Budi",
    "umur" => 20,
    "kelas" => "XII"
);

// Method 2: Short syntax
$siswa = [
    "nama" => "Budi",
    "umur" => 20,
    "kelas" => "XII"
];
```

#### Mengakses Elemen
```php
echo $siswa["nama"];  // Output: Budi
echo $siswa["umur"];  // Output: 20
```

#### Menambah/Mengubah Elemen
```php
$siswa["alamat"] = "Jakarta";    // Tambah key baru
$siswa["umur"] = 21;             // Ubah value existing key
```

### 4. Multidimensional Array

#### Array 2 Dimensi
```php
$kelas = [
    ["nama" => "Budi", "nilai" => 85],
    ["nama" => "Siti", "nilai" => 92],
    ["nama" => "Ahmad", "nilai" => 78]
];

// Akses elemen
echo $kelas[0]["nama"];   // Budi
echo $kelas[1]["nilai"];  // 92
```

#### Array 3 Dimensi
```php
$sekolah = [
    "kelas_10" => [
        "A" => ["Budi", "Siti", "Ahmad"],
        "B" => ["Rina", "Doni", "Maya"]
    ],
    "kelas_11" => [
        "A" => ["Lisa", "Andi", "Dewi"],
        "B" => ["Rizki", "Nita", "Arif"]
    ]
];

echo $sekolah["kelas_10"]["A"][0]; // Budi
```

### 5. Iterasi Array

#### Foreach untuk Indexed Array
```php
$buah = ["apel", "jeruk", "pisang"];

foreach ($buah as $item) {
    echo "$item<br>";
}
```

#### Foreach untuk Associative Array
```php
$siswa = ["nama" => "Budi", "umur" => 20];

foreach ($siswa as $key => $value) {
    echo "$key: $value<br>";
}
```

#### For Loop (hanya untuk indexed)
```php
$buah = ["apel", "jeruk", "pisang"];

for ($i = 0; $i < count($buah); $i++) {
    echo $buah[$i] . "<br>";
}
```

#### While dengan each() (deprecated PHP 7.2+)
```php
// ❌ Deprecated
while (list($key, $value) = each($array)) {
    echo "$key: $value<br>";
}

// ✅ Alternative modern
foreach ($array as $key => $value) {
    echo "$key: $value<br>";
}
```

### 6. Fungsi Array Built-in

#### Informasi Array
```php
count($array)           // Jumlah elemen
sizeof($array)          // Alias dari count()
is_array($var)          // Cek apakah variabel adalah array
empty($array)           // Cek apakah array kosong
isset($array[$key])     // Cek apakah key ada
```

#### Menambah/Menghapus Elemen
```php
array_push($array, $value)      // Tambah di akhir
array_unshift($array, $value)   // Tambah di awal
array_pop($array)               // Hapus dari akhir
array_shift($array)             // Hapus dari awal
unset($array[$key])             // Hapus elemen tertentu
```

#### Pencarian
```php
in_array($value, $array)        // Cek nilai ada dalam array
array_search($value, $array)    // Cari index/key dari value
array_key_exists($key, $array)  // Cek key ada dalam array
array_keys($array)              // Ambil semua key
array_values($array)            // Ambil semua value
```

#### Sorting
```php
sort($array)            // Sort ascending (indexed)
rsort($array)           // Sort descending (indexed)
asort($array)           // Sort ascending (preserve keys)
arsort($array)          // Sort descending (preserve keys)
ksort($array)           // Sort by key ascending
krsort($array)          // Sort by key descending
usort($array, $callback) // Custom sort dengan callback
```

#### Filter dan Transform
```php
array_filter($array, $callback)     // Filter elemen
array_map($callback, $array)        // Transform setiap elemen
array_reduce($array, $callback)     // Reduce ke satu nilai
array_walk($array, $callback)       // Jalankan fungsi untuk setiap elemen
```

#### Merge dan Split
```php
array_merge($array1, $array2)       // Gabung array
array_merge_recursive($arr1, $arr2) // Gabung recursive
array_slice($array, $offset, $length) // Ambil bagian array
array_chunk($array, $size)          // Split array jadi chunks
explode($delimiter, $string)        // String to array
implode($delimiter, $array)         // Array to string
```

### 7. Array Functions Lanjutan

#### array_map()
```php
$angka = [1, 2, 3, 4, 5];
$kuadrat = array_map(function($x) { return $x * $x; }, $angka);
// [1, 4, 9, 16, 25]
```

#### array_filter()
```php
$angka = [1, 2, 3, 4, 5, 6];
$genap = array_filter($angka, function($x) { return $x % 2 == 0; });
// [2, 4, 6]
```

#### array_reduce()
```php
$angka = [1, 2, 3, 4, 5];
$jumlah = array_reduce($angka, function($carry, $item) {
    return $carry + $item;
}, 0);
// 15
```

#### array_walk()
```php
$data = ["nama" => "budi", "kota" => "jakarta"];
array_walk($data, function(&$value, $key) {
    $value = ucfirst($value);
});
// ["nama" => "Budi", "kota" => "Jakarta"]
```

### 8. Array Destructuring (PHP 7.1+)

#### List Assignment
```php
$data = ["Budi", 20, "Jakarta"];

// PHP 5.x
list($nama, $umur, $kota) = $data;

// PHP 7.1+
[$nama, $umur, $kota] = $data;
```

#### Associative Array Destructuring
```php
$person = ["name" => "Budi", "age" => 20];

// PHP 7.1+
["name" => $nama, "age" => $umur] = $person;
```

### 9. Array Operators

#### Union (+)
```php
$array1 = ["a", "b", "c"];
$array2 = ["d", "e", "f"];
$result = $array1 + $array2; // ["a", "b", "c"]
```

#### Comparison
```php
$a = ["a" => 1, "b" => 2];
$b = ["b" => 2, "a" => 1];

$a == $b;  // true (same key-value pairs)
$a === $b; // false (different order)
```

### 10. Best Practices

#### 1. Gunakan foreach untuk iterasi
```php
// ✅ Recommended
foreach ($array as $item) {
    echo $item;
}

// ❌ Avoid (less efficient)
for ($i = 0; $i < count($array); $i++) {
    echo $array[$i];
}
```

#### 2. Check array existence
```php
// ✅ Safe
if (isset($array[$key])) {
    echo $array[$key];
}

// ✅ Alternative (PHP 7+)
echo $array[$key] ?? 'default';
```

#### 3. Use appropriate array functions
```php
// ✅ Use built-in functions
$filtered = array_filter($data, $callback);

// ❌ Manual loop (more code)
$filtered = [];
foreach ($data as $item) {
    if ($callback($item)) {
        $filtered[] = $item;
    }
}
```

## Praktikum

### Latihan 1: Daftar Nama dengan Foreach
File: `daftar-nama.php`

### Latihan 2: Array Processor
File: `array-processor.php`

### Latihan 3: Student Management
File: `student-management.php`

### Latihan 4: Shopping Cart
File: `shopping-cart.php`

## Contoh Aplikasi Nyata

### 1. Form Processing
```php
function processForm($data) {
    $errors = [];
    $required = ['name', 'email', 'phone'];

    foreach ($required as $field) {
        if (empty($data[$field])) {
            $errors[] = "$field is required";
        }
    }

    return $errors;
}
```

### 2. Menu Builder
```php
function buildMenu($items) {
    $html = '<ul>';
    foreach ($items as $item) {
        $html .= '<li>';
        $html .= '<a href="' . $item['url'] . '">' . $item['title'] . '</a>';
        if (isset($item['children'])) {
            $html .= buildMenu($item['children']); // Recursive
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
```

### 3. Data Transformation
```php
function transformStudents($students) {
    return array_map(function($student) {
        return [
            'id' => $student['student_id'],
            'name' => ucwords($student['full_name']),
            'grade' => calculateGrade($student['score']),
            'status' => $student['score'] >= 70 ? 'Pass' : 'Fail'
        ];
    }, $students);
}
```

## Tugas
1. Buat sistem manajemen inventori dengan array multidimensi
2. Implementasikan sorting dan filtering untuk data siswa
3. Buat shopping cart dengan fungsi tambah, hapus, dan update
4. Buat sistem statistik dari array data numerik

---
**Pertemuan Sebelumnya**: Fungsi (Function)
**Pertemuan Selanjutnya**: Form Input & Validasi Dasar
