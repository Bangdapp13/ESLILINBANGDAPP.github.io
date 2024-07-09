<?php
include '../koneksi.php';

$id = $_POST['id'];

$sql = "DELETE FROM produk WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil dihapus. <a href='tambah_produk.php'>Kembali ke halaman tambah produk</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
