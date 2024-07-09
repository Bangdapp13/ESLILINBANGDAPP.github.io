<?php
include '../koneksi.php';

session_start();
// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}

// Ambil saran_id dari parameter URL
if (isset($_GET['saran_id'])) {
    $saran_id = $_GET['saran_id'];

    // Query untuk menghapus saran berdasarkan ID
    $sql_delete_saran = "DELETE FROM saran WHERE id='$saran_id'";

    if ($conn->query($sql_delete_saran) === TRUE) {
        // Redirect kembali ke halaman view_saran.php setelah berhasil menghapus
        header('Location: view_saran.php');
        exit();
    } else {
        echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Error saat menghapus saran: ' . $conn->error . '</div></div>';
    }
} else {
    echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Parameter tidak valid.</div></div>';
}

$conn->close();
?>
