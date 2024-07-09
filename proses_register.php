<?php
include 'koneksi.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Lindungi dari SQL injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Hash password sebelum disimpan
$password = md5($password);

// Query untuk memasukkan data user ke dalam tabel users
$sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')";

if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil!";
    echo "<br><a href='login.php'>Login sekarang</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi database
$conn->close();
?>
