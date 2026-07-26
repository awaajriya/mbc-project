<?php
date_default_timezone_set("Asia/Jakarta");

// Fallback variabel jika belum ditentukan di file utama
$title     = $title ?? "Dashboard Admin - MBC";
$page      = $page ?? "dashboard";
$namaAdmin = $namaAdmin ?? "Admin Hasan";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <?php
    if (!isset($koneksi)) {
        @include_once __DIR__ . '/koneksi.php';
    }
    $unreadCount = 0;
    if (isset($koneksi) && $koneksi) {
        $countResult = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesan WHERE is_read = 0");
        if ($countResult) {
            $countRow = mysqli_fetch_assoc($countResult);
            $unreadCount = (int) ($countRow['total'] ?? 0);
        }
    }
    ?>

    <!-- Google Fonts & FontAwesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --primary: #0d59c6;
            --primary-light: #eef4ff;
            --bg-body: #f8fafc;
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --sidebar-width: 250px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-dark); display: flex; min-height: 100vh; }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            left: 0;
            transition: left 0.25s ease;
        }
        .sidebar .close-sidebar {
            display: none;
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 18px;
            padding: 14px 18px;
            align-self: flex-end;
            cursor: pointer;
        }
        .backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease;
            z-index: 90;
            pointer-events: none;
        }
        .backdrop.visible {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
        .brand {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand img { height: 38px; object-fit: contain; }
        .brand-text h2 { font-size: 15px; font-weight: 700; color: var(--text-dark); }
        .brand-text span { font-size: 11px; color: var(--text-muted); }

        .sidebar-nav { list-style: none; padding: 0 16px; margin-top: 10px; flex: 1; }
        .sidebar-nav li { margin-bottom: 4px; }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .sidebar-nav a:hover { background: #f1f5f9; color: var(--text-dark); }
        .sidebar-nav a.active { background: var(--primary); color: #ffffff; font-weight: 600; }
        .sidebar-nav a i { font-size: 16px; width: 20px; text-align: center; }

        .sidebar-footer { padding: 16px; border-top: 1px solid var(--border-color); }
        .logout-btn { color: #ef4444 !important; }
        .logout-btn:hover { background: #fef2f2 !important; }

        /* --- MAIN CONTENT & TOPBAR --- */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 24px 32px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            gap: 12px;
        }
        .mobile-menu-btn {
            display: none;
            background: #ffffff;
            border: 1px solid var(--border-color);
            width: 42px;
            height: 42px;
            border-radius: 12px;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .search-box {
            position: relative;
            width: 340px;
        }
        .search-box input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            font-size: 13px;
            outline: none;
        }
        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .icon-btn {
            position: relative;
            background: #ffffff;
            border: 1px solid var(--border-color);
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-muted);
        }
        .mobile-menu-btn {
            display: none;
            background: #ffffff;
            border: 1px solid var(--border-color);
            width: 42px;
            height: 42px;
            border-radius: 12px;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .badge-count {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--primary);
            color: #fff;
            font-size: 10px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .avatar-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .avatar-badge {
            width: 38px;
            height: 38px;
            background: #eab308;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        /* --- STYLES UMUM & CARDS --- */
        .content-header h1 { font-size: 22px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .content-header p { font-size: 13px; color: var(--text-muted); margin-bottom: 24px; }

        .stats-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; padding: 16px; display: flex; flex-direction: column; gap: 8px; }
        .stat-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; }
        .stat-card:nth-child(1) .stat-icon { background: #1d4ed8; }
        .stat-card:nth-child(2) .stat-icon { background: #eab308; }
        .stat-card:nth-child(3) .stat-icon { background: #10b981; }
        .stat-card:nth-child(4) .stat-icon { background: #8b5cf6; }
        .stat-card:nth-child(5) .stat-icon { background: #06b6d4; }
        .stat-info span { font-size: 12px; color: var(--text-muted); font-weight: 500; }
        .stat-info h3 { font-size: 22px; font-weight: 700; color: var(--text-dark); margin: 2px 0; }
        .stat-link { font-size: 11px; color: var(--primary); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }

        .grid-2col { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 20px; margin-bottom: 24px; }
        .grid-3col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .card-box { background: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .card-header h3 { font-size: 15px; font-weight: 700; color: var(--text-dark); }
        .card-header a { font-size: 12px; color: var(--primary); text-decoration: none; font-weight: 600; }

        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th { text-align: left; font-size: 12px; color: var(--text-muted); padding: 8px 12px; border-bottom: 1px solid var(--border-color); }
        .custom-table td { font-size: 13px; padding: 12px; border-bottom: 1px solid #f1f5f9; }
        .badge { padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 600; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-yellow { background: #fef3c7; color: #92400e; }
        .badge-purple { background: #f3e8ff; color: #6b21a8; }
        .badge-green { background: #dcfce7; color: #166534; }

        .hero-preview { background: linear-gradient(135deg, #dbeafe 0%, #fef3c7 100%); border-radius: 10px; padding: 24px; height: 180px; display: flex; flex-direction: column; justify-content: center; }
        .hero-preview h2 { font-size: 18px; color: #1e3a8a; font-weight: 800; max-width: 65%; }
        .hero-preview p { font-size: 11px; color: #3b82f6; font-weight: 600; margin-top: 6px; }

        .action-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .action-card { border: 1px solid var(--border-color); border-radius: 8px; padding: 12px; text-decoration: none; color: var(--text-dark); display: flex; align-items: center; gap: 10px; font-size: 12px; font-weight: 600; transition: 0.2s; }
        .action-card:hover { border-color: var(--primary); background: #f8fafc; }
        .action-card i { font-size: 16px; color: var(--primary); }

        .list-item { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f1f5f9; }
        .list-item:last-child { border-bottom: none; }
        .user-info { display: flex; align-items: center; gap: 10px; }
        .mini-avatar { width: 32px; height: 32px; border-radius: 50%; background: #10b981; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; }
        .user-detail h4 { font-size: 13px; font-weight: 600; }
        .user-detail p { font-size: 11px; color: var(--text-muted); }

        @media (max-width: 1024px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                width: 220px;
                transition: left 0.25s ease;
            }
            .sidebar.open {
                left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 16px;
            }
            .topbar {
                flex-wrap: wrap;
                gap: 12px;
            }
            .search-box { width: 100%; }
            .mobile-menu-btn { display: inline-flex; }
        }

        @media (max-width: 720px) {
            .sidebar {
                width: 100%;
                max-width: 280px;
            }
            .topbar-actions { display: none; }
            .sidebar .close-sidebar { display: inline-flex; }
            .brand-text h2 { font-size: 14px; }
            .brand-text span { font-size: 10px; }
        }
    </style>
</head>

<body>
    <!-- SIDEBAR UTAMA -->
    <aside class="sidebar">
        <div class="brand">
            <img src="../assets/logo_footer.png" alt="Logo MBC" onerror="this.src='https://via.placeholder.com/36'">
            <div class="brand-text">
                <h2>MBC Dashboard</h2>
                <span>Admin Panel</span>
            </div>
            <button class="close-sidebar" onclick="closeSidebar()" aria-label="Tutup menu"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <ul class="sidebar-nav">
            <li><a href="dashboard.php" class="<?= ($page == 'dashboard') ? 'active' : ''; ?>"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="units.php" class="<?= ($page == 'units') ? 'active' : ''; ?>"><i class="fa-solid fa-building"></i> Unit Bisnis</a></li>
            <li><a href="keunggulan.php" class="<?= ($page == 'keunggulan') ? 'active' : ''; ?>"><i class="fa-solid fa-star"></i> Keunggulan MBC</a></li>
            <li><a href="statistik.php" class="<?= ($page == 'statistik') ? 'active' : ''; ?>"><i class="fa-solid fa-chart-simple"></i> Statistik</a></li>
            <li><a href="proses_collab.php" class="<?= ($page == 'proses_collab') ? 'active' : ''; ?>"><i class="fa-solid fa-arrows-rotate"></i> Proses Kolaborasi</a></li>
            <li><a href="projects.php" class="<?= ($page == 'projects') ? 'active' : ''; ?>"><i class="fa-solid fa-folder-open"></i> Proyek Unggulan</a></li>
            <li><a href="pesan.php" class="<?= ($page == 'pesan') ? 'active' : ''; ?>"><i class="fa-solid fa-envelope"></i> Kontak (Pesan)</a></li>
            <li><a href="users.php" class="<?= ($page == 'users') ? 'active' : ''; ?>"><i class="fa-solid fa-users"></i> Admin</a></li>
            <li><a href="settings.php" class="<?= ($page == 'settings') ? 'active' : ''; ?>"><i class="fa-solid fa-gear"></i> Pengaturan Website</a></li>
        </ul>

        <div class="sidebar-footer">
            <a href="logout.php" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main-content">
        <!-- TOPBAR -->
        <div class="topbar">
            <button class="mobile-menu-btn" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
            <form action="search.php" method="GET" class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" placeholder="Cari data..." value="<?= htmlspecialchars($searchQuery ?? '', ENT_QUOTES); ?>">
            </form>

            <div class="topbar-actions">
                <a href="pesan.php" class="icon-btn" title="Pesan masuk">
                    <i class="fa-regular fa-bell"></i>
                    <?php if ($unreadCount > 0): ?>
                        <span class="badge-count"><?= $unreadCount; ?></span>
                    <?php endif; ?>
                </a>
                <div class="avatar-box">
                    <div class="avatar-badge">AH</div>
                    <div>
                        <h4 style="font-size: 13px; font-weight: 600;"><?= htmlspecialchars($namaAdmin); ?></h4>
                        <span style="font-size: 11px; color: var(--text-muted);">Administrator</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="backdrop" onclick="closeSidebar()"></div>
        <script>
            function toggleSidebar() {
                document.querySelector('.sidebar').classList.toggle('open');
                document.querySelector('.backdrop').classList.toggle('visible');
            }
            function closeSidebar() {
                document.querySelector('.sidebar').classList.remove('open');
                document.querySelector('.backdrop').classList.remove('visible');
            }
        </script>