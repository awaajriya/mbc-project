<?php
$title = "Kelola Keunggulan - Admin MBC";
$page = "keunggulan";

include 'koneksi.php';

$createQuery = "CREATE TABLE IF NOT EXISTS keunggulan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon_class VARCHAR(100) NOT NULL DEFAULT 'fa-star',
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    posisi INT NOT NULL DEFAULT 0,
    aktif TINYINT(1) NOT NULL DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

mysqli_query($koneksi, $createQuery);

$judul = '';
$deskripsi = '';
$icon_class = 'fa-star';
$posisi = 0;
$aktif = 1;
$edit_id = null;

if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $icon_class = mysqli_real_escape_string($koneksi, $_POST['icon_class']);
    $posisi = (int) $_POST['posisi'];
    $aktif = isset($_POST['aktif']) ? 1 : 0;

    if (!empty($_POST['id'])) {
        $edit_id = (int) $_POST['id'];
        $query = "UPDATE keunggulan SET judul='$judul', deskripsi='$deskripsi', icon_class='$icon_class', posisi=$posisi, aktif=$aktif WHERE id=$edit_id";
        $message = 'Keunggulan berhasil diperbarui!';
    } else {
        $query = "INSERT INTO keunggulan (judul, deskripsi, icon_class, posisi, aktif) VALUES ('$judul', '$deskripsi', '$icon_class', $posisi, $aktif)";
        $message = 'Keunggulan berhasil ditambahkan!';
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$message'); window.location='keunggulan.php';</script>";
        exit;
    }
}

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM keunggulan WHERE id=$id");
    echo "<script>alert('Keunggulan berhasil dihapus!'); window.location='keunggulan.php';</script>";
    exit;
}

if (isset($_GET['edit'])) {
    $edit_id = (int) $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM keunggulan WHERE id=$edit_id LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);
        $judul = htmlspecialchars($item['judul']);
        $deskripsi = htmlspecialchars($item['deskripsi']);
        $icon_class = htmlspecialchars($item['icon_class']);
        $posisi = (int) $item['posisi'];
        $aktif = (int) $item['aktif'];
    }
}

$keunggulanResult = mysqli_query($koneksi, "SELECT * FROM keunggulan ORDER BY posisi ASC, id DESC");

include 'header.php';
?>

<div class="content-header">
    <h1>Kelola Keunggulan</h1>
    <p>Tambahkan, edit, atau hapus keunggulan yang akan ditampilkan di landing page.</p>
</div>

<div class="card-box" style="margin-bottom: 24px;">
    <div class="card-header">
        <h3><i class="fa-solid fa-star"></i> Form Keunggulan</h3>
        <?php if ($edit_id): ?>
            <a href="keunggulan.php" style="font-size:12px; color:var(--primary);">Tambah item baru</a>
        <?php endif; ?>
    </div>
    <form action="" method="POST" style="display: grid; gap: 16px;">
        <input type="hidden" name="id" value="<?= $edit_id ? $edit_id : ''; ?>">

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Judul Keunggulan</label>
                <input type="text" name="judul" value="<?= $judul; ?>" required placeholder="Contoh: Inovasi" style="width:100%; padding:10px; border:1px solid var(--border-color); border-radius:8px; margin-top:6px;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Urutan Tampilan</label>
                <input type="number" name="posisi" value="<?= $posisi; ?>" min="0" style="width:100%; padding:10px; border:1px solid var(--border-color); border-radius:8px; margin-top:6px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Ikon FontAwesome</label>
                <select name="icon_class" style="width:100%; padding:10px; border:1px solid var(--border-color); border-radius:8px; margin-top:6px;">
                    <option value="fa-lightbulb" <?= $icon_class === 'fa-lightbulb' ? 'selected' : ''; ?>>Lightbulb (fa-lightbulb)</option>
                    <option value="fa-star" <?= $icon_class === 'fa-star' ? 'selected' : ''; ?>>Star (fa-star)</option>
                    <option value="fa-crown" <?= $icon_class === 'fa-crown' ? 'selected' : ''; ?>>Crown (fa-crown)</option>
                    <option value="fa-rocket" <?= $icon_class === 'fa-rocket' ? 'selected' : ''; ?>>Rocket (fa-rocket)</option>
                    <option value="fa-chart-line" <?= $icon_class === 'fa-chart-line' ? 'selected' : ''; ?>>Chart Line (fa-chart-line)</option>
                    <option value="fa-handshake" <?= $icon_class === 'fa-handshake' ? 'selected' : ''; ?>>Handshake (fa-handshake)</option>
                </select>
                <small style="font-size:11px; color:var(--text-muted);">Pilih ikon untuk ditampilkan pada section Keunggulan.</small>
            </div>
            <div style="display:flex; flex-direction:column; gap:8px;">
                <label style="font-size: 13px; font-weight: 600;">Status Publikasi</label>
                <label><input type="checkbox" name="aktif" value="1" <?= $aktif ? 'checked' : ''; ?>> Tampilkan di landing page</label>
            </div>
        </div>

        <div>
            <label style="font-size: 13px; font-weight: 600;">Deskripsi</label>
            <textarea name="deskripsi" rows="4" required placeholder="Deskripsi singkat keunggulan..." style="width:100%; padding:10px; border:1px solid var(--border-color); border-radius:8px; margin-top:6px;"><?= $deskripsi; ?></textarea>
        </div>

        <div style="display:flex; gap:12px; align-items:center;">
            <button type="reset" style="background:#f8fafc; color:var(--text-dark); padding:10px 20px; border:1px solid var(--border-color); border-radius:8px; cursor:pointer;">Reset</button>
            <button type="submit" name="simpan" style="background:var(--primary); color:#fff; padding:10px 20px; border:none; border-radius:8px; font-weight:600; cursor:pointer;">Simpan Keunggulan</button>
        </div>
    </form>
</div>

<div class="card-box">
    <div class="card-header">
        <h3>Daftar Keunggulan</h3>
    </div>
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Ikon</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if ($keunggulanResult && mysqli_num_rows($keunggulanResult) > 0) {
                while ($row = mysqli_fetch_assoc($keunggulanResult)) {
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                        <td><i class="fa-solid <?= htmlspecialchars($row['icon_class']); ?>" style="font-size:18px;"></i></td>
                        <td><?= (int) $row['posisi']; ?></td>
                        <td><?= $row['aktif'] ? 'Aktif' : 'Tidak aktif'; ?></td>
                        <td>
                            <a href="keunggulan.php?edit=<?= $row['id']; ?>" style="color: #2563eb; margin-right: 12px;"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="keunggulan.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Hapus keunggulan ini?')" style="color: #ef4444;"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="6" style="text-align:center;">Belum ada data keunggulan.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
