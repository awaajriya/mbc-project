<?php
$title = "Kelola Statistik - Admin MBC";
$page = "statistik";

include 'koneksi.php';

$createQuery = "CREATE TABLE IF NOT EXISTS statistik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    angka BIGINT NOT NULL DEFAULT 0,
    label VARCHAR(255) NOT NULL,
    posisi INT NOT NULL DEFAULT 0,
    aktif TINYINT(1) NOT NULL DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($koneksi, $createQuery);

$angka = 0;
$label = '';
$posisi = 0;
$aktif = 1;
$edit_id = null;

if (isset($_POST['simpan'])) {
    $angka = (int) $_POST['angka'];
    $label = mysqli_real_escape_string($koneksi, $_POST['label']);
    $posisi = (int) $_POST['posisi'];
    $aktif = isset($_POST['aktif']) ? 1 : 0;

    if (!empty($_POST['id'])) {
        $edit_id = (int) $_POST['id'];
        $query = "UPDATE statistik SET angka=$angka, label='$label', posisi=$posisi, aktif=$aktif WHERE id=$edit_id";
        $message = 'Statistik berhasil diperbarui!';
    } else {
        $query = "INSERT INTO statistik (angka, label, posisi, aktif) VALUES ($angka, '$label', $posisi, $aktif)";
        $message = 'Statistik berhasil ditambahkan!';
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$message'); window.location='statistik.php';</script>";
        exit;
    }
}

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM statistik WHERE id=$id");
    echo "<script>alert('Statistik berhasil dihapus!'); window.location='statistik.php';</script>";
    exit;
}

if (isset($_GET['edit'])) {
    $edit_id = (int) $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM statistik WHERE id=$edit_id LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);
        $angka = (int) $item['angka'];
        $label = htmlspecialchars($item['label']);
        $posisi = (int) $item['posisi'];
        $aktif = (int) $item['aktif'];
    }
}

$statistikResult = mysqli_query($koneksi, "SELECT * FROM statistik ORDER BY posisi ASC, id DESC");

include 'header.php';
?>

<div class="content-header">
    <h1>Kelola Statistik</h1>
    <p>Kelola angka statistik yang akan ditampilkan di landing page.</p>
</div>

<div class="card-box" style="margin-bottom: 24px;">
    <div class="card-header">
        <h3><i class="fa-solid fa-chart-simple"></i> Form Statistik</h3>
        <?php if ($edit_id): ?>
            <a href="statistik.php" style="font-size:12px; color:var(--primary);">Tambah statistik baru</a>
        <?php endif; ?>
    </div>
    <form action="" method="POST" style="display: grid; gap: 16px;">
        <input type="hidden" name="id" value="<?= $edit_id ? $edit_id : ''; ?>">

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Angka</label>
                <input type="number" name="angka" value="<?= $angka; ?>" required placeholder="Contoh: 250" style="width:100%; padding:10px; border:1px solid var(--border-color); border-radius:8px; margin-top:6px;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Urutan Tampilan</label>
                <input type="number" name="posisi" value="<?= $posisi; ?>" min="0" style="width:100%; padding:10px; border:1px solid var(--border-color); border-radius:8px; margin-top:6px;">
            </div>
        </div>

        <div>
            <label style="font-size: 13px; font-weight: 600;">Label Statistik</label>
            <input type="text" name="label" value="<?= $label; ?>" required placeholder="Contoh: Mitra Bisnis" style="width:100%; padding:10px; border:1px solid var(--border-color); border-radius:8px; margin-top:6px;">
        </div>

        <div style="display:flex; gap:12px; align-items:center;">
            <label style="font-size: 13px; font-weight: 600; margin-right: 16px;"><input type="checkbox" name="aktif" value="1" <?= $aktif ? 'checked' : ''; ?>> Tampilkan</label>
            <button type="submit" name="simpan" style="background:var(--primary); color:#fff; padding:10px 20px; border:none; border-radius:8px; font-weight:600; cursor:pointer;">Simpan Statistik</button>
        </div>
    </form>
</div>

<div class="card-box">
    <div class="card-header">
        <h3>Daftar Statistik</h3>
    </div>
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Angka</th>
                <th>Label</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if ($statistikResult && mysqli_num_rows($statistikResult) > 0) {
                while ($row = mysqli_fetch_assoc($statistikResult)) {
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= number_format($row['angka'], 0, ',', '.'); ?></strong></td>
                        <td><?= htmlspecialchars($row['label']); ?></td>
                        <td><?= (int) $row['posisi']; ?></td>
                        <td><?= $row['aktif'] ? 'Aktif' : 'Tidak aktif'; ?></td>
                        <td>
                            <a href="statistik.php?edit=<?= $row['id']; ?>" style="color: #2563eb; margin-right: 12px;"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="statistik.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Hapus statistik ini?')" style="color: #ef4444;"><i class="fa-solid fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="6" style="text-align:center;">Belum ada data statistik.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
