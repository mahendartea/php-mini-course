# Pertemuan 5: Perulangan (Looping)

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami konsep perulangan dalam pemrograman
- Menggunakan loop for, while, dan do-while
- Menggunakan foreach untuk array
- Memahami break dan continue dalam loop
- Menggunakan nested loop untuk kasus kompleks

## Materi Teori

### 1. Konsep Perulangan
Perulangan (loop) adalah struktur kontrol yang memungkinkan eksekusi berulang dari blok kode selama kondisi tertentu terpenuhi. Ini sangat berguna untuk mengotomatisasi tugas yang repetitif.

### 2. For Loop

#### Sintaks Dasar
```php
for (inisialisasi; kondisi; increment/decrement) {
    // kode yang diulang
}
```

#### Contoh
```php
for ($i = 1; $i <= 10; $i++) {
    echo "Angka: $i<br>";
}
```

#### Variasi For Loop
```php
// Multiple variables
for ($i = 0, $j = 10; $i < $j; $i++, $j--) {
    echo "$i - $j<br>";
}

// Decrement
for ($i = 10; $i >= 1; $i--) {
    echo "$i ";
}

// Step by 2
for ($i = 0; $i <= 20; $i += 2) {
    echo "$i ";
}
```

### 3. While Loop

#### Sintaks Dasar
```php
while (kondisi) {
    // kode yang diulang
}
```

#### Contoh
```php
$i = 1;
while ($i <= 10) {
    echo "Angka: $i<br>";
    $i++;
}
```

#### Infinite Loop (Hati-hati!)
```php
// ❌ Infinite loop - hindari ini
while (true) {
    echo "Loop tak terbatas";
    // tidak ada cara untuk keluar
}
```

### 4. Do-While Loop

#### Sintaks Dasar
```php
do {
    // kode yang diulang
} while (kondisi);
```

#### Contoh
```php
$i = 1;
do {
    echo "Angka: $i<br>";
    $i++;
} while ($i <= 10);
```

#### Perbedaan dengan While
```php
// While: kondisi dicek dulu
$x = 10;
while ($x < 5) {
    echo "Tidak akan muncul";
}

// Do-While: kode dijalankan dulu, baru cek kondisi
$y = 10;
do {
    echo "Akan muncul sekali";
} while ($y < 5);
```

### 5. Foreach Loop

#### Untuk Array Indexed
```php
$buah = ["apel", "jeruk", "pisang"];

foreach ($buah as $item) {
    echo "$item<br>";
}
```

#### Untuk Array Associative
```php
$siswa = [
    "nama" => "Budi",
    "umur" => 20,
    "kelas" => "XII"
];

foreach ($siswa as $key => $value) {
    echo "$key: $value<br>";
}
```

#### Foreach dengan Reference
```php
$angka = [1, 2, 3, 4, 5];

// Mengubah nilai original
foreach ($angka as &$value) {
    $value *= 2;
}
// $angka sekarang [2, 4, 6, 8, 10]
```

### 6. Break dan Continue

#### Break - Keluar dari Loop
```php
for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        break; // keluar dari loop saat $i = 5
    }
    echo "$i ";
}
// Output: 1 2 3 4
```

#### Continue - Skip Iterasi
```php
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        continue; // skip angka genap
    }
    echo "$i ";
}
// Output: 1 3 5 7 9
```

#### Break dan Continue dengan Level
```php
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= 3; $j++) {
        if ($j == 2) {
            break 2; // keluar dari 2 level loop
        }
        echo "$i-$j ";
    }
}
```

### 7. Nested Loop

#### Loop dalam Loop
```php
// Tabel perkalian
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {
        echo ($i * $j) . "\t";
    }
    echo "<br>";
}
```

#### Pattern dengan Nested Loop
```php
// Segitiga bintang
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}
```

### 8. Alternative Syntax

#### For Alternative
```php
for ($i = 1; $i <= 10; $i++):
    echo "$i ";
endfor;
```

#### While Alternative
```php
$i = 1;
while ($i <= 10):
    echo "$i ";
    $i++;
endwhile;
```

#### Foreach Alternative
```php
foreach ($array as $item):
    echo "$item<br>";
endforeach;
```

### 9. Loop Performance Tips

#### 1. Simpan Array Length
```php
// ❌ Tidak efisien
for ($i = 0; $i < count($array); $i++) {
    // count() dipanggil setiap iterasi
}

// ✅ Lebih efisien
$length = count($array);
for ($i = 0; $i < $length; $i++) {
    // count() hanya dipanggil sekali
}
```

#### 2. Gunakan Foreach untuk Array
```php
// ❌ Kurang efisien
for ($i = 0; $i < count($array); $i++) {
    echo $array[$i];
}

// ✅ Lebih efisien
foreach ($array as $item) {
    echo $item;
}
```

### 10. Common Loop Patterns

#### 1. Akumulasi
```php
$total = 0;
for ($i = 1; $i <= 100; $i++) {
    $total += $i;
}
echo "Total: $total";
```

#### 2. Pencarian
```php
$found = false;
foreach ($array as $item) {
    if ($item == $target) {
        $found = true;
        break;
    }
}
```

#### 3. Filtering
```php
$genap = [];
for ($i = 1; $i <= 20; $i++) {
    if ($i % 2 == 0) {
        $genap[] = $i;
    }
}
```

#### 4. Transformasi
```php
$kuadrat = [];
foreach ($angka as $num) {
    $kuadrat[] = $num * $num;
}
```

## Praktikum

### Latihan 1: Tabel Perkalian
File: `tabel-perkalian.php`

### Latihan 2: Pattern Generator
File: `pattern-generator.php`

### Latihan 3: Number Games
File: `number-games.php`

### Latihan 4: Array Processor
File: `array-processor.php`

## Contoh Aplikasi Nyata

### 1. Pagination
```php
$total_data = 100;
$per_page = 10;
$total_pages = ceil($total_data / $per_page);

for ($page = 1; $page <= $total_pages; $page++) {
    $active = ($page == $current_page) ? "active" : "";
    echo "<a href='?page=$page' class='$active'>$page</a> ";
}
```

### 2. Form Validation
```php
$errors = [];
foreach ($_POST as $field => $value) {
    if (empty($value)) {
        $errors[] = "$field is required";
    }
}
```

### 3. Menu Generation
```php
$menu = [
    "home" => "Home",
    "about" => "About Us",
    "contact" => "Contact"
];

foreach ($menu as $url => $title) {
    echo "<a href='$url.php'>$title</a>";
}
```

## Best Practices

1. **Hindari Infinite Loop**: Selalu pastikan ada kondisi yang akan menghentikan loop
2. **Gunakan Loop yang Tepat**: For untuk iterasi terhitung, foreach untuk array
3. **Optimasi Performance**: Hindari operasi berat dalam loop
4. **Readable Code**: Gunakan nama variabel yang jelas
5. **Break Early**: Gunakan break jika kondisi sudah terpenuhi

## Tugas
1. Buat program untuk menampilkan bilangan prima 1-100
2. Buat kalkulator faktorial menggunakan loop
3. Buat generator tabel HTML dari array data
4. Buat program untuk mencari nilai maksimum dan minimum dalam array

---
**Pertemuan Sebelumnya**: Percabangan (If/Else/Switch)
**Pertemuan Selanjutnya**: Fungsi (Function)
