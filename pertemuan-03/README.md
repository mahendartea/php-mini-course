# Pertemuan 3: Operator dan Tipe Data

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami berbagai tipe data dalam PHP
- Menggunakan operator aritmatika, perbandingan, dan logika
- Melakukan konversi tipe data
- Memahami operator assignment dan increment/decrement
- Menggunakan operator string dan array

## Materi Teori

### 1. Tipe Data dalam PHP

#### 1.1 Scalar Types (Tipe Data Skalar)

##### String
```php
$nama = "Budi Santoso";
$alamat = 'Jakarta Selatan';
$pesan = "Dia berkata: \"Halo!\"";
```

##### Integer
```php
$umur = 25;
$tahun = 2024;
$negatif = -10;
$oktal = 0755;      // Oktal
$hex = 0xFF;        // Hexadecimal
$binary = 0b1010;   // Binary (PHP 5.4+)
```

##### Float (Double)
```php
$tinggi = 175.5;
$berat = 70.25;
$saldo = 1500000.50;
$scientific = 1.23e4; // 12300
```

##### Boolean
```php
$aktif = true;
$lulus = false;
$is_valid = (10 > 5); // true
```

#### 1.2 Compound Types (Tipe Data Kompleks)

##### Array
```php
$buah = ["apel", "jeruk", "pisang"];
$siswa = [
    "nama" => "Budi",
    "umur" => 20,
    "kelas" => "XII"
];
```

##### Object
```php
class Mahasiswa {
    public $nama;
    public $nim;
}
$mhs = new Mahasiswa();
```

#### 1.3 Special Types

##### NULL
```php
$kosong = null;
$data = NULL;
```

##### Resource
```php
$file = fopen("data.txt", "r");
```

### 2. Operator Aritmatika

| Operator | Nama | Contoh | Hasil |
|----------|------|--------|-------|
| + | Penambahan | `$a + $b` | Jumlah $a dan $b |
| - | Pengurangan | `$a - $b` | Selisih $a dan $b |
| * | Perkalian | `$a * $b` | Hasil kali $a dan $b |
| / | Pembagian | `$a / $b` | Hasil bagi $a dan $b |
| % | Modulus | `$a % $b` | Sisa bagi $a dan $b |
| ** | Eksponensial | `$a ** $b` | $a pangkat $b (PHP 5.6+) |

### 3. Operator Assignment

| Operator | Contoh | Setara dengan |
|----------|--------|---------------|
| = | `$a = 5` | Assignment biasa |
| += | `$a += 3` | `$a = $a + 3` |
| -= | `$a -= 2` | `$a = $a - 2` |
| *= | `$a *= 4` | `$a = $a * 4` |
| /= | `$a /= 2` | `$a = $a / 2` |
| %= | `$a %= 3` | `$a = $a % 3` |
| .= | `$a .= "text"` | `$a = $a . "text"` |

### 4. Operator Increment/Decrement

| Operator | Nama | Penjelasan |
|----------|------|------------|
| ++$a | Pre-increment | Tambah $a dengan 1, kemudian return $a |
| $a++ | Post-increment | Return $a, kemudian tambah $a dengan 1 |
| --$a | Pre-decrement | Kurangi $a dengan 1, kemudian return $a |
| $a-- | Post-decrement | Return $a, kemudian kurangi $a dengan 1 |

### 5. Operator Perbandingan

| Operator | Nama | Contoh | Hasil |
|----------|------|--------|-------|
| == | Equal | `$a == $b` | true jika $a sama dengan $b |
| === | Identical | `$a === $b` | true jika $a sama dengan $b dan tipe sama |
| != | Not equal | `$a != $b` | true jika $a tidak sama dengan $b |
| <> | Not equal | `$a <> $b` | true jika $a tidak sama dengan $b |
| !== | Not identical | `$a !== $b` | true jika $a tidak sama atau tipe berbeda |
| < | Less than | `$a < $b` | true jika $a kurang dari $b |
| > | Greater than | `$a > $b` | true jika $a lebih dari $b |
| <= | Less than or equal | `$a <= $b` | true jika $a kurang dari atau sama dengan $b |
| >= | Greater than or equal | `$a >= $b` | true jika $a lebih dari atau sama dengan $b |
| <=> | Spaceship (PHP 7+) | `$a <=> $b` | -1, 0, atau 1 |

### 6. Operator Logika

| Operator | Nama | Contoh | Hasil |
|----------|------|--------|-------|
| && | And | `$a && $b` | true jika $a dan $b keduanya true |
| \|\| | Or | `$a \|\| $b` | true jika $a atau $b true |
| ! | Not | `!$a` | true jika $a false |
| and | And | `$a and $b` | sama dengan && tapi prioritas rendah |
| or | Or | `$a or $b` | sama dengan \|\| tapi prioritas rendah |
| xor | Xor | `$a xor $b` | true jika salah satu true, tapi tidak keduanya |

### 7. Operator String

| Operator | Nama | Contoh | Hasil |
|----------|------|--------|-------|
| . | Concatenation | `$a . $b` | Gabungan string $a dan $b |
| .= | Concatenation assignment | `$a .= $b` | `$a = $a . $b` |

### 8. Operator Array

| Operator | Nama | Contoh | Hasil |
|----------|------|--------|-------|
| + | Union | `$a + $b` | Gabungan array $a dan $b |
| == | Equality | `$a == $b` | true jika $a dan $b memiliki key-value yang sama |
| === | Identity | `$a === $b` | true jika $a dan $b identik |
| != | Inequality | `$a != $b` | true jika $a tidak sama dengan $b |
| <> | Inequality | `$a <> $b` | true jika $a tidak sama dengan $b |
| !== | Non-identity | `$a !== $b` | true jika $a tidak identik dengan $b |

### 9. Konversi Tipe Data (Type Casting)

```php
// Explicit casting
$angka = (int) "123";
$string = (string) 456;
$float = (float) "12.34";
$bool = (bool) 1;
$array = (array) "hello";

// Implicit conversion
$hasil = "10" + 5; // 15 (string "10" dikonversi ke int)
```

### 10. Precedence (Urutan Prioritas Operator)

1. `()` - Parentheses
2. `**` - Exponentiation
3. `++`, `--` - Increment/Decrement
4. `*`, `/`, `%` - Multiplication, Division, Modulus
5. `+`, `-` - Addition, Subtraction
6. `.` - String concatenation
7. `<`, `<=`, `>`, `>=` - Comparison
8. `==`, `!=`, `===`, `!==` - Equality
9. `&&` - Logical AND
10. `||` - Logical OR

## Praktikum

### Latihan 1: Kalkulator Sederhana
File: `kalkulator.php`

### Latihan 2: Demo Operator
File: `operator-demo.php`

### Latihan 3: Konversi Tipe Data
File: `type-conversion.php`

## Best Practices
1. Gunakan operator === untuk perbandingan yang strict
2. Hati-hati dengan konversi otomatis tipe data
3. Gunakan parentheses untuk memperjelas urutan operasi
4. Gunakan operator yang sesuai dengan konteks

## Tugas
1. Buat kalkulator yang dapat melakukan operasi +, -, *, /, %
2. Buat program untuk menghitung BMI dengan validasi input
3. Buat program untuk mengkonversi suhu (Celsius, Fahrenheit, Kelvin)

---
**Pertemuan Sebelumnya**: Sintaks Dasar & Variabel
**Pertemuan Selanjutnya**: Percabangan (If/Else/Switch)
