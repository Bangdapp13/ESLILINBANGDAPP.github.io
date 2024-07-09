<?php
session_start();
include '../koneksi.php';

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

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk Terbaru - admin</title>
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
        <h2 class="mt-5 pt-5 display-5 fw-bold heading mb-3">Tambah <span>Produk Terbaru</span></h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Gambar Produk:</label>
                <input type="file" class="form-control" name="gambar" required>
            </div>
            <button type="submit" class="btn">Tambah Produk Lainnya</button>
        </form>

        <h2 class="mt-5">Daftar Produk</h2>
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
                $sql_produk_lainnya = "SELECT * FROM produk_lainnya";
                $result_produk_lainnya = $conn->query($sql_produk_lainnya);

                if ($result_produk_lainnya->num_rows > 0) {
                    while($row = $result_produk_lainnya->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["nama"] . '</td>';
                        echo '<td>Rp ' . number_format($row["harga"], 2, ',', '.') . '</td>';
                        echo '<td>' . $row["deskripsi"] . '</td>';
                        echo '<td><img src="../images/' . $row["gambar"] . '" alt="' . $row["nama"] . '" width="100"></td>';
                        echo '<td>';
                        echo '<form method="post" action="hapus_produk_lainnya.php" style="display:inline;">';
                        echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                        echo '<button type="submit" class="btn btn-danger">Hapus</button>';
                        echo '</form> ';
                        echo '<form method="post" action="selesai_produk_lainnya.php" style="display:inline;">';
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
</body>
</html>
