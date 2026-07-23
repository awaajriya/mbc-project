<?php
$title = "Dashboard Admin - Mardira Business Center";
date_default_timezone_set("Asia/Jakarta");
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title; ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --blue: #1e4e96;
      --blue-deep: #0f2e5c;
      --blue-light: #3e71c4;
      --gold: #f6b800;
      --gold-light: #ffd666;
      --white: #ffffff;
      --gray: #f5f7fa;
      --dark: #1b1f23;
      --radius: 24px;
      --radius-sm: 14px;
      --shadow-soft: 0 20px 60px rgba(15, 46, 92, 0.1);
      --shadow-strong: 0 30px 80px rgba(15, 46, 92, 0.2);
      --bg: #f5f7fa;
      --text: #1b1f23;
      --text-soft: #5b6472;
      --card-bg: rgba(255, 255, 255, 0.72);
      --glass-border: rgba(255, 255, 255, 0.5);
      --nav-bg: rgba(255, 255, 255, 0.65);
      --ease: cubic-bezier(0.22, 1, 0.36, 1);
    }

    body.dark {
      --bg: #080d18;
      --text: #eef1f6;
      --text-soft: #96a0b3;
      --card-bg: rgba(22, 31, 51, 0.6);
      --glass-border: rgba(255, 255, 255, 0.08);
      --nav-bg: rgba(10, 15, 26, 0.65);
      --shadow-soft: 0 20px 60px rgba(0, 0, 0, 0.35);
      --shadow-strong: 0 30px 90px rgba(0, 0, 0, 0.5);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: "Inter", sans-serif;
      background: var(--bg);
      color: var(--text);
      overflow-x: hidden;
      transition: background 0.4s var(--ease), color 0.4s var(--ease);
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
      font-family: "Space Grotesk", sans-serif;
      letter-spacing: -0.02em;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    button {
      font-family: inherit;
      cursor: pointer;
      border: none;
      background: none;
      color: inherit;
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
    }

    .grid12 {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      gap: 24px;
    }

    .section-pad {
      padding: 100px 0;
    }

    .logo {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-family: "Space Grotesk", sans-serif;
      font-weight: 700;
      font-size: 18px;
      width: fit-content;
    }

    .logo .mark {
      width: 38px;
      height: 38px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 16px;
    }

    .nav-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--nav-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 100px;
      padding: 10px 14px;
      box-shadow: 0 8px 32px rgba(15, 46, 92, 0.06);
      transition: all 0.4s var(--ease);
    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      padding: 18px 0;
      transition: all 0.4s var(--ease);
    }

    header.scrolled .nav-inner {
      box-shadow: var(--shadow-soft);
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .nav-links a,
    .nav-item {
      padding: 10px 16px;
      border-radius: 100px;
      font-size: 14.5px;
      font-weight: 500;
      color: var(--text);
      transition: 0.25s;
    }

    .nav-links a:hover,
    .nav-item:hover {
      background: rgba(30, 78, 150, 0.08);
      color: var(--blue);
    }

    .nav-item.active {
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      color: #fff;
    }

    .nav-right {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .icon-btn {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(30, 78, 150, 0.06);
      transition: 0.25s;
    }

    .icon-btn:hover {
      background: rgba(30, 78, 150, 0.14);
      transform: translateY(-1px);
    }

    .icon-btn svg {
      width: 18px;
      height: 18px;
      stroke: var(--text);
    }

    .nav-cta {
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      color: #fff;
      padding: 12px 22px;
      border-radius: 100px;
      font-size: 14px;
      font-weight: 600;
      box-shadow: 0 8px 24px rgba(30, 78, 150, 0.26);
      transition: 0.3s var(--ease);
      white-space: nowrap;
    }

    .nav-cta:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(30, 78, 150, 0.35);
    }

    .search-wrap {
      display: flex;
      align-items: center;
      background: rgba(30, 78, 150, 0.06);
      border-radius: 100px;
      overflow: hidden;
      transition: 0.35s var(--ease);
    }

    .search-wrap input {
      width: 0;
      opacity: 0;
      border: none;
      background: transparent;
      outline: none;
      padding: 0;
      font-size: 13.5px;
      color: var(--text);
      transition: 0.35s var(--ease);
    }

    .search-wrap.open {
      padding-left: 14px;
    }

    .search-wrap.open input {
      width: 170px;
      opacity: 1;
      padding: 0 10px;
    }

    #scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      width: 0%;
      background: linear-gradient(90deg, var(--blue), var(--gold));
      z-index: 9999;
      transition: width 0.05s linear;
    }

    .hero {
      padding: 180px 0 80px;
      position: relative;
      overflow: hidden;
    }

    .mesh-bg {
      position: absolute;
      inset: 0;
      z-index: -2;
      overflow: hidden;
    }

    .mesh-bg span {
      position: absolute;
      border-radius: 50%;
      filter: blur(90px);
      opacity: 0.55;
      animation: drift 18s ease-in-out infinite alternate;
    }

    .mesh-bg span:nth-child(1) {
      width: 520px;
      height: 520px;
      background: var(--blue);
      top: -160px;
      left: -120px;
    }

    .mesh-bg span:nth-child(2) {
      width: 420px;
      height: 420px;
      background: var(--gold);
      top: 60px;
      right: -140px;
      opacity: 0.35;
      animation-delay: 3s;
    }

    .mesh-bg span:nth-child(3) {
      width: 380px;
      height: 380px;
      background: var(--blue-light);
      bottom: -160px;
      left: 30%;
      opacity: 0.3;
      animation-delay: 6s;
    }

    @keyframes drift {
      0% {
        transform: translate(0, 0) scale(1);
      }

      100% {
        transform: translate(40px, 60px) scale(1.15);
      }
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.05fr 0.95fr;
      gap: 48px;
      align-items: start;
    }

    .hero-kicker {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--blue);
      margin-bottom: 20px;
    }

    .hero-kicker .dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--gold);
      box-shadow: 0 0 12px var(--gold);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0.4;
      }
    }

    .hero h1 {
      font-size: clamp(40px, 5vw, 64px);
      line-height: 1.03;
      font-weight: 700;
      margin-bottom: 24px;
    }

    .hero h1 .l1 {
      display: block;
      color: var(--blue-deep);
    }

    .hero h1 .l2 {
      display: block;
      background: linear-gradient(100deg, var(--blue) 10%, var(--gold) 90%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero-desc {
      font-size: 17px;
      color: var(--text-soft);
      line-height: 1.75;
      max-width: 560px;
      margin-bottom: 34px;
    }

    .hero-actions {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 15px 28px;
      border-radius: 100px;
      font-weight: 600;
      font-size: 15px;
      transition: 0.35s var(--ease);
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      color: #fff;
      box-shadow: 0 10px 30px rgba(30, 78, 150, 0.35);
    }

    .btn-ghost {
      background: rgba(255, 255, 255, 0.45);
      color: var(--text);
      border: 1px solid rgba(30, 78, 150, 0.12);
      box-shadow: none;
    }

    .btn:hover {
      transform: translateY(-3px);
    }

    .panel {
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 32px;
      box-shadow: var(--shadow-soft);
      padding: 32px;
      transition: transform 0.35s var(--ease), box-shadow 0.35s var(--ease);
    }

    .panel:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-strong);
    }

    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 24px;
      margin-top: 32px;
    }

    .info-card {
      background: var(--card-bg);
      border: 1px solid var(--glass-border);
      border-radius: 28px;
      padding: 28px;
      box-shadow: var(--shadow-soft);
    }

    .info-card h3 {
      font-size: 20px;
      margin-bottom: 20px;
    }

    .info-card .stat {
      font-size: clamp(32px, 4vw, 42px);
      font-weight: 700;
      margin-bottom: 10px;
      color: var(--blue-deep);
    }

    .info-card p {
      color: var(--text-soft);
      line-height: 1.7;
      font-size: 14px;
    }

    .admin-section {
      margin-top: 90px;
    }

    .section-title {
      font-size: clamp(28px, 3.4vw, 40px);
      font-weight: 700;
      margin-bottom: 16px;
    }

    .section-sub {
      font-size: 16px;
      color: var(--text-soft);
      max-width: 720px;
      line-height: 1.7;
      margin-bottom: 36px;
    }

    .overview-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 24px;
    }

    .overview-panel {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 20px;
      margin-top: 24px;
    }

    .status-card {
      background: var(--card-bg);
      border: 1px solid var(--glass-border);
      border-radius: 24px;
      padding: 24px;
      box-shadow: var(--shadow-soft);
    }

    .status-card h4 {
      font-size: 16px;
      margin-bottom: 12px;
    }

    .status-card .status-value {
      font-size: 32px;
      font-weight: 700;
      color: var(--blue-deep);
    }

    .activity-list {
      list-style: none;
      display: grid;
      gap: 14px;
    }

    .activity-item {
      background: var(--card-bg);
      border: 1px solid var(--glass-border);
      border-radius: 18px;
      padding: 18px 22px;
      display: flex;
      justify-content: space-between;
      gap: 14px;
      align-items: center;
      box-shadow: var(--shadow-soft);
    }

    .activity-description {
      color: var(--text-soft);
      font-size: 14px;
      line-height: 1.6;
    }

    .status-badge {
      padding: 8px 14px;
      border-radius: 999px;
      font-size: 12.5px;
      font-weight: 700;
      text-transform: uppercase;
      color: #fff;
    }

    .status-badge.success {
      background: #218a76;
    }

    .status-badge.warning {
      background: #c17a00;
    }

    .status-badge.neutral {
      background: #3f6a99;
    }

    .admin-cards {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 24px;
      margin-top: 34px;
    }

    .admin-card {
      background: var(--card-bg);
      border: 1px solid var(--glass-border);
      border-radius: 28px;
      padding: 34px;
      box-shadow: var(--shadow-soft);
    }

    .admin-card h3 {
      margin-bottom: 18px;
      font-size: 20px;
    }

    .admin-card p {
      color: var(--text-soft);
      line-height: 1.7;
    }

    .admin-card .admin-action {
      margin-top: 22px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--blue);
      font-weight: 700;
    }

    .footer {
      padding: 60px 0 32px;
      text-align: center;
      color: var(--text-soft);
      font-size: 14px;
    }

    [data-animate] {
      opacity: 0;
      transition: opacity 0.8s var(--ease), transform 0.8s var(--ease), filter 0.8s var(--ease);
    }

    [data-animate="fade-up"] {
      transform: translateY(40px);
    }

    .in-view {
      opacity: 1;
      transform: none;
      filter: blur(0);
    }

    @media (max-width: 1024px) {
      .hero-grid,
      .overview-grid,
      .admin-cards {
        grid-template-columns: 1fr;
      }

      .dashboard-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .nav-links,
      .search-wrap {
        display: none;
      }
    }

    @media (max-width: 640px) {
      .dashboard-grid,
      .overview-panel,
      .admin-cards {
        grid-template-columns: 1fr;
      }

      .hero {
        padding-top: 160px;
      }

      .nav-inner {
        padding-left: 18px;
        padding-right: 18px;
      }
    }
  </style>
