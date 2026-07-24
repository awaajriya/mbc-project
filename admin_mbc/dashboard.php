<?php
$title = "Mardira Business Center Admin";
date_default_timezone_set("Asia/Jakarta");

session_start();

$namaAdmin = "Admin Hasan"; // sementara untuk testing
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    
<style>
  
  .logo-badge img{
    width: 100%;
    height: auto;
    object-fit: contain;
}
</style>
</head>

<body>
    <div class="admin-shell">
        <aside class="sidebar">
            <div class="brand">
              <img src="../assets/logo_footer.png" alt="Logo MBC">
            </div>
            <div class="brand-name">
                <p>Admin Dashboard</p>
            </div>
            <ul class="sidebar-nav">
                <li><a href="dashboard.php" class="active"><i class="fa-solid fa-gauge-high"></i>Dashboard</a></li>
                <li><a href="units.php"><i class="fa-solid fa-building"></i>Unit Bisnis</a></li>
                <li><a href="projects.php"><i class="fa-solid fa-users"></i>Proyek Unggukan</a></li>
                <li><a href="keunggulan.php"><i class="fa-solid fa-star"></i>Keunggulan MBC</a></li>
                <li><a href="statistik.php"><i class="fa-solid fa-chart-simple"></i>Statistik</a></li>
                <li><a href="proses_collab.php"><i class="fa-solid fa-user"></i>Proses Kolaborasi</a></li>
                <li><a href="settings.php"><i class="fa-solid fa-gear"></i>Pengaturan</a></li>
            </ul>

            <div class="sidebar-footer">
               <a href="../logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
            </div>
        </aside>

        <main class="main-content">
            <div class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle"><i class="fa-solid fa-bars"></i></button>
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search users, orders, reports">
                    </div>
                </div>

                <div class="topbar-actions">
                    <button><i class="fa-solid fa-moon"></i></button>
                    <button><i class="fa-solid fa-bell"></i></button>
                    <div class="avatar">
                        <span class="avatar-badge">AH</span>
                        <div>Admin Hasan</div>
                    </div>
                </div>
            </div>

           <div class="content-header">
             <h1>Dashboard</h1>
             <p>Selamat datang kembali,
                <strong><?= htmlspecialchars($namaAdmin) ?></strong>! Berikut adalah ringkasan website MBC.</p>
           </div>

            <div class="stats-grid">
                <div class="card">
                    <div class="card-label">Total Unit Bisnis</div>
                    <div class="card-number">12</div>
                    <div class="card-meta">+2 from last month</div>
                </div>
                <div class="card small">
                    <div class="card-label">Total Proyek</div>
                    <div class="card-number">1.284</div>
                    <div class="card-meta">+8.2% new orders</div>
                </div>
                <div class="card small">
                    <div class="card-label">Total Statistik</div>
                    <div class="card-number">8.742</div>
                    <div class="card-meta">+5.1% active users</div>
                </div>
                <div class="card small">
                    <div class="card-label">Pesan Masuk</div>
                    <div class="card-number">36</div>
                    <div class="card-meta">3 urgent need review</div>
                </div>
            </div>

            <div class="overview-row">
                <section class="card wide-card">
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
                        <div>
                            <h2>Konten Terbaru</h2>
                            <p>Monthly revenue compared with operational targets and team progress.</p>
                        </div>
                        <a href="#" class="view-details">View Details</a>
                    </div>
                    <div style="min-height:220px; border-radius:20px; background: linear-gradient(180deg, rgba(30,78,150,0.08), rgba(255,255,255,0.9)); display:flex; align-items:center; justify-content:center; color: var(--text-soft);">Chart placeholder</div>
                </section>

                <section class="card activity-card">
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
                            <div>
                                <h2>Team Activity</h2>
                                <p>Recent operational updates.</p>
                            </div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div>
                            <strong>New campaign launched</strong>
                            <div>Marketing team published the May offer.</div>
                        </div>
                        <span style="color: var(--blue-deep);">Now</span>
                    </div>
                    <div class="activity-item">
                        <div>
                            <strong>Order growth</strong>
                            <div>Sales orders increased by 8.2% this month.</div>
                        </div>
                        <span style="color: #2d7a44;">Today</span>
                    </div>
                </section>
            </div>

            <section class="card table-card">
                <div class="table-actions">
                    <div>
                        <h2>Recent Users</h2>
                        <p>Latest account activity across the workspace.</p>
                    </div>
                    <button class="btn-primary">Manage Users</button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Team</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Sarah Ahmed</strong><br><small>sarah@example.com</small></td>
                            <td>Admin</td>
                            <td>Operations</td>
                            <td><span class="status-pill status-active">Active</span></td>
                            <td>Jan 12, 2026</td>
                            <td><button class="view-btn">View</button></td>
                        </tr>
                        <tr>
                            <td><strong>Rafi Khan</strong><br><small>rafi@example.com</small></td>
                            <td>Manager</td>
                            <td>Sales</td>
                            <td><span class="status-pill status-active">Active</span></td>
                            <td>Feb 03, 2026</td>
                            <td><button class="view-btn">View</button></td>
                        </tr>
                        <tr>
                            <td><strong>Nadia Islam</strong><br><small>nadia@example.com</small></td>
                            <td>Editor</td>
                            <td>Content</td>
                            <td><span class="status-pill status-pending">Pending</span></td>
                            <td>Mar 18, 2026</td>
                            <td><button class="view-btn">View</button></td>
                        </tr>
                        <tr>
                            <td><strong>Mina Torres</strong><br><small>mina@example.com</small></td>
                            <td>Viewer</td>
                            <td>Finance</td>
                            <td><span class="status-pill status-suspended">Suspended</span></td>
                            <td>Apr 07, 2026</td>
                            <td><button class="view-btn">View</button></td>
                        </tr>
                        <tr>
                            <td><strong>Jon Oliver</strong><br><small>jon@example.com</small></td>
                            <td>Analyst</td>
                            <td>Data</td>
                            <td><span class="status-pill status-active">Active</span></td>
                            <td>Apr 22, 2026</td>
                            <td><button class="view-btn">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>

</html>
