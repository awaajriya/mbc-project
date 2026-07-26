<?php
$title     = "Dashboard Admin - MBC";
$page      = "dashboard";
$namaAdmin = "Admin Hasan";

include 'koneksi.php';

function table_exists($conn, $table) {
    if (empty($table)) {
        return false;
    }
    $table = mysqli_real_escape_string($conn, $table);
    $result = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
    return $result && mysqli_num_rows($result) > 0;
}

function count_table($conn, $table) {
    if (empty($table) || !table_exists($conn, $table)) {
        return 0;
    }

    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `$table`");
    $row = $result ? mysqli_fetch_assoc($result) : null;
    return $row ? (int) $row['total'] : 0;
}

function get_latest_unit($conn) {
    if (!table_exists($conn, 'unit_bisnis')) {
        return null;
    }
    $result = mysqli_query($conn, "SELECT nama_unit, deskripsi FROM unit_bisnis ORDER BY id_unit DESC LIMIT 1");
    return $result ? mysqli_fetch_assoc($result) : null;
}

function find_message_table($conn) {
    foreach (['pesan', 'messages', 'contact'] as $table) {
        if (table_exists($conn, $table)) {
            return $table;
        }
    }
    return null;
}

$totalUnits = count_table($koneksi, 'unit_bisnis');
$totalAdmins = count_table($koneksi, 'admin');
$totalProjects = count_table($koneksi, 'proyek_unggulan');
$totalMessages = count_table($koneksi, find_message_table($koneksi) ?? '');
$totalStatistics = count_table($koneksi, 'statistik');
$latestUnit = get_latest_unit($koneksi);
$messageTable = find_message_table($koneksi);
$recentMessages = [];

if ($messageTable) {
    $result = mysqli_query($koneksi, "SELECT * FROM `$messageTable` ORDER BY id DESC LIMIT 2");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $keys = array_change_key_case($row, CASE_LOWER);
            $recentMessages[] = [
                'name' => htmlspecialchars($keys['nama'] ?? $keys['name'] ?? $keys['sender'] ?? 'Pengirim'),
                'email' => htmlspecialchars($keys['email'] ?? $keys['mail'] ?? $keys['alamat'] ?? '-'),
                'status' => 'Baru'
            ];
        }
    }
}

if (empty($recentMessages)) {
    $recentMessages = [
        ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'status' => 'Baru'],
        ['name' => 'Andi Wijaya', 'email' => 'andi@gmail.com', 'status' => 'Baru'],
    ];
}

$activityItems = [];
if ($latestUnit) {
    $activityItems[] = [
        'title' => sprintf('Admin %s memperbarui data Unit Bisnis "%s"', htmlspecialchars($namaAdmin), htmlspecialchars($latestUnit['nama_unit'])),
        'time' => 'Baru saja'
    ];
}
if ($totalProjects > 0) {
    $activityItems[] = [
        'title' => sprintf('Admin %s menambahkan proyek baru', htmlspecialchars($namaAdmin)),
        'time' => 'Terakhir diupdate'
    ];
}
if (empty($activityItems)) {
    $activityItems[] = ['title' => 'Tidak ada aktivitas terbaru.', 'time' => ''];
}

include 'header.php';
?>

<!-- HEADER KONTEN -->
<div class="content-header">
    <h1>Dashboard 👋</h1>
    <p>Selamat datang kembali, <strong><?= htmlspecialchars($namaAdmin) ?></strong>! Berikut ringkasan data website MBC.</p>
</div>

<!-- STATS CARDS (5 KOLOM STATISTIK) -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-building"></i></div>
        <div class="stat-info">
            <span>Total Unit Bisnis</span>
            <h3><?= $totalUnits; ?></h3>
        </div>
        <a href="units.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-chart-column"></i></div>
        <div class="stat-info">
            <span>Total Statistik</span>
            <h3><?= $totalStatistics; ?></h3>
        </div>
        <a href="statistik.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-folder"></i></div>
        <div class="stat-info">
            <span>Total Proyek</span>
            <h3><?= $totalProjects; ?></h3>
        </div>
        <a href="projects.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
        <div class="stat-info">
            <span>Pesan Masuk</span>
            <h3><?= $totalMessages; ?></h3>
        </div>
        <a href="pesan.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-user-shield"></i></div>
        <div class="stat-info">
            <span>Total Admin</span>
            <h3><?= $totalAdmins; ?></h3>
        </div>
        <a href="users.php" class="stat-link">Lihat semua →</a>
    </div>
