<?php
include 'koneksi.php';

session_start();
// Periksa apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$produks = [];
$keyword = '';

// Periksa apakah ada pencarian yang dikirimkan
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // Query untuk mencari produk berdasarkan keyword
    $sql_produk = "SELECT * FROM produk WHERE nama LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'";
} else {
    // Query untuk mengambil semua produk jika tidak ada pencarian
    $sql_produk = "SELECT * FROM produk";
}

$result_produk = $conn->query($sql_produk);

// Periksa apakah query berhasil dieksekusi
if ($result_produk) {
    // Periksa apakah ada produk yang ditemukan
    if ($result_produk->num_rows > 0) {
        while ($row_produk = $result_produk->fetch_assoc()) {
            $produks[] = $row_produk;
        }
    } else {
        echo "Tidak ada produk yang ditemukan.";
    }
} else {
    echo "Error: " . $conn->error;
}

// Menutup koneksi database
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .btn {
        background: #01649F !important;
        color: white;
      }
      .btn:hover {
        background: #01649F !important;
        color: white;
      }
      .btn-ungu {
        background: #068CDC !important; 
      }
      .btn-ungu:hover {
        background: #068CDC !important; 
      }
      .btn-danger {
        background: #dc3545 !important;
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
<body style="background: #FFFFFF;">
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-5">
    <h2 class="mt-5 pt-5 heading display-5 fw-bold">Daftar <span>Produk</span></h2>
        
        <!-- Form Pencarian -->
        <form action="produk.php" method="GET" class="form-inline mb-5">
            <input type="text" name="keyword" class="form-control mr-sm-2" placeholder="Cari produk..." value="<?php echo htmlspecialchars($keyword); ?>">
            <button type="submit" class="btn">Cari</button>
            <?php if (!empty($keyword)): ?>
                <a href="produk.php" class="btn btn-ungu ml-2">Lihat Semua</a>
            <?php endif; ?>
        </form>
        
        <!-- Tampilkan daftar produk -->
        <div class="row my-5">
            <?php foreach ($produks as $produk): ?>
                <div class="col-md-3 mb-4">
                    <div class="card produk-img">
                        <img src="images/<?php echo $produk['gambar']; ?>" class="card-img-top" alt="<?php echo $produk['nama']; ?>">
                        <div class="card-body mt-3">
                            <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                            <p class="card-text">Rp <?php echo number_format($produk['harga'], 2, ',', '.'); ?></p>
                            <a href="keranjang.php?aksi=tambah&id=<?php echo $produk['id']; ?>" class="btn">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    

    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
