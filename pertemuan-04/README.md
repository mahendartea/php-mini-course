# Pertemuan 4: Percabangan (If/Else/Switch)

## Tujuan Pembelajaran
Setelah mengikuti pertemuan ini, peserta diharapkan dapat:
- Memahami konsep percabangan dalam pemrograman
- Menggunakan struktur if, else, dan elseif
- Menggunakan struktur switch-case
- Menggunakan operator ternary untuk kondisi sederhana
- Memahami nested conditions dan logical operators

## Materi Teori

### 1. Konsep Percabangan
Percabangan adalah struktur kontrol yang memungkinkan program untuk mengambil keputusan berdasarkan kondisi tertentu. Dengan percabangan, program dapat menjalankan blok kode yang berbeda tergantung pada kondisi yang dipenuhi.

### 2. Struktur If

#### If Sederhana
```php
if (kondisi) {
    // kode yang dijalankan jika kondisi true
}
```

#### If-Else
```php
if (kondisi) {
    // kode jika kondisi true
} else {
    // kode jika kondisi false
}
```

#### If-Elseif-Else
```php
if (kondisi1) {
    // kode jika kondisi1 true
} elseif (kondisi2) {
    // kode jika kondisi2 true
} elseif (kondisi3) {
    // kode jika kondisi3 true
} else {
    // kode jika semua kondisi false
}
```

### 3. Operator Perbandingan untuk Kondisi

| Operator | Keterangan | Contoh |
|----------|------------|--------|
| == | Sama dengan | `$a == $b` |
| === | Identik (sama nilai dan tipe) | `$a === $b` |
| != | Tidak sama dengan | `$a != $b` |
| !== | Tidak identik | `$a !== $b` |
| < | Kurang dari | `$a < $b` |
| > | Lebih dari | `$a > $b` |
| <= | Kurang dari atau sama dengan | `$a <= $b` |
| >= | Lebih dari atau sama dengan | `$a >= $b` |

### 4. Operator Logika

| Operator | Keterangan | Contoh |
|----------|------------|--------|
| && (AND) | True jika kedua kondisi true | `$a > 5 && $b < 10` |
| \|\| (OR) | True jika salah satu kondisi true | `$a == 1 \|\| $b == 2` |
| ! (NOT) | Membalik nilai boolean | `!$aktif` |
| and | Sama dengan && (prioritas rendah) | `$a > 5 and $b < 10` |
| or | Sama dengan \|\| (prioritas rendah) | `$a == 1 or $b == 2` |
| xor | True jika hanya satu kondisi true | `$a xor $b` |

### 5. Truthy dan Falsy Values

#### Falsy Values (dianggap false)
```php
false       // boolean false
0           // integer 0
0.0         // float 0
"0"         // string "0"
""          // string kosong
null        // null
[]          // array kosong
```

#### Truthy Values (dianggap true)
```php
true        // boolean true
1, -1, 100  // integer selain 0
1.5, -2.3   // float selain 0.0
"false"     // string non-kosong (kecuali "0")
[1, 2, 3]   // array berisi elemen
new stdClass() // object
```

### 6. Struktur Switch-Case

```php
switch ($variabel) {
    case 'nilai1':
        // kode untuk nilai1
        break;
    case 'nilai2':
        // kode untuk nilai2
        break;
    case 'nilai3':
    case 'nilai4':
        // kode untuk nilai3 atau nilai4
        break;
    default:
        // kode jika tidak ada case yang cocok
        break;
}
```

#### Fitur Switch (PHP 8+)
```php
$result = match($value) {
    1 => 'one',
    2 => 'two',
    3, 4 => 'three or four',
    default => 'other'
};
```

### 7. Operator Ternary

#### Ternary Sederhana
```php
$hasil = (kondisi) ? 'nilai_jika_true' : 'nilai_jika_false';
```

#### Ternary Bersarang
```php
$grade = ($nilai >= 90) ? 'A' :
         (($nilai >= 80) ? 'B' :
         (($nilai >= 70) ? 'C' : 'D'));
```

#### Null Coalescing (PHP 7+)
```php
$username = $_GET['user'] ?? 'guest';
$config = $user_config ?? $default_config ?? 'fallback';
```

### 8. Nested Conditions

```php
if ($umur >= 18) {
    if ($punya_sim) {
        if ($punya_mobil) {
            echo "Boleh menyetir";
        } else {
            echo "Perlu mobil";
        }
    } else {
        echo "Perlu SIM";
    }
} else {
    echo "Belum cukup umur";
}
```

### 9. Short-Circuit Evaluation

```php
// AND - jika kondisi pertama false, kondisi kedua tidak dievaluasi
if ($user && $user->isActive()) {
    // aman dari null error
}

// OR - jika kondisi pertama true, kondisi kedua tidak dievaluasi
if ($cache_exists || expensive_calculation()) {
    // expensive_calculation() tidak dipanggil jika cache ada
}
```

### 10. Best Practices

#### 1. Gunakan Kurung Kurawal
```php
// ❌ Tidak disarankan
if ($condition)
    echo "Hello";

// ✅ Disarankan
if ($condition) {
    echo "Hello";
}
```

#### 2. Hindari Nested yang Terlalu Dalam
```php
// ❌ Terlalu banyak nested
if ($a) {
    if ($b) {
        if ($c) {
            if ($d) {
                // kode
            }
        }
    }
}

// ✅ Gunakan early return
if (!$a) return;
if (!$b) return;
if (!$c) return;
if (!$d) return;
// kode
```

#### 3. Gunakan === untuk Perbandingan Strict
```php
// ❌ Loose comparison
if ($value == 0) { }

// ✅ Strict comparison
if ($value === 0) { }
```

## Praktikum

### Latihan 1: Sistem Penilaian
File: `cek-nilai.php`

### Latihan 2: Kalkulator Grade
File: `grade-calculator.php`

### Latihan 3: Validasi Login
File: `login-validator.php`

### Latihan 4: Sistem Diskon
File: `discount-system.php`

## Contoh Kasus Nyata

### 1. Validasi Form
```php
if (empty($nama)) {
    $error = "Nama wajib diisi";
} elseif (strlen($nama) < 2) {
    $error = "Nama minimal 2 karakter";
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
    $error = "Nama hanya boleh huruf dan spasi";
} else {
    $success = "Nama valid";
}
```

### 2. Sistem Autentikasi
```php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
} elseif ($_SESSION['role'] === 'admin') {
    include 'admin_dashboard.php';
} elseif ($_SESSION['role'] === 'user') {
    include 'user_dashboard.php';
} else {
    echo "Role tidak dikenali";
}
```

### 3. Penentuan Hari Kerja
```php
$hari = date('N'); // 1=Senin, 7=Minggu

switch ($hari) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo "Hari kerja";
        break;
    case 6:
    case 7:
        echo "Weekend";
        break;
}
```

## Tugas
1. Buat sistem penilaian dengan kategori A, B, C, D, E
2. Buat kalkulator BMI dengan kategori kesehatan
3. Buat sistem validasi password dengan multiple kriteria
4. Buat aplikasi penentuan tarif parkir berdasarkan jenis kendaraan dan durasi

---
**Pertemuan Sebelumnya**: Operator dan Tipe Data
**Pertemuan Selanjutnya**: Perulangan (Looping)