</div>

<!-- GRID BARIS PERTAMA (Konten Terbaru & Hero Preview) -->
<div class="grid-2col">
    <div class="card-box">
        <div class="card-header">
            <h3>Konten Terbaru</h3>
            <a href="#">Lihat semua →</a>
        </div>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Jenis Konten</th>
                    <th>Judul</th>
                    <th>Terakhir Diupdate</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($latestUnit): ?>
                <tr>
                    <td><span class="badge badge-blue">Unit Bisnis</span></td>
                    <td><?= htmlspecialchars($latestUnit['nama_unit']); ?></td>
                    <td>-</td>
                    <td>
                        <a href="units.php" style="color:var(--text-muted); margin-right: 10px;"><i class="fa-regular fa-eye"></i></a>
                        <a href="units.php" style="color:var(--text-muted);"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                </tr>
                <?php else: ?>
                <tr>
                    <td><span class="badge badge-blue">Unit Bisnis</span></td>
                    <td>Belum ada data unit</td>
                    <td>-</td>
                    <td>
                        <a href="units.php" style="color:var(--text-muted); margin-right: 10px;"><i class="fa-regular fa-eye"></i></a>
                        <a href="units.php" style="color:var(--text-muted);"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td><span class="badge badge-yellow">Proyek</span></td>
                    <td><?= $totalProjects > 0 ? 'Proyek terbaru tersedia' : 'Belum ada data proyek'; ?></td>
                    <td>-</td>
                    <td>
                        <a href="projects.php" style="color:var(--text-muted); margin-right: 10px;"><i class="fa-regular fa-eye"></i></a>
                        <a href="projects.php" style="color:var(--text-muted);"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                </tr>
                <tr>
                    <td><span class="badge badge-purple">Keunggulan</span></td>
                    <td><?= table_exists($koneksi, 'keunggulan') ? 'Keunggulan terbaru tersedia' : 'Belum ada data keunggulan'; ?></td>
                    <td>-</td>
                    <td>
                        <a href="keunggulan.php" style="color:var(--text-muted); margin-right: 10px;"><i class="fa-regular fa-eye"></i></a>
                        <a href="keunggulan.php" style="color:var(--text-muted);"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card-box">
        <div class="card-header">
            <h3>Preview Hero Section <span style="font-weight:400; font-size:12px; color:var(--text-muted);">(Landing Page)</span></h3>
            <a href="../index.php" target="_blank">Lihat Website ↗</a>
        </div>
        <div class="hero-preview">
            <h2>MARDIRA BUSINESS CENTER</h2>
            <p>Empowering Innovation, Business & Entrepreneurship.</p>
        </div>
    </div>
</div>

<!-- GRID BARIS KEDUANYA (Aksi Cepat, Pesan Terbaru, Aktivitas Terakhir) -->
<div class="grid-3col">
    <div class="card-box">
        <div class="card-header"><h3>Aksi Cepat</h3></div>
        <div class="action-grid">
            <a href="units.php" class="action-card"><i class="fa-solid fa-plus"></i> Tambah Unit</a>
            <a href="projects.php" class="action-card"><i class="fa-solid fa-plus"></i> Tambah Proyek</a>
            <a href="keunggulan.php" class="action-card"><i class="fa-solid fa-pen"></i> Edit Keunggulan</a>
            <a href="pesan.php" class="action-card"><i class="fa-solid fa-envelope"></i> Lihat Pesan</a>
        </div>
    </div>

    <div class="card-box">
        <div class="card-header">
            <h3>Pesan Terbaru</h3>
            <a href="pesan.php">Lihat semua →</a>
        </div>
        <?php foreach ($recentMessages as $message): ?>
        <div class="list-item">
            <div class="user-info">
                <div class="mini-avatar"><?= strtoupper(substr($message['name'], 0, 1)); ?></div>
                <div class="user-detail">
                    <h4><?= $message['name']; ?></h4>
                    <p><?= $message['email']; ?></p>
                </div>
            </div>
            <span class="badge badge-green"><?= $message['status']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="card-box">
        <div class="card-header"><h3>Aktivitas Terakhir</h3></div>
        <div style="font-size: 12px; color: var(--text-muted);">
            <?php foreach ($activityItems as $activity): ?>
                <p style="margin-bottom: 12px;"><strong><?= htmlspecialchars($namaAdmin); ?></strong> <?= htmlspecialchars($activity['title']); ?><br><small><?= htmlspecialchars($activity['time']); ?></small></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>