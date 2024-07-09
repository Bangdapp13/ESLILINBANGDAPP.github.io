<?php
include '../koneksi.php';

$id = $_POST['id'];

$sql = "UPDATE produk SET status='selesai' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil ditandai sebagai selesai. <a href='tambah_produk.php'>Kembali ke halaman tambah produk lainnya</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
