<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $metode_pembayaran = $_POST['metode_pembayaran'];
    // Proses pembayaran sesuai dengan metode pembayaran yang dipilih

    // Bersihkan keranjang setelah pembayaran
    unset($_SESSION['keranjang']);

    echo "Pembayaran berhasil dengan metode: " . $metode_pembayaran . ". <a href='index.php'>Kembali ke halaman utama</a>";
} else {
    header("Location: keranjang.php");
}
?>
