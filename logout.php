<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Logout successfully'); window.location.href='index.php';</script>";
?>
