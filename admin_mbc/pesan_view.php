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

    <div style="margin-top:12px;">
        <a href="pesan.php" style="margin-right:8px;">← Kembali</a>
        <a href="pesan_view.php?id=<?= $id; ?>&delete=1" onclick="return confirm('Hapus pesan ini?');" style="color:#ef4444;margin-right:8px;">Hapus</a>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= rawurlencode($row['email']); ?>&su=<?= rawurlencode('Re: '.$row['subject']); ?>" target="_blank" style="margin-right:8px;">Balas di Gmail</a>
        <a href="mailto:<?= htmlspecialchars($row['email']); ?>?subject=Re: <?= rawurlencode($row['subject']); ?>">Balas via Email</a>
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
