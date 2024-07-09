<?php
include '../koneksi.php';

session_start();
// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}

// Ambil user_id dari parameter URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Query untuk menghapus user berdasarkan ID
    $sql_delete_user = "DELETE FROM users WHERE id='$user_id'";

    if ($conn->query($sql_delete_user) === TRUE) {
        // Redirect kembali ke halaman data_user.php setelah berhasil menghapus
        header('Location: data_users.php');
        exit();
    } else {
        echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Error saat menghapus user: ' . $conn->error . '</div></div>';
    }
} else {
    echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Parameter tidak valid.</div></div>';
}

$conn->close();
?>