</head>

<body>
  <div id="scroll-progress"></div>

  <header id="site-header">
    <div class="nav-inner">
      <a href="dashboard.php" class="logo">
        <span class="mark">M</span>
        <span>MBC Admin</span>
      </a>
      <nav class="nav-links">
        <a href="dashboard.php" class="nav-item active">Dashboard</a>
        <a href="units.php" class="nav-item">Unit Bisnis</a>
        <a href="#users" class="nav-item">Pengguna</a>
        <a href="#reports" class="nav-item">Laporan</a>
      </nav>
      <div class="nav-right">
        <div class="search-wrap" id="searchWrap">
          <button class="icon-btn" id="searchBtn" aria-label="Search">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
              <circle cx="11" cy="11" r="7" />
              <path d="M21 21l-4.3-4.3" />
            </svg>
          </button>
          <input type="text" placeholder="Cari admin..." />
        </div>
        <button class="icon-btn" id="themeToggle" aria-label="Toggle dark mode">
          <svg id="themeIcon" viewBox="0 0 24 24" fill="none" stroke-width="2">
            <circle cx="12" cy="12" r="5" />
            <path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
          </svg>
        </button>
        <a href="login.php" class="nav-cta">Logout</a>
      </div>
    </div>
  </header>

  <section class="hero" id="home">
    <div class="mesh-bg"><span></span><span></span><span></span></div>
    <div class="container hero-grid">
      <div data-animate="fade-up">
        <div class="hero-kicker">
          <span class="dot"></span>
          Admin Dashboard
        </div>
        <h1>
          <span class="l1">Selamat Datang</span>
          <span class="l2">Admin MBC</span>
        </h1>
        <p class="hero-desc">
          Kelola unit bisnis, pantau performa, dan tinjau aktivitas terbaru dengan tampilan admin yang menggunakan tema Mardira Business Center.
        </p>
        <div class="hero-actions">
          <a href="#overview" class="btn">Lihat Ringkasan</a>
          <a href="#activity" class="btn btn-ghost">Aktivitas Terbaru</a>
        </div>
      </div>
      <div class="panel" data-animate="fade-up">
        <h3>Ringkasan Cepat</h3>
        <div class="dashboard-grid">
          <div class="info-card">
            <p class="stat">Rp 75,2JT</p>
            <h3>Pendapatan Bulanan</h3>
            <p>Jumlah pemasukan dari semua unit bisnis selama 30 hari terakhir.</p>
          </div>
          <div class="info-card">
            <p class="stat">48</p>
            <h3>Permintaan Baru</h3>
            <p>Tiket atau permintaan layanan yang belum ditangani oleh tim admin.</p>
          </div>
          <div class="info-card">
            <p class="stat">1.320</p>
            <h3>Pengguna Terdaftar</h3>
            <p>Total anggota dan calon pelanggan yang terdaftar di sistem.</p>
          </div>
          <div class="info-card">
            <p class="stat">92%</p>
            <h3>Kepuasan Pelanggan</h3>
            <p>Indikator respon cepat, layanan efektif, dan feedback positif.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="container admin-section" id="overview" data-animate="fade-up">
    <div class="section-title">Overview Operasional</div>
    <p class="section-sub">Pantau angka penting, aktivitas terbaru, dan status unit bisnis secara real-time. Dashboard ini dirancang agar admin dapat mengambil keputusan lebih cepat.</p>
    <div class="overview-grid">
      <div class="panel">
        <h3>Detail Ringkasan</h3>
        <p>Data operasional, pengelolaan unit, dan kontrol kualitas berjalan dalam satu tampilan yang konsisten dengan identitas MBC.</p>
        <div class="overview-panel">
          <div class="status-card">
            <h4>Unit Aktif</h4>
            <div class="status-value">12</div>
            <p>Unit bisnis yang sedang berjalan dan menerima pelanggan.</p>
          </div>
          <div class="status-card">
            <h4>Transaksi Hari Ini</h4>
            <div class="status-value">76</div>
            <p>Jumlah transaksi yang dicatat sejak jam 00.00 WIB.</p>
          </div>
          <div class="status-card">
            <h4>Notifikasi</h4>
            <div class="status-value">8</div>
            <p>Pemberitahuan sistem penting yang butuh perhatian segera.</p>
          </div>
          <div class="status-card">
            <h4>Pembaruan Sistem</h4>
            <div class="status-value">3</div>
            <p>Patch keamanan atau fitur baru yang tersedia untuk instalasi.</p>
          </div>
        </div>
      </div>
      <div class="panel">
        <h3>Aktivitas Terbaru</h3>
        <ul class="activity-list">
          <li class="activity-item">
            <div>
              <strong>Permintaan akses unit</strong>
              <p class="activity-description">Pengguna berhasil mengajukan akses ke Mardira Hub.</p>
            </div>
            <span class="status-badge success">Selesai</span>
          </li>
          <li class="activity-item">
            <div>
              <strong>Pembaruan stok bahan cetak</strong>
              <p class="activity-description">Mardira Press menerima persediaan kertas baru untuk produksi.</p>
            </div>
            <span class="status-badge neutral">Dalam Proses</span>
          </li>
          <li class="activity-item">
            <div>
              <strong>Pesanan pelatihan</strong>
              <p class="activity-description">Sesi pelatihan baru terjadwal untuk kelas Softskill pada minggu depan.</p>
            </div>
            <span class="status-badge warning">Menunggu</span>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section class="container admin-section" id="reports" data-animate="fade-up">
    <div class="section-title">Unit Bisnis Utama</div>
    <p class="section-sub">Kelola setiap unit bisnis dengan cepat dari panel ini. Lihat status, ringkasan, dan akses tindakan yang relevan.</p>
    <div class="admin-cards">
      <div class="admin-card">
        <h3>Mardira Press</h3>
        <p>Laporan ringkas tentang produksi, cetak buku, layanan ISBN, dan pengiriman pesanan percetakan.</p>
        <a class="admin-action" href="units.php">Lihat Unit</a>
      </div>
      <div class="admin-card">
        <h3>Mardira Hub</h3>
        <p>Kelola reservasi coworking, inkubasi, serta jadwal pelatihan dan workshop.</p>
        <a class="admin-action" href="units.php">Lihat Unit</a>
      </div>
      <div class="admin-card">
        <h3>Mardira IT Consulting</h3>
        <p>Pengelolaan proyek software, layanan digital, serta request konsultasi finansial.</p>
        <a class="admin-action" href="units.php">Lihat Unit</a>
      </div>
    </div>
  </section>

  <footer class="footer">
    © <?= date("Y"); ?> Mardira Business Center. Semua hak cipta dilindungi.
  </footer>

  <script>
    const header = document.getElementById("site-header");
    const progressBar = document.getElementById("scroll-progress");
    const searchBtn = document.getElementById("searchBtn");
    const searchWrap = document.getElementById("searchWrap");
    const themeToggle = document.getElementById("themeToggle");

    window.addEventListener("scroll", () => {
      const y = window.scrollY;
      header.classList.toggle("scrolled", y > 20);
      const h = document.documentElement.scrollHeight - window.innerHeight;
      progressBar.style.width = (h > 0 ? (y / h) * 100 : 0) + "%";
    });

    searchBtn.addEventListener("click", () => {
      searchWrap.classList.toggle("open");
    });

    themeToggle.addEventListener("click", () => {
      document.body.classList.toggle("dark");
    });

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) entry.target.classList.add("in-view");
        });
      },
      { threshold: 0.15 },
    );

    document.querySelectorAll("[data-animate]").forEach((el) => observer.observe(el));
  </script>
</body>

</html>
