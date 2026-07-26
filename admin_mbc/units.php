<?php
$title = "Kelola Unit Bisnis - Admin MBC";
$page  = "units";

$koneksi = mysqli_connect("localhost", "root", "", "mbc_project");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function parse_unit_meta($raw) {
    $meta = json_decode($raw, true);
    if (!is_array($meta)) {
        return [
            'nomor_urut' => '',
            'kategori' => '',
            'judul_tombol' => 'Pelajari Lebih Lanjut',
            'link_tombol' => '#',
            'warna' => '#0d6efd',
            'icon_class' => 'fa-book',
            'layanan' => '',
            'status' => 'Aktif'
        ];
    }
    return array_merge([
        'nomor_urut' => '',
        'kategori' => '',
        'judul_tombol' => 'Pelajari Lebih Lanjut',
        'link_tombol' => '#',
        'warna' => '#0d6efd',
        'icon_class' => 'fa-book',
        'layanan' => '',
        'status' => 'Aktif'
    ], $meta);
}

$nama_unit = '';
$nomor_urut = '';
$kategori = '';
$judul_tombol = 'Pelajari Lebih Lanjut';
$link_tombol = '#';
$warna = '#0d6efd';
$icon_class = 'fa-book';
$layanan = '';
$status = 'Aktif';
$edit_id = null;

if (isset($_POST['simpan'])) {
    $nama_unit = mysqli_real_escape_string($koneksi, $_POST['nama_unit']);
    $nomor_urut = mysqli_real_escape_string($koneksi, $_POST['nomor_urut']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $judul_tombol = mysqli_real_escape_string($koneksi, $_POST['judul_tombol']);
    $link_tombol = mysqli_real_escape_string($koneksi, $_POST['link_tombol']);
    $warna = mysqli_real_escape_string($koneksi, $_POST['warna']);
    $icon_class = mysqli_real_escape_string($koneksi, $_POST['icon_class']);
    $layanan = mysqli_real_escape_string($koneksi, $_POST['layanan']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    $meta = json_encode([
        'nomor_urut' => $nomor_urut,
        'kategori' => $kategori,
        'judul_tombol' => $judul_tombol,
        'link_tombol' => $link_tombol,
        'warna' => $warna,
        'icon_class' => $icon_class,
        'layanan' => $layanan,
        'status' => $status
    ], JSON_UNESCAPED_UNICODE);

    if (!empty($_POST['id_unit'])) {
        $edit_id = (int) $_POST['id_unit'];
        $query = "UPDATE unit_bisnis SET nama_unit='$nama_unit', deskripsi='$meta', link='$link_tombol' WHERE id_unit=$edit_id";
    } else {
        $query = "INSERT INTO unit_bisnis (nama_unit, deskripsi, link) VALUES ('$nama_unit', '$meta', '$link_tombol')";
    }

    if (mysqli_query($koneksi, $query)) {
        header('Location: units.php');
        exit;
    }
}

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM unit_bisnis WHERE id_unit=$id");
    header('Location: units.php');
    exit;
}

if (isset($_GET['edit'])) {
    $edit_id = (int) $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM unit_bisnis WHERE id_unit=$edit_id LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $unit = mysqli_fetch_assoc($result);
        $meta = parse_unit_meta($unit['deskripsi']);
        $nama_unit = htmlspecialchars($unit['nama_unit']);
        $nomor_urut = htmlspecialchars($meta['nomor_urut']);
        $kategori = htmlspecialchars($meta['kategori']);
        $judul_tombol = htmlspecialchars($meta['judul_tombol']);
        $link_tombol = htmlspecialchars($meta['link_tombol']);
        $warna = htmlspecialchars($meta['warna']);
        $icon_class = htmlspecialchars($meta['icon_class']);
        $layanan = htmlspecialchars($meta['layanan']);
        $status = htmlspecialchars($meta['status']);
    }
}

$units = mysqli_query($koneksi, "SELECT * FROM unit_bisnis ORDER BY id_unit DESC");

include 'header.php';
?>

<div class="content-header">
    <h1>Kelola Unit Bisnis</h1>
    <p>Tambah atau edit unit bisnis yang akan ditampilkan di website.</p>
</div>

