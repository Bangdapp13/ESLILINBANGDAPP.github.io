<?php
include '../koneksi.php';

session_start();
// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $target = "../images/" . basename($gambar);

    $sql = "INSERT INTO produk_lainnya (nama, harga, gambar, deskripsi) VALUES ('$nama', '$harga', '$gambar', '$deskripsi')";
    if ($conn->query($sql) === TRUE && move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        echo "Produk lainnya berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
