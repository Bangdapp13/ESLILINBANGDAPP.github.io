<?php
include '../koneksi.php';

$id = $_POST['id'];

$sql = "DELETE FROM produk_lainnya WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil dihapus. <a href='tambah_produk_lainnya.php'>Kembali ke halaman tambah produk lainnya</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
