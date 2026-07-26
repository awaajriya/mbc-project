<?php
$title = "Pesan Masuk - Admin";
$page = 'pesan';
require_once __DIR__ . '/koneksi.php';

// pastikan tabel ada
$create = "CREATE TABLE IF NOT EXISTS pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    pesan TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($koneksi, $create);

// tindakan: hapus atau tandai
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM pesan WHERE id={$id} LIMIT 1");
    header('Location: pesan.php'); exit;
}
if (isset($_GET['mark_read'])) {
    $id = (int) $_GET['mark_read'];
    mysqli_query($koneksi, "UPDATE pesan SET is_read=1 WHERE id={$id} LIMIT 1");
    header('Location: pesan.php'); exit;
}

$res = mysqli_query($koneksi, "SELECT * FROM pesan ORDER BY created_at DESC");
include __DIR__ . '/header.php';

?>
<div class="content-header">
    <h1>Pesan Masuk</h1>
    <p>Daftar pesan yang dikirim oleh pengunjung situs.</p>
</div>

<div class="card-box">
    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($res)): ?>
                <tr style="background: <?= $row['is_read'] ? '#ffffff' : '#fff9ed'; ?>">
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['subject']); ?></td>
                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="pesan_view.php?id=<?= $row['id']; ?>" style="display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:8px;border:1px solid #d1d5db;color:#1f2937;text-decoration:none;transition:0.2s;background:#f8fafc;">Lihat</a>
                        <?php if (!$row['is_read']): ?>
                            <a href="pesan.php?mark_read=<?= $row['id']; ?>" style="display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:8px;border:1px solid #60a5fa;color:#2563eb;text-decoration:none;transition:0.2s;background:#eff6ff;">Tandai Dibaca</a>
                        <?php endif; ?>
                        <a href="pesan.php?delete=<?= $row['id']; ?>" onclick="return confirm('Hapus pesan ini?');" style="display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:8px;border:1px solid #fecaca;color:#b91c1c;text-decoration:none;transition:0.2s;background:#fef2f2;">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/footer.php'; ?>
