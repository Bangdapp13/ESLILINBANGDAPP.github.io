<?php
session_start();
include 'koneksi.php';

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Lindungi dari SQL injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Hash password sebelum memeriksa ke database
$password = md5($password);

// Simpan username dan password di session
$_SESSION['login_username'] = $username;
$_SESSION['login_password'] = $_POST['password']; // Menyimpan password asli tanpa hash

// Query untuk mencari user berdasarkan username dan password
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Login berhasil
    $_SESSION['username'] = $username;
    // Hapus session login_username dan login_password setelah login berhasil
    unset($_SESSION['login_username']);
    unset($_SESSION['login_password']);
    header('Location: index.php'); // Redirect ke halaman utama setelah login
    exit();
} else {
    // Login gagal
    echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Login gagal. Periksa kembali username dan password.</div></div>';
}

$conn->close();
?>
