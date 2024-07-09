<?php
session_start();
session_unset();
session_destroy();
header('Location: login_admin.php'); // Redirect ke halaman login admin setelah logout
exit();
?>
