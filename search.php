<?php
$title = 'Hasil Pencarian';
$q = trim($_GET['q'] ?? '');

function getRedirectUrlForQuery($q, $koneksi) {
    $lower = mb_strtolower($q);
    $sectionMap = [
        'beranda' => '/index.php#home',
        'home' => '/index.php#home',
        'utama' => '/index.php#home',
        'homepage' => '/index.php#home',
        'tentang' => '/index.php#about',
        'about' => '/index.php#about',
        'profil' => '/index.php#about',
        'team' => '/index.php#about',
        'unit' => '/index.php#units',
        'bisnis' => '/index.php#units',
        'publishing' => '/index.php#units',
        'press' => '/index.php#units',
        'hub' => '/index.php#units',
        'inkubasi' => '/index.php#units',
        'incubation' => '/index.php#units',
        'konsultasi' => '/index.php#units',
        'consulting' => '/index.php#units',
        'pelatihan' => '/index.php#units',
        'training' => '/index.php#units',
        'workshop' => '/index.php#units',
        'proyek' => '/index.php#projects',
        'project' => '/index.php#projects',
        'studi' => '/index.php#projects',
        'case' => '/index.php#projects',
        'case study' => '/index.php#projects',
        'portfolio' => '/index.php#projects',
        'keunggulan' => '/index.php#why',
        'advantage' => '/index.php#why',
        'mengapa' => '/index.php#why',
        'why' => '/index.php#why',
        'alasan' => '/index.php#why',
        'kontak' => '/index.php#contact',
        'contact' => '/index.php#contact',
        'hubungi' => '/index.php#contact',
        'login' => '/admin_mbc/login.php',
        'masuk' => '/admin_mbc/login.php',
    ];

    foreach ($sectionMap as $keyword => $url) {
        if (strpos($lower, $keyword) !== false) {
            return $url;
        }
    }

    $like = '%' . mysqli_real_escape_string($koneksi, $q) . '%';

    $queries = [
        "SELECT 1 FROM proyek_unggulan WHERE sub_unit LIKE '{$like}' OR judul LIKE '{$like}' OR deskripsi LIKE '{$like}' OR link LIKE '{$like}' LIMIT 1" => '/index.php#projects',
        "SELECT 1 FROM keunggulan WHERE aktif=1 AND (judul LIKE '{$like}' OR deskripsi LIKE '{$like}') LIMIT 1" => '/index.php#why',
        "SELECT 1 FROM unit_bisnis WHERE nama_unit LIKE '{$like}' OR deskripsi LIKE '{$like}' OR link LIKE '{$like}' LIMIT 1" => '/index.php#units',
    ];

    foreach ($queries as $sql => $url) {
        $result = mysqli_query($koneksi, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            return $url;
        }
    }

    return '';
}

$redirectUrl = '';
if ($q !== '') {
    require_once __DIR__ . '/admin_mbc/koneksi.php';
    $redirectUrl = getRedirectUrlForQuery($q, $koneksi);
    if ($redirectUrl !== '') {
        header('Location: ' . $redirectUrl);
        exit;
    }
}

