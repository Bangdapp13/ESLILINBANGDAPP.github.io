<?php 
session_start();
include 'koneksi.php';
// Periksa apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login sebagai admin
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
    <title>Penjualan Es Lilin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
<body style="background: #FFFFFF;" >
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container-fluid" id="home">
    <div class="mb-1 mt-5 bg-awal rounded-5 text-white">
      <div class="container-fluid py-5">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./images/1.png" width="100%" height="400" class="rounded shadow-lg" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <img src="./images/2.png" width="100%" height="400" class="rounded shadow-lg" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <img src="./images/3.png" width="100%" height="400" class="rounded shadow-lg" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
      </div>
    </div>
  </div>
  </div>



<div class="container">
        <h2 class="mt-5 pt-5 text-center heading display-5 fw-bold">Produk <span>Terbaru</span></h2>
        <div class="row my-5">
            <?php
            if ($result_produk_lainnya->num_rows > 0) {
                while($row = $result_produk_lainnya->fetch_assoc()) {
                    echo '<div class="col-md-4 mt-4">';
                    echo '<div class="card produk-img">';
                    echo '<img src="images/' . $row['gambar'] . '" class="card-img-top" alt="' . $row['nama'] . '">';
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

        <h2 class="mt-5 pt-5 text-center heading display-5 fw-bold">Produk <span>Lainnya</span></h2>
        <div class="row my-5 pb-5">
            <?php
            if ($result_produk->num_rows > 0) {
                while($row = $result_produk->fetch_assoc()) {
                    echo '<div class="col-md-4 mt-4">';
                    echo '<div class="card produk-img">';
                    echo '<img src="images/' . $row['gambar'] . '" class="card-img-top" alt="' . $row['nama'] . '">';
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

    <div class="container-fluid my-5 py-5 mx-auto" style="background-color: #01649F;">
    <div class="row text-white justify-content-center">
      <div class="col-md-3">
        <img src="./images/profil.jpeg" alt="Hero Image" width="300" height="300" class="img-fluid rounded">
      </div>
      <div class="col-md-7 d-flex align-items-center">
        <div class="px-4">
          <h1 class="mb-5">Chalange !<br>Berhasil minta fotbar Bangdap</h1>
          <a href="#" class="btn btn-ungu btn-lg">Gratis Eslilin!!</a>
        </div>
      </div>
    </div>
  </div>

  
  <div class="container-fluid my-5 py-5" id="Gallary">
    <div class="container">
             <h1 class="text-center my-5 heading display-5 fw-bold">Galeri <span>Kami</span></h1>
   
             <div class="row" style="margin-top: 30px;">
             
                <div class="col-xs-4 col-md-4 py-3 py-md-0">
                   <div class="card">
                     <img src="./images/galeri1.jpg" alt="">
                   </div>
                 </div>
                 <div class="col-xs-4 col-md-4 py-3 py-md-0">
                   <div class="card">
                     <img src="./images/galeri2.jpg" alt="">
                   </div>
                 </div>
                 <div class="col-xs-4 col-md-4 py-3 py-md-0">
                   <div class="card">
                     <img src="./images/galeri3.jpg" alt="">
                   </div>
                 </div>
              </div>
           </div>
   </div>
  


   <div class="container-fluid bg-ungu text-light">
    <footer class="py-5 px-5">
      <div class="row">
        <div class="col-3 col-md-2 mb-3">
          <h5>Link Cepat</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="index.php" class="nav-link p-0 text-white">Beranda</a></li>
            <li class="nav-item mb-2"><a href="produk.php" class="nav-link p-0 text-white">Produk</a></li>
            <li class="nav-item mb-2"><a href="keranjang.php" class="nav-link p-0 text-white">Keranjang</a></li>
            <li class="nav-item mb-2"><a href="contact.php" class="nav-link p-0 text-white">Kontak</a></li>
          </ul>
        </div>

        <div class="col-3 col-md-2 mb-3">
          <h5>Tentang Kami</h5>
           <p class="lead">Kami menjual berbagai varian rasa eslilin.</p>
        </div>
  
        <div class="col-3 col-md-2 mb-3 mx-5">
          <h5>Sosial Media</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Instagram</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Facebook</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Twitter</a></li>
          </ul>
        </div>
  
        <div class="col-md-3 offset-md-1 mb-3">
          <form>
            <h5>Subscribe to our newsletter</h5>
            <p>Monthly digest of what's new and exciting from us.</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
              <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
              <button class="btn btn-ungu" type="button">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </footer>
  </div>

    <!-- Bootstrap Icons JS (tidak perlu jika tidak menggunakan ikon Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
