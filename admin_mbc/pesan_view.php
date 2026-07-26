<?php
$title = "Detail Pesan - Admin";
$page = 'pesan';
include __DIR__ . '/header.php';
require_once __DIR__ . '/koneksi.php';

if (!isset($_GET['id'])) {
    echo '<div class="content-header"><h1>ID pesan tidak ditemukan</h1></div>';
    include __DIR__ . '/footer.php';
    exit;
}
$id = (int) $_GET['id'];

// ambil data
$res = mysqli_query($koneksi, "SELECT * FROM pesan WHERE id={$id} LIMIT 1");
if (!$row = mysqli_fetch_assoc($res)) {
    echo '<div class="content-header"><h1>Pesan tidak ditemukan</h1></div>';
    include __DIR__ . '/footer.php';
    exit;
}

// jika belum dibaca, tandai dibaca
if (!$row['is_read']) {
    mysqli_query($koneksi, "UPDATE pesan SET is_read=1 WHERE id={$id} LIMIT 1");
}

?>
<div class="content-header">
    <h1>Detail Pesan</h1>
    <p>Detail pesan dari pengirim.</p>
</div>

<div class="card-box">
    <h3><?= htmlspecialchars($row['subject']); ?></h3>
    <div style="margin:8px 0;color:#6b7280;">Dari: <strong><?= htmlspecialchars($row['nama']); ?></strong> &middot; <?= htmlspecialchars($row['email']); ?> &middot; <?= htmlspecialchars($row['created_at']); ?></div>
    <div style="white-space:pre-wrap;padding:12px;border:1px solid #f1f5f9;background:#fff; border-radius:8px;"><?= htmlspecialchars($row['pesan']); ?></div>

    <div style="margin-top:18px; display:flex; flex-wrap:wrap; gap:10px;">
        <a href="pesan.php" style="display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;border:1px solid #d1d5db;color:#1f2937;background:#f8fafc;text-decoration:none;">← Kembali</a>
        <a href="pesan_view.php?id=<?= $id; ?>&delete=1" onclick="return confirm('Hapus pesan ini?');" style="display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;border:1px solid #fecaca;color:#b91c1c;background:#fef2f2;text-decoration:none;">Hapus</a>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= rawurlencode($row['email']); ?>&su=<?= rawurlencode('Re: '.$row['subject']); ?>" target="_blank" style="display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;border:1px solid #c7d2fe;color:#1d4ed8;background:#eff6ff;text-decoration:none;">Balas di Gmail</a>
        <a href="mailto:<?= htmlspecialchars($row['email']); ?>?subject=Re: <?= rawurlencode($row['subject']); ?>" style="display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;border:1px solid #d1d5db;color:#1f2937;background:#f8fafc;text-decoration:none;">Balas via Email</a>
    </div>

    <?php
    // hapus lewat query param jika diminta
    if (isset($_GET['delete'])) {
        mysqli_query($koneksi, "DELETE FROM pesan WHERE id={$id} LIMIT 1");
        header('Location: pesan.php'); exit;
    }
    ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