include __DIR__ . '/landing/header.php';
?>
<section class="section-pad">
  <div class="container" style="max-width:900px;margin:40px auto;">
    <div class="card-box">
      <div class="content-header">
        <h1>Hasil Pencarian</h1>
        <p>Hasil untuk: <strong><?= htmlspecialchars($q ?: '-'); ?></strong></p>
      </div>

      <?php if ($q === ''): ?>
        <p>Masukkan kata kunci untuk mencari.</p>
      <?php else: ?>
        <?php
        require_once __DIR__ . '/admin_mbc/koneksi.php';
        $like = '%' . mysqli_real_escape_string($koneksi, $q) . '%';
        $results = [];

        // projek unggulan
        $r1 = mysqli_query($koneksi, "SELECT id, sub_unit, judul AS title, deskripsi AS snippet, link, icon_class FROM proyek_unggulan WHERE sub_unit LIKE '{$like}' OR judul LIKE '{$like}' OR deskripsi LIKE '{$like}' OR link LIKE '{$like}' OR icon_class LIKE '{$like}' ORDER BY id DESC LIMIT 50");
        if ($r1) {
          while ($row = mysqli_fetch_assoc($r1)) {
            $row['type'] = 'project';
            $row['icon'] = 'fa-solid fa-folder-open';
            $results[] = $row;
          }
        }

        // keunggulan
        $r2 = mysqli_query($koneksi, "SELECT id, judul AS title, deskripsi AS snippet, icon_class FROM keunggulan WHERE aktif=1 AND (judul LIKE '{$like}' OR deskripsi LIKE '{$like}' OR icon_class LIKE '{$like}') ORDER BY posisi ASC LIMIT 50");
        if ($r2) {
          while ($row = mysqli_fetch_assoc($r2)) {
            $row['type'] = 'advantage';
            $row['icon'] = 'fa-solid fa-star';
            $results[] = $row;
          }
        }

        // unit bisnis (nama unit, deskripsi JSON termasuk 'layanan')
        $r3 = mysqli_query($koneksi, "SELECT id_unit AS id, nama_unit AS title, deskripsi AS snippet, link FROM unit_bisnis WHERE nama_unit LIKE '{$like}' OR deskripsi LIKE '{$like}' OR link LIKE '{$like}' ORDER BY id_unit DESC LIMIT 50");
        if ($r3) {
          while ($row = mysqli_fetch_assoc($r3)) {
            $row['type'] = 'unit';
            $row['icon'] = 'fa-solid fa-building';
            $results[] = $row;
          }
        }

        // menu statis (cari kata pada nama menu)
        $menus = [
          ['title' => 'Beranda', 'href' => '/index.php#home'],
          ['title' => 'Tentang', 'href' => '/index.php#about'],
          ['title' => 'Unit Bisnis', 'href' => '/index.php#units'],
          ['title' => 'Mengapa MBC', 'href' => '/index.php#why'],
          ['title' => 'Proyek', 'href' => '/index.php#projects'],
          ['title' => 'Kontak', 'href' => '/index.php#contact'],
          ['title' => 'Login', 'href' => '/admin_mbc/login.php']
        ];
        foreach ($menus as $m) {
          if (stripos($m['title'], $q) !== false) {
            $results[] = ['type' => 'menu', 'title' => $m['title'], 'snippet' => '', 'link' => $m['href']];
          }
        }

        if (empty($results)) {
          echo '<p>Tidak ditemukan hasil untuk kata kunci tersebut.</p>';
        } else {
          echo '<div style="display:grid;gap:12px;">';
          foreach ($results as $r) {
            $title = htmlspecialchars($r['title']);
            $snippet = htmlspecialchars(mb_strimwidth($r['snippet'] ?? '', 0, 220, '...'));
            $type = $r['type'];
            $iconClass = htmlspecialchars($r['icon'] ?? 'fa-solid fa-magnifying-glass');
            if ($type === 'project') {
              $href = htmlspecialchars($r['link'] ?? '/index.php#projects');
              $badge = 'Proyek Unggulan';
            } elseif ($type === 'unit') {
              $href = htmlspecialchars($r['link'] ?? '/index.php#units');
              $badge = 'Unit Bisnis';
            } elseif ($type === 'advantage') {
              $href = '/index.php#why';
              $badge = 'Keunggulan';
            } else { // menu
              $href = htmlspecialchars($r['link'] ?? '/');
              $badge = 'Menu';
            }
            echo "<div style='padding:12px;border:1px solid #edf2f7;border-radius:8px;display:flex;justify-content:space-between;gap:12px;align-items:flex-start;'>";
            echo "<div style='display:flex;gap:12px;align-items:flex-start;'>";
            echo "<div style='width:36px;height:36px;flex-shrink:0;display:flex;align-items:center;justify-content:center;border-radius:10px;background:#f1f5f9;color:#1e4e96;font-size:16px;'><i class='{$iconClass}'></i></div>";
            echo "<div><div style='font-weight:700;margin-bottom:6px;'><a href='{$href}'>{$title}</a></div>";
            if ($snippet !== '') echo "<div style='color:#6b7280;font-size:14px'>{$snippet}</div>";
            echo "</div></div>";
            echo "<div style='text-align:right;min-width:120px'><div style='font-size:12px;color:#475569;background:#f1f5f9;padding:6px 8px;border-radius:6px'>{$badge}</div><div style='margin-top:8px'><a href='{$href}' class='proj-link'>Buka →</a></div></div>";
            echo "</div>";
          }
          echo '</div>';
        }
        ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/landing/footer.php'; ?>