<div class="card-box" style="margin-bottom: 24px;">
    <div class="card-header">
        <h3><i class="fa-solid fa-plus-circle"></i> Form Unit Bisnis</h3>
        <?php if ($edit_id): ?>
            <a href="units.php" style="font-size:12px; color:var(--primary);">Buat unit baru</a>
        <?php endif; ?>
    </div>
    <form action="" method="POST" style="display: grid; gap: 16px;"> 
        <input type="hidden" name="id_unit" value="<?= $edit_id ? $edit_id : ''; ?>">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Nama Unit Bisnis</label>
                <input type="text" name="nama_unit" value="<?= $nama_unit; ?>" required placeholder="Contoh: Mardira Press" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Nomor Urut</label>
                <input type="text" name="nomor_urut" value="<?= $nomor_urut; ?>" placeholder="Contoh: 01" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Kategori</label>
                <input type="text" name="kategori" value="<?= $kategori; ?>" placeholder="Contoh: Publishing" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Judul Tombol</label>
                <input type="text" name="judul_tombol" value="<?= $judul_tombol; ?>" placeholder="Contoh: Pelajari Lebih Lanjut" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Link Tombol</label>
                <input type="text" name="link_tombol" value="<?= $link_tombol; ?>" placeholder="Contoh: /unit/mardira-press" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Warna (Badge / Ikon)</label>
                <input type="color" name="warna" value="<?= $warna; ?>" style="width: 100%; height: 42px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px; cursor: pointer;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Ikon</label>
                <select name="icon_class" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
                    <option value="fa-book" <?= $icon_class === 'fa-book' ? 'selected' : ''; ?>>Buku (fa-book)</option>
                    <option value="fa-desktop" <?= $icon_class === 'fa-desktop' ? 'selected' : ''; ?>>Komputer (fa-desktop)</option>
                    <option value="fa-star" <?= $icon_class === 'fa-star' ? 'selected' : ''; ?>>Bintang (fa-star)</option>
                    <option value="fa-rocket" <?= $icon_class === 'fa-rocket' ? 'selected' : ''; ?>>Roket (fa-rocket)</option>
                </select>
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Status</label>
                <div style="display:flex; gap: 12px; margin-top: 8px;">
                    <label style="font-size: 13px;"><input type="radio" name="status" value="Aktif" <?= $status === 'Aktif' ? 'checked' : ''; ?>> Aktif</label>
                    <label style="font-size: 13px;"><input type="radio" name="status" value="Nonaktif" <?= $status === 'Nonaktif' ? 'checked' : ''; ?>> Nonaktif</label>
                </div>
            </div>
        </div>

        <div>
            <label style="font-size: 13px; font-weight: 600;">Daftar Layanan / Fitur</label>
            <textarea name="layanan" rows="4" placeholder="Tulis setiap layanan pada baris baru" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;"><?= $layanan; ?></textarea>
        </div>

        <div style="display:flex; gap: 12px; align-items:center;">
            <button type="reset" style="background:#f8fafc; color:var(--text-dark); padding: 10px 20px; border: 1px solid var(--border-color); border-radius: 8px; cursor: pointer;">Reset</button>
            <button type="submit" name="simpan" style="background: var(--primary); color: #fff; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Simpan Unit Bisnis</button>
        </div>
    </form>
</div>

<div class="card-box">
    <div class="card-header">
        <h3>Daftar Unit Bisnis</h3>
        <div style="font-size:12px; color:var(--text-muted);">Kelola semua unit bisnis yang ditampilkan.</div>
    </div>
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Unit</th>
                <th>Kategori</th>
                <th>Ikon</th>
                <th>Link Tombol</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if ($units && mysqli_num_rows($units) > 0) {
                while ($row = mysqli_fetch_assoc($units)) {
                    $meta = parse_unit_meta($row['deskripsi']);
                    $buttonLink = $row['link'] ?: '#';
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>
                    <strong><?= htmlspecialchars($row['nama_unit']); ?></strong>
                    <?php if (!empty($meta['nomor_urut'])): ?>
                        <div style="font-size:11px; color:var(--text-muted);">No: <?= htmlspecialchars($meta['nomor_urut']); ?></div>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($meta['kategori']); ?></td>
                <td><i class="fa-solid <?= htmlspecialchars($meta['icon_class']); ?>" style="margin-right:6px;"></i> <?= htmlspecialchars($meta['icon_class']); ?></td>
                <td><a href="<?= htmlspecialchars($buttonLink); ?>" target="_blank"><?= htmlspecialchars($meta['judul_tombol']); ?></a></td>
                <td><?= htmlspecialchars($meta['status']); ?></td>
                <td>
                    <a href="units.php?edit=<?= $row['id_unit']; ?>" style="color:var(--text-muted); margin-right:10px;"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="units.php?hapus=<?= $row['id_unit']; ?>" onclick="return confirm('Hapus unit ini?')" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="7" style="text-align:center;">Belum ada data unit bisnis.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
