<?php
$title = "Kelola Proyek Unggulan - Admin MBC";
$page  = "projects";

include 'header.php';
$koneksi = mysqli_connect("localhost", "root", "", "mbc_project");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// --- PROSES TAMBAH DATA ---
if (isset($_POST['tambah'])) {
    $sub_unit   = mysqli_real_escape_string($koneksi, $_POST['sub_unit']);
    $judul      = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi  = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $link       = mysqli_real_escape_string($koneksi, $_POST['link']);
    $bg_color   = mysqli_real_escape_string($koneksi, $_POST['bg_color']);
    $icon_class = mysqli_real_escape_string($koneksi, $_POST['icon_class']);

    $query = "INSERT INTO proyek_unggulan (sub_unit, judul, deskripsi, link, bg_color, icon_class) 
              VALUES ('$sub_unit', '$judul', '$deskripsi', '$link', '$bg_color', '$icon_class')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Proyek berhasil ditambahkan!'); window.location='projects.php';</script>";
    }
}

// --- PROSES HAPUS DATA ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM proyek_unggulan WHERE id=$id");
    echo "<script>alert('Proyek berhasil dihapus!'); window.location='projects.php';</script>";
}
?>

<div class="content-header">
    <h1>Kelola Proyek Unggulan</h1>
    <p>Data di bawah ini akan tampil otomatis di Landing Page pengunjung.</p>
</div>

<!-- FORM TAMBAH DATA -->
<div class="card-box" style="margin-bottom: 24px;">
    <div class="card-header">
        <h3><i class="fa-solid fa-plus-circle"></i> Tambah Proyek Baru</h3>
    </div>
    <form action="" method="POST" style="display: grid; gap: 16px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Sub-Unit / Badge</label>
                <input type="text" name="sub_unit" required placeholder="Contoh: MARDIRA PRESS" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Judul Proyek</label>
                <input type="text" name="judul" required placeholder="Contoh: Jurnal Ilmiah Terakreditasi" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
            <div>
                <label style="font-size: 13px; font-weight: 600;">Warna Cards Header</label>
                <input type="color" name="bg_color" value="#0f172a" style="width: 100%; height: 42px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px; cursor: pointer;">
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Ikon Card</label>
                <select name="icon_class" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
                    <option value="fa-book">Buku (fa-book)</option>
                    <option value="fa-desktop">Komputer (fa-desktop)</option>
                    <option value="fa-star">Bintang (fa-star)</option>
                    <option value="fa-rocket">Roket (fa-rocket)</option>
                </select>
            </div>
            <div>
                <label style="font-size: 13px; font-weight: 600;">Link Detail</label>
                <input type="text" name="link" value="#" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;">
            </div>
        </div>

        <div>
            <label style="font-size: 13px; font-weight: 600;">Deskripsi</label>
            <textarea name="deskripsi" rows="3" required placeholder="Deskripsi proyek..." style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 6px;"></textarea>
        </div>

        <button type="submit" name="tambah" style="background: var(--primary); color: #fff; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; width: fit-content;">Simpan & Publikasikan</button>
    </form>
</div>

<!-- TABEL DAFTAR DATA -->
<div class="card-box">
    <div class="card-header">
        <h3>Daftar Proyek Unggulan</h3>
    </div>
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Sub-Unit</th>
                <th>Judul Proyek</th>
                <th>Ikon & Warna</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $res = mysqli_query($koneksi, "SELECT * FROM proyek_unggulan ORDER BY id DESC");
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong style="color:#eab308;"><?= htmlspecialchars($row['sub_unit']); ?></strong></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td>
                        <span style="display:inline-block; width:16px; height:16px; background:<?= $row['bg_color']; ?>; border-radius:4px;"></span>
                        <i class="fa-solid <?= $row['icon_class']; ?>" style="margin-left: 6px;"></i>
                    </td>
                    <td>
                        <a href="projects.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Hapus data ini?')" style="color: #ef4444;"><i class="fa-solid fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php 
                }
            } else {
                echo '<tr><td colspan="5" style="text-align:center;">Belum ada data proyek.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>