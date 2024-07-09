<?php 
session_start();
// Periksa apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>
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
    </style>
</head>
<body style="background: #FFFFFF;">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="mt-5 pt-5 heading display-5 fw-bold">Kirim <span>Saran</span></h2>
        <form action="proses_kirim_saran.php" method="POST">
        <div class="form-group">
        <label for="nama">Nama:</label><br>
        <input class="form-control" type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
        <label for="email">Email:</label><br>
        <input class="form-control" type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
        <label for="saran">Saran:</label><br>
        <textarea class="form-control" id="saran" name="saran" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn">Kirim</button>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
