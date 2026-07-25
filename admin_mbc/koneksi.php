<?php
$koneksi = mysqli_connect("localhost", "root", "", "mbc_project");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>