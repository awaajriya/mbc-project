<?php
$title     = "Dashboard Admin - MBC";
$page      = "dashboard";
$namaAdmin = "Admin Hasan";

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
            <h3>3</h3>
        </div>
        <a href="units.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-folder"></i></div>
        <div class="stat-info">
            <span>Total Proyek</span>
            <h3>3</h3>
        </div>
        <a href="projects.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-chart-column"></i></div>
        <div class="stat-info">
            <span>Total Statistik</span>
            <h3>4</h3>
        </div>
        <a href="statistik.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
        <div class="stat-info">
            <span>Pesan Masuk</span>
            <h3>5</h3>
        </div>
        <a href="pesan.php" class="stat-link">Lihat semua →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-user-shield"></i></div>
        <div class="stat-info">
            <span>Total Admin</span>
            <h3>2</h3>
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
                <tr>
                    <td><span class="badge badge-blue">Unit Bisnis</span></td>
                    <td>Mardira Press</td>
                    <td>23 Mei 2026 10:30</td>
                    <td><a href="units.php" style="color:var(--text-muted);"><i class="fa-regular fa-pen-to-square"></i></a></td>
                </tr>
                <tr>
                    <td><span class="badge badge-yellow">Proyek</span></td>
                    <td>Integrasi Sistem Digital</td>
                    <td>22 Mei 2026 14:15</td>
                    <td><a href="projects.php" style="color:var(--text-muted);"><i class="fa-regular fa-pen-to-square"></i></a></td>
                </tr>
                <tr>
                    <td><span class="badge badge-purple">Keunggulan</span></td>
                    <td>Inovasi Terdepan</td>
                    <td>21 Mei 2026 09:40</td>
                    <td><a href="keunggulan.php" style="color:var(--text-muted);"><i class="fa-regular fa-pen-to-square"></i></a></td>
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
        <div class="list-item">
            <div class="user-info">
                <div class="mini-avatar">B</div>
                <div class="user-detail">
                    <h4>Budi Santoso</h4>
                    <p>budi@gmail.com</p>
                </div>
            </div>
            <span class="badge badge-green">Baru</span>
        </div>
        <div class="list-item">
            <div class="user-info">
                <div class="mini-avatar" style="background:#8b5cf6;">A</div>
                <div class="user-detail">
                    <h4>Andi Wijaya</h4>
                    <p>andi@gmail.com</p>
                </div>
            </div>
            <span class="badge badge-green">Baru</span>
        </div>
    </div>

    <div class="card-box">
        <div class="card-header"><h3>Aktivitas Terakhir</h3></div>
        <div style="font-size: 12px; color: var(--text-muted);">
            <p style="margin-bottom: 12px;"><strong>Admin Hasan</strong> mengupdate data Unit Bisnis "Mardira Press"<br><small>23 Mei 2026 10:30</small></p>
            <p><strong>Admin Hasan</strong> menambahkan proyek baru<br><small>22 Mei 2026 14:15</small></p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>