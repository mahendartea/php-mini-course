<?php

/**
 * Pertemuan 10: Daftar Kontak
 * File: kontak-daftar.php
 *
 * Menampilkan semua kontak dengan fitur pencarian dan filter
 */

// Konfigurasi
define('DATA_FILE', 'data/kontak.json');

// Fungsi untuk memuat data kontak
function loadKontaks()
{
    if (file_exists(DATA_FILE)) {
        $json = file_get_contents(DATA_FILE);
        return json_decode($json, true) ?: [];
    }
    return [];
}

// Load data
$kontaks = loadKontaks();

// Filter dan pencarian
$search = $_GET['search'] ?? '';
$kategori_filter = $_GET['kategori'] ?? '';
$sort_by = $_GET['sort'] ?? 'nama';
$sort_order = $_GET['order'] ?? 'asc';

// Filter berdasarkan pencarian
if ($search) {
    $kontaks = array_filter($kontaks, function ($kontak) use ($search) {
        $search_lower = strtolower($search);
        return strpos(strtolower($kontak['nama']), $search_lower) !== false ||
            strpos(strtolower($kontak['email']), $search_lower) !== false ||
            strpos(strtolower($kontak['telepon']), $search_lower) !== false ||
            strpos(strtolower($kontak['alamat'] ?? ''), $search_lower) !== false;
    });
}

// Filter berdasarkan kategori
if ($kategori_filter) {
    $kontaks = array_filter($kontaks, function ($kontak) use ($kategori_filter) {
        return ($kontak['kategori'] ?? 'Lainnya') === $kategori_filter;
    });
}

// Sorting
usort($kontaks, function ($a, $b) use ($sort_by, $sort_order) {
    $value_a = $a[$sort_by] ?? '';
    $value_b = $b[$sort_by] ?? '';

    if ($sort_by === 'tanggal_dibuat' || $sort_by === 'tanggal_diubah') {
        $value_a = strtotime($value_a);
        $value_b = strtotime($value_b);
    }

    $result = strcasecmp($value_a, $value_b);
    return $sort_order === 'desc' ? -$result : $result;
});

// Dapatkan daftar kategori unik
$all_kontaks = loadKontaks();
$kategori_list = [];
foreach ($all_kontaks as $kontak) {
    $kategori = $kontak['kategori'] ?? 'Lainnya';
    if (!in_array($kategori, $kategori_list)) {
        $kategori_list[] = $kategori;
    }
}
sort($kategori_list);

// Pagination
$page = max(1, (int)($_GET['page'] ?? 1));
$per_page = 10;
$total_kontaks = count($kontaks);
$total_pages = ceil($total_kontaks / $per_page);
$offset = ($page - 1) * $per_page;
$kontaks_page = array_slice($kontaks, $offset, $per_page);

