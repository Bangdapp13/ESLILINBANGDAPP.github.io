<?php
session_start();
include 'koneksi.php';

// Ambil data dari form saran
$nama = $_POST['nama'];
$email = $_POST['email'];
$saran = $_POST['saran'];

// Lindungi dari SQL injection
$nama = mysqli_real_escape_string($conn, $nama);
$email = mysqli_real_escape_string($conn, $email);
$saran = mysqli_real_escape_string($conn, $saran);

// Query untuk menyimpan saran ke dalam tabel saran
$sql = "INSERT INTO saran (nama, email, saran) VALUES ('$nama', '$email', '$saran')";

if ($conn->query($sql) === TRUE) {
    echo '<div class="container mt-5"><div class="alert alert-success" role="alert">Saran berhasil dikirim.<a href="contact.php">Kembali ke halaman kontak.</a></div></div>';
} else {
    echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div></div>';
}

$conn->close();
?>
