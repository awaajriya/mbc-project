<?php
$title = "Cari Data - Admin MBC";
$page = "search";
require_once 'koneksi.php';

$searchQuery = trim($_GET['q'] ?? '');
$searchQueryEscaped = mysqli_real_escape_string($koneksi, $searchQuery);
$results = [];
include 'header.php';

if ($searchQuery !== '') {
    $searchTerms = array_values(array_filter(preg_split('/\s+/', strtolower($searchQuery)), function ($term) {
        return strlen($term) >= 3;
    }));

    $searchConditions = function(array $columns) use ($searchTerms, $koneksi) {
        $termGroups = [];
        foreach ($searchTerms as $term) {
            $termEscaped = mysqli_real_escape_string($koneksi, $term);
            $columnMatches = [];
            foreach ($columns as $column) {
                $columnMatches[] = "$column LIKE '%$termEscaped%'";
            }
            $termGroups[] = '(' . implode(' OR ', $columnMatches) . ')';
        }
        return implode(' AND ', $termGroups);
    };

    $queries = [
        'unit_bisnis' => "SELECT 'unit' AS type, id_unit AS id, nama_unit AS title, deskripsi AS extra, link AS link, '' AS status
            FROM unit_bisnis
            WHERE " . $searchConditions(['nama_unit', 'deskripsi', 'link']),
        'proyek_unggulan' => "SELECT 'project' AS type, id, judul AS title, CONCAT(sub_unit, ' ', deskripsi) AS extra, link AS link, bg_color AS status
            FROM proyek_unggulan
            WHERE " . $searchConditions(['judul', 'deskripsi', 'sub_unit', 'link']),
        'keunggulan' => "SELECT 'feature' AS type, id, judul AS title, deskripsi AS extra, '' AS link, aktif AS status
            FROM keunggulan
            WHERE " . $searchConditions(['judul', 'deskripsi']),
        'statistik' => "SELECT 'statistic' AS type, id, label AS title, angka AS extra, '' AS link, aktif AS status
            FROM statistik
            WHERE " . $searchConditions(['label']),
        'pesan' => "SELECT 'message' AS type, id, subject AS title, CONCAT(nama, ' - ', email) AS extra, '' AS link, is_read AS status
            FROM pesan
            WHERE " . $searchConditions(['nama', 'email', 'subject', 'pesan'])
    ];

    foreach ($queries as $table => $sql) {
        $result = mysqli_query($koneksi, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['table'] = $table;
                $results[] = $row;
            }
        }
    }

    $queryLower = strtolower($searchQuery);
    if (empty($results)) {
        if (preg_match('/\b(unit|unit bisnis|unitbisnis)\b/i', $queryLower)) {
            $result = mysqli_query($koneksi, "SELECT 'unit' AS type, id_unit AS id, nama_unit AS title, deskripsi AS extra, link AS link, '' AS status FROM unit_bisnis ORDER BY id_unit DESC");
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $row['table'] = 'unit_bisnis';
                    $results[] = $row;
                }
            }
        }
        if (preg_match('/\b(proyek|project|unggulan|keunggulan|statistik|pesan|message|contact)\b/i', $queryLower) && empty($results)) {
            if (preg_match('/\b(proyek|project)\b/i', $queryLower)) {
                $result = mysqli_query($koneksi, "SELECT 'project' AS type, id, judul AS title, CONCAT(sub_unit, ' ', deskripsi) AS extra, link AS link, bg_color AS status FROM proyek_unggulan ORDER BY id DESC");
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $row['table'] = 'proyek_unggulan';
                        $results[] = $row;
                    }
                }
            }
            if (preg_match('/\b(keunggulan|unggulan)\b/i', $queryLower) && empty($results)) {
                $result = mysqli_query($koneksi, "SELECT 'feature' AS type, id, judul AS title, deskripsi AS extra, '' AS link, aktif AS status FROM keunggulan ORDER BY posisi ASC, id DESC");
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $row['table'] = 'keunggulan';
                        $results[] = $row;
                    }
                }
            }
            if (preg_match('/\b(statistik)\b/i', $queryLower) && empty($results)) {
                $result = mysqli_query($koneksi, "SELECT 'statistic' AS type, id, label AS title, angka AS extra, '' AS link, aktif AS status FROM statistik ORDER BY posisi ASC, id DESC");
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $row['table'] = 'statistik';
                        $results[] = $row;
                    }
                }
            }
            if (preg_match('/\b(pesan|message|contact)\b/i', $queryLower) && empty($results)) {
                $result = mysqli_query($koneksi, "SELECT 'message' AS type, id, subject AS title, CONCAT(nama, ' - ', email) AS extra, '' AS link, is_read AS status FROM pesan ORDER BY created_at DESC");
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $row['table'] = 'pesan';
                        $results[] = $row;
                    }
                }
            }
        }
    }
}
?>

<div class="content-header">
    <h1>Pencarian Admin</h1>
    <p>Hasil pencarian untuk kata kunci: <strong><?= htmlspecialchars($searchQuery); ?></strong></p>
</div>

<div class="card-box">
    <div class="card-header">
        <h3>Hasil Pencarian</h3>
    </div>

    <?php if ($searchQuery === ''): ?>
        <p style="padding: 16px 0; color: var(--text-muted);">Masukkan kata kunci untuk mencari unit bisnis, proyek, keunggulan, statistik, atau pesan.</p>
    <?php elseif (empty($results)): ?>
        <p style="padding: 16px 0; color: var(--text-muted);">Tidak ditemukan data yang cocok dengan kata kunci tersebut.</p>
    <?php else: ?>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipe</th>
                    <th>Judul / Nama</th>
                    <th>Detail</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $index => $row): ?>
                    <?php
                        $typeLabel = '';
                        $url = '#';
                        switch ($row['type']) {
                            case 'unit':
                                $typeLabel = 'Unit Bisnis';
                                $url = 'units.php?edit=' . intval($row['id']);
                                break;
                            case 'project':
                                $typeLabel = 'Proyek Unggulan';
                                $url = 'projects.php?edit=' . intval($row['id']);
                                break;
                            case 'feature':
                                $typeLabel = 'Keunggulan';
                                $url = 'keunggulan.php?edit=' . intval($row['id']);
                                break;
                            case 'statistic':
                                $typeLabel = 'Statistik';
                                $url = 'statistik.php?edit=' . intval($row['id']);
                                break;
                            case 'message':
                                $typeLabel = 'Pesan';
                                $url = 'pesan_view.php?id=' . intval($row['id']);
                                break;
                        }
                    ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= $typeLabel; ?></td>
                        <td><?= htmlspecialchars($row['title']); ?></td>
                        <td><?= htmlspecialchars($row['extra']); ?></td>
                        <td><a href="<?= $url; ?>" style="color: var(--primary);">Lihat</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