// Statistik
$total_semua = count($all_kontaks);
$total_filtered = count($kontaks);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kontak - Aplikasi Kontak</title>
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
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: #4CAF50;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            padding: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: #4CAF50;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .page-header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        .page-header p {
            color: #666;
            font-size: 1.1em;
        }

        .filters {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .filter-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group select {
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 14px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .stats-bar {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stats-info {
            color: #666;
        }

        .kontak-grid {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }

        .kontak-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-left: 5px solid #4CAF50;
        }

        .kontak-card:hover {
            transform: translateY(-5px);
        }

        .kontak-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .kontak-header h3 {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 5px;
        }

        .kontak-actions {
            display: flex;
            gap: 10px;
        }

        .kontak-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .kategori-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #4CAF50;
            color: white;
            border-radius: 15px;
            font-size: 0.8em;
            font-weight: 600;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #4CAF50;
            color: white;
        }

        .pagination .current {
            background: #4CAF50;
            color: white;
        }

        .empty-state {
            background: rgba(255, 255, 255, 0.95);
            padding: 60px;
            border-radius: 15px;
            text-align: center;
            color: #666;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .empty-state .icon {
            font-size: 4em;
            margin-bottom: 20px;
        }

        .sort-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .sort-links a {
            color: #666;
            text-decoration: none;
            font-size: 0.9em;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sort-links a:hover,
        .sort-links a.active {
            background: #4CAF50;
            color: white;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                justify-content: center;
                flex-wrap: wrap;
            }

            .filter-row {
                grid-template-columns: 1fr;
            }

            .stats-bar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .kontak-header {
                flex-direction: column;
                gap: 15px;
            }

            .kontak-actions {
                justify-content: center;
            }

            .kontak-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">📇 Kontak App</div>
            <ul class="nav-links">
                <li><a href="index.php">🏠 Dashboard</a></li>
                <li><a href="kontak-daftar.php" class="active">📋 Daftar Kontak</a></li>
                <li><a href="kontak-tambah.php">➕ Tambah Kontak</a></li>
                <li><a href="import-export.php">💾 Import/Export</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>📋 Daftar Kontak</h1>
            <p>Kelola dan cari kontak Anda dengan mudah</p>
        </div>

        <!-- Filters -->
        <div class="filters">
            <form method="GET" id="filterForm">
                <div class="filter-row">
                    <div class="form-group">
                        <label for="search">🔍 Cari Kontak</label>
                        <input type="text" id="search" name="search"
                            value="<?php echo htmlspecialchars($search); ?>"
                            placeholder="Nama, email, telepon, atau alamat...">
                    </div>

                    <div class="form-group">
                        <label for="kategori">🏷️ Kategori</label>
                        <select id="kategori" name="kategori">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <option value="<?php echo htmlspecialchars($kategori); ?>"
                                    <?php echo $kategori_filter === $kategori ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($kategori); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sort">📊 Urutkan</label>
                        <select id="sort" name="sort">
                            <option value="nama" <?php echo $sort_by === 'nama' ? 'selected' : ''; ?>>Nama</option>
                            <option value="email" <?php echo $sort_by === 'email' ? 'selected' : ''; ?>>Email</option>
                            <option value="kategori" <?php echo $sort_by === 'kategori' ? 'selected' : ''; ?>>Kategori</option>
                            <option value="tanggal_dibuat" <?php echo $sort_by === 'tanggal_dibuat' ? 'selected' : ''; ?>>Tanggal Dibuat</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        🔍 Filter
                    </button>
                </div>

                <input type="hidden" name="order" value="<?php echo htmlspecialchars($sort_order); ?>">
            </form>

            <div class="sort-links">
                <span>Urutan:</span>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['order' => 'asc'])); ?>"
                    class="<?php echo $sort_order === 'asc' ? 'active' : ''; ?>">
                    ↑ A-Z / Terlama
                </a>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['order' => 'desc'])); ?>"
                    class="<?php echo $sort_order === 'desc' ? 'active' : ''; ?>">
                    ↓ Z-A / Terbaru
                </a>
                <?php if ($search || $kategori_filter): ?>
                    <a href="kontak-daftar.php" style="color: #e74c3c;">
                        ✖️ Reset Filter
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stats-info">
                <?php if ($search || $kategori_filter): ?>
                    Menampilkan <strong><?php echo $total_filtered; ?></strong> dari
                    <strong><?php echo $total_semua; ?></strong> kontak
                <?php else: ?>
                    Total <strong><?php echo $total_semua; ?></strong> kontak
                <?php endif; ?>

                <?php if ($total_pages > 1): ?>
                    | Halaman <strong><?php echo $page; ?></strong> dari <strong><?php echo $total_pages; ?></strong>
                <?php endif; ?>
            </div>

            <div>
                <a href="kontak-tambah.php" class="btn btn-primary btn-small">
                    ➕ Tambah Kontak
                </a>
            </div>
        </div>

        <!-- Kontak List -->
        <?php if (empty($kontaks_page)): ?>
            <div class="empty-state">
                <?php if ($search || $kategori_filter): ?>
                    <div class="icon">🔍</div>
                    <h3>Tidak ada kontak yang ditemukan</h3>
                    <p>Coba ubah kata kunci pencarian atau filter kategori</p>
                    <br>
                    <a href="kontak-daftar.php" class="btn btn-secondary">Reset Pencarian</a>
                <?php else: ?>
                    <div class="icon">📭</div>
                    <h3>Belum ada kontak</h3>
                    <p>Mulai dengan menambahkan kontak pertama Anda</p>
                    <br>
                    <a href="kontak-tambah.php" class="btn btn-primary">➕ Tambah Kontak</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="kontak-grid">
                <?php foreach ($kontaks_page as $kontak): ?>
                    <div class="kontak-card">
                        <div class="kontak-header">
                            <div>
                                <h3><?php echo htmlspecialchars($kontak['nama']); ?></h3>
                                <span class="kategori-badge">
                                    <?php echo htmlspecialchars($kontak['kategori'] ?? 'Lainnya'); ?>
                                </span>
                            </div>
                            <div class="kontak-actions">
                                <a href="kontak-detail.php?id=<?php echo urlencode($kontak['id']); ?>"
                                    class="btn btn-secondary btn-small">
                                    👁️ Detail
                                </a>
                                <a href="kontak-edit.php?id=<?php echo urlencode($kontak['id']); ?>"
                                    class="btn btn-primary btn-small">
                                    ✏️ Edit
                                </a>
                            </div>
                        </div>

                        <div class="kontak-info">
                            <div class="info-item">
                                <span>📧</span>
                                <span><?php echo htmlspecialchars($kontak['email']); ?></span>
                            </div>
                            <div class="info-item">
                                <span>📱</span>
                                <span><?php echo htmlspecialchars($kontak['telepon']); ?></span>
                            </div>
                            <?php if (!empty($kontak['alamat'])): ?>
                                <div class="info-item">
                                    <span>📍</span>
                                    <span><?php echo htmlspecialchars(substr($kontak['alamat'], 0, 50)); ?>
                                        <?php echo strlen($kontak['alamat']) > 50 ? '...' : ''; ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="info-item">
                                <span>📅</span>
                                <span><?php echo date('d/m/Y H:i', strtotime($kontak['tanggal_dibuat'])); ?></span>
                            </div>
                        </div>

                        <?php if (!empty($kontak['catatan'])): ?>
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
                                <div class="info-item">
                                    <span>📝</span>
                                    <span style="color: #666; font-style: italic;">
                                        <?php echo htmlspecialchars(substr($kontak['catatan'], 0, 100)); ?>
                                        <?php echo strlen($kontak['catatan']) > 100 ? '...' : ''; ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>">
                        ← Sebelumnya
                    </a>
                <?php endif; ?>

                <?php
                $start_page = max(1, $page - 2);
                $end_page = min($total_pages, $page + 2);

                for ($i = $start_page; $i <= $end_page; $i++):
                ?>
                    <?php if ($i === $page): ?>
                        <span class="current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>">
                        Selanjutnya →
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Auto-submit form saat mengetik di search box
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(function() {
                document.getElementById('filterForm').submit();
            }, 500);
        });

        // Auto-submit saat mengubah kategori atau sort
        document.getElementById('kategori').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('sort').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        // Keyboard shortcut
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K untuk focus ke search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.getElementById('search').focus();
            }

            // Escape untuk clear search
            if (e.key === 'Escape') {
                document.getElementById('search').value = '';
                document.getElementById('kategori').value = '';
                document.getElementById('filterForm').submit();
            }
        });

        // Animasi masuk untuk cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.kontak-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>

</html>
