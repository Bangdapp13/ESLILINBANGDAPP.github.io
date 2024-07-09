<?php
include '../koneksi.php';

$id = $_POST['id'];

$sql = "UPDATE produk_lainnya SET status='selesai' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil ditandai sebagai selesai. <a href='tambah_produk_lainnya.php'>Kembali ke halaman tambah produk terbaru</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
