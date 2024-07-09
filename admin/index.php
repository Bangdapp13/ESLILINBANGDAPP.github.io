<?php 
session_start();
include '../koneksi.php';

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}

// Fetch produk
$sql_produk = "SELECT * FROM produk";
$result_produk = $conn->query($sql_produk);

// Fetch produk lainnya
$sql_produk_lainnya = "SELECT * FROM produk_lainnya";
$result_produk_lainnya = $conn->query($sql_produk_lainnya);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Penjualan Es Lilin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .btn, .bg-ungu {
        background: #01649F !important;
        color: white;
      }
      .btn:hover {
        background: #01649F !important;
        color: white;
      }
      .btn-danger {
        background: #dc3545 !important;
      }
      .btn-ungu {
        background: #068CDC !important; 
      }
      .btn-ungu:hover {
        background: #068CDC !important; 
      }
      .card {
        background: #f2f2f2;
      }
      span {
        color: #068CDC;
        text-shadow: 22px 3px solid #000;
      }
      .heading {
        color: #01649F;
      }
      .produk-img {
            overflow: hidden;
        }
        .produk-img img {
            transition: transform 0.5s ease;
        }
        .produk-img:hover img {
            transform: scale(1.1);
        }
    </style>
</head>
<body style="background: #FFFFFF">
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="my-5 pt-5 display-5 fw-bold heading text-center">Produk <span>Terbaru</span></h2>
        <div class="row">
            <?php
            if ($result_produk_lainnya->num_rows > 0) {
                while($row = $result_produk_lainnya->fetch_assoc()) {
                    echo '<div class="col-md-4 mt-4">';
                    echo '<div class="card produk-img">';
                    echo '<img src="../images/' . $row['gambar'] . '" class="card-img-top" alt="' . $row['nama'] . '">';
                    echo '<div class="card-body mt-3">';
                    echo '<h5 class="card-title">' . $row['nama'] . '</h5>';
                    echo '<p class="card-text">' . $row["deskripsi"] . '</p>';
                    echo '<p class="card-text">Harga: Rp ' . number_format($row['harga'], 2, ',', '.') . '</p>';
                    echo '<a href="keranjang.php?aksi=tambah_lainnya&id=' . $row['id'] . '" class="btn">Beli Sekarang</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'Tidak ada produk lainnya tersedia.';
            }
            ?>
        </div>
        <h2 class="my-5 pt-5 display-5 fw-bold heading text-center">Produk <span>Lainnya</span></h2>
        <div class="row">
            <?php
            if ($result_produk->num_rows > 0) {
                while($row = $result_produk->fetch_assoc()) {
                    echo '<div class="col-md-4 mt-4">';
                    echo '<div class="card produk-img">';
                    echo '<img src="../images/' . $row['gambar'] . '" class="card-img-top" alt="' . $row['nama'] . '">';
                    echo '<div class="card-body mt-3">';
                    echo '<h5 class="card-title">' . $row['nama'] . '</h5>';
                    echo '<p class="card-text">' . $row["deskripsi"] . '</p>';
                    echo '<p class="card-text">Harga: Rp ' . number_format($row['harga'], 2, ',', '.') . '</p>';
                    echo '<a href="keranjang.php?aksi=tambah&id=' . $row['id'] . '" class="btn">Beli Sekarang</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'Tidak ada produk tersedia.';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
