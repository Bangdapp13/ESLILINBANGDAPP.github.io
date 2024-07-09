<?php
include '../koneksi.php';

session_start();
// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$gambar = $_FILES['gambar']['name'];

// Jalur absolut untuk direktori target
$target_dir = realpath(dirname(__FILE__) . '/../images/') . '/';
$target_file = $target_dir . basename($gambar);

if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO produk (nama, harga, deskripsi, gambar, status) VALUES ('$nama', '$harga', '$deskripsi', '$gambar', 'belum selesai')";

    if ($conn->query($sql) === TRUE) {
        header("Location: tambah_produk.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Sorry, there was an error uploading your file.";
}

$conn->close();
?>
