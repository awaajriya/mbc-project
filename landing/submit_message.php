<?php
// Handler untuk menyimpan pesan dari public
require_once __DIR__ . '/../admin_mbc/koneksi.php';

// create table if not exists
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama'] ?? ''));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email'] ?? ''));
    $subject = mysqli_real_escape_string($koneksi, trim($_POST['subject'] ?? ''));
    $pesan = mysqli_real_escape_string($koneksi, trim($_POST['pesan'] ?? ''));

    if ($nama && $email && $subject && $pesan) {
        $sql = "INSERT INTO pesan (nama, email, subject, pesan) VALUES ('{$nama}', '{$email}', '{$subject}', '{$pesan}')";
        mysqli_query($koneksi, $sql);
    }
}

header('Location: message.php?sent=1');
exit;
