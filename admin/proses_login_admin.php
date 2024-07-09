<?php
session_start();
include '../koneksi.php';

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Lindungi dari SQL injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Query untuk mencari admin berdasarkan username dan password
$sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login berhasil
    $_SESSION['admin'] = $username;
    header('Location: index.php'); // Redirect ke halaman dashboard admin setelah login
    exit();
} else {
    // Login gagal
    echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Login gagal. Periksa kembali username dan password.</div></div>';
}

$conn->close();
?>
