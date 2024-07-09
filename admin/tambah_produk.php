<?php 
session_start();
// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Lainnya - Admin</title>
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
      .btn-success {
        background: green !important;
      }
    </style>
</head>
<body style="background: #FFFFFF">
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="mt-5 mb-3 pt-5 display-5 fw-bold">Tambah <span>Produk Lainnya</span></h1>
        <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Produk</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn">Tambah Produk</button>
        </form>

        <h2 class="mt-5">Daftar Produk Lainnya</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../koneksi.php';
                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["nama"] . '</td>';
                        echo '<td>Rp ' . number_format($row["harga"], 2, ',', '.') . '</td>';
                        echo '<td>' . $row["deskripsi"] . '</td>';
                        echo '<td><img src="../images/' . $row["gambar"] . '" alt="' . $row["nama"] . '" width="100"></td>';
                        echo '<td>';
                        echo '<form method="post" action="hapus_produk.php" style="display:inline;">';
                        echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                        echo '<button type="submit" class="btn btn-danger">Hapus</button>';
                        echo '</form> ';
                        echo '<form method="post" action="selesai_produk.php" style="display:inline;">';
                        echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                        echo '<button type="submit" class="btn btn-success">Selesai</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">Tidak ada produk yang ditemukan.</td></tr>';
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
