<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "mbc_project";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>