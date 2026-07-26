<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin
        WHERE username='$username'
        AND password='$password'";

$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {

    $_SESSION['admin'] = $username;
    header("Location: dashboard.php");
    exit;

} else {

    echo "<script>
        alert('Username atau Password salah!');
        window.location='login.php';
    </script>";

}
?>