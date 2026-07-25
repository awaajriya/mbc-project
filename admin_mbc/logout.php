<?php
session_start();

session_unset();
session_destroy();

header("Location: login.php");
// atau header("Location: ../index.php");
exit;
?>