<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

if (!isset($_SESSION['keranjang_lainnya'])) {
    $_SESSION['keranjang_lainnya'] = [];
}

// Proses tambah produk ke keranjang
if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produk WHERE id='$id'";
    $result = $conn->query($sql);
    $produk = $result->fetch_assoc();

    if (isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id]['jumlah'] += 1;
    } else {
        $_SESSION['keranjang'][$id] = [
            'nama' => $produk['nama'],
            'harga' => $produk['harga'],
            'deskripsi' => $deskripsi['deskripsi'],
            'gambar' => $produk['gambar'],
            'jumlah' => 1
        ];
    }
}

// Proses tambah produk lainnya ke keranjang
if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah_lainnya') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produk_lainnya WHERE id='$id'";
    $result = $conn->query($sql);
    $produk = $result->fetch_assoc();

    if (isset($_SESSION['keranjang_lainnya'][$id])) {
        $_SESSION['keranjang_lainnya'][$id]['jumlah'] += 1;
    } else {
        $_SESSION['keranjang_lainnya'][$id] = [
            'nama' => $produk['nama'],
            'harga' => $produk['harga'],
            'deskripsi' => $deskripsi['deskripsi'],
            'gambar' => $produk['gambar'],
            'jumlah' => 1
        ];
    }
}

// Proses hapus produk dari keranjang
if (isset($_GET['aksi']) && ($_GET['aksi'] == 'hapus' || $_GET['aksi'] == 'hapus_lainnya')) {
    $id = $_GET['id'];
    if ($_GET['aksi'] == 'hapus') {
        unset($_SESSION['keranjang'][$id]);
    } else {
        unset($_SESSION['keranjang_lainnya'][$id]);
    }
}

// Proses ubah jumlah produk di keranjang saat tombol tambah dan kurang diklik
if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $action = $_POST['action']; // 'tambah' atau 'kurang'

    if (isset($_SESSION['keranjang'][$id])) {
        if ($action == 'tambah') {
            $_SESSION['keranjang'][$id]['jumlah'] += 1;
        } elseif ($action == 'kurang' && $_SESSION['keranjang'][$id]['jumlah'] > 1) {
            $_SESSION['keranjang'][$id]['jumlah'] -= 1;
        }
    } elseif (isset($_SESSION['keranjang_lainnya'][$id])) {
        if ($action == 'tambah') {
            $_SESSION['keranjang_lainnya'][$id]['jumlah'] += 1;
        } elseif ($action == 'kurang' && $_SESSION['keranjang_lainnya'][$id]['jumlah'] > 1) {
            $_SESSION['keranjang_lainnya'][$id]['jumlah'] -= 1;
        }
    }
}

// Hitung total harga
$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['harga'] * $item['jumlah'];
}
foreach ($_SESSION['keranjang_lainnya'] as $item) {
    $total += $item['harga'] * $item['jumlah'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
        .jumlah-input {
            display: flex;
            align-items: center;
        }
        .jumlah-btn {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 0;
            margin: 0 5px;
            font-size: 16px;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
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
        span {
        color: #068CDC;
        text-shadow: 22px 3px solid #000;
      }
      .heading {
        color: #01649F;
      }
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
    </style>
</head>
<body style="background: #FFFFFF;">
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container my-5">
    <h2 class="mt-5 pt-5 heading display-5 fw-bold">Keranjang <span>Belanja</span></h2>
        <div class="row">
            <?php
            if (!empty($_SESSION['keranjang']) || !empty($_SESSION['keranjang_lainnya'])) {
                foreach ($_SESSION['keranjang'] as $id => $item) {
                    echo '<div class="col-md-4 mt-4">';
                    echo '<div class="card produk-img">';
                    echo '<img src="images/' . $item['gambar'] . '" class="card-img-top" alt="' . $item['nama'] . '">';
                    echo '<div class="card-body mt-3">';
                    echo '<h5 class="card-title">' . $item['nama'] . '</h5>';
                    echo '<p class="card-text">' . $item["deskripsi"] . '</p>';
                    echo '<p class="card-text">Harga: Rp ' . number_format($item['harga'], 2, ',', '.') . '</p>';

                    // Form untuk menambah dan mengurangi jumlah
                    echo '<form method="post" action="keranjang.php">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<div class="jumlah-input">';
                    echo '<button type="submit" class="btn jumlah-btn" name="action" value="kurang">-</button>';
                    echo '<input type="number" class="form-control text-center" name="jumlah" value="' . $item['jumlah'] . '" min="1" readonly>';
                    echo '<button type="submit" class="btn jumlah-btn" name="action" value="tambah">+</button>';
                    echo '</div>';
                    echo '</form>';

                    echo '<a href="keranjang.php?aksi=hapus&id=' . $id . '" class="btn btn-danger mt-2">Hapus</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                foreach ($_SESSION['keranjang_lainnya'] as $id => $item) {
                    echo '<div class="col-md-4 mt-4">';
                    echo '<div class="card produk-img">';
                    echo '<img src="images/' . $item['gambar'] . '" class="card-img-top" alt="' . $item['nama'] . '">';
                    echo '<div class="card-body mt-3">';
                    echo '<h5 class="card-title">' . $item['nama'] . '</h5>';
                    echo '<p class="card-text">' . $item["deskripsi"] . '</p>';
                    echo '<p class="card-text">Harga: Rp ' . number_format($item['harga'], 2, ',', '.') . '</p>';

                    // Form untuk menambah dan mengurangi jumlah
                    echo '<form method="post" action="keranjang.php">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<div class="jumlah-input">';
                    echo '<button type="submit" class="btn btn-primary jumlah-btn" name="action" value="kurang">-</button>';
                    echo '<input type="number" class="form-control text-center" name="jumlah" value="' . $item['jumlah'] . '" min="1" readonly>';
                    echo '<button type="submit" class="btn btn-primary jumlah-btn" name="action" value="tambah">+</button>';
                    echo '</div>';
                    echo '</form>';

                    echo '<a href="keranjang.php?aksi=hapus_lainnya&id=' . $id . '" class="btn btn-danger mt-2">Hapus</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '<div class="col-md-12 mt-4 text-center">';
                echo '<button type="button" class="btn btn-lg" data-toggle="modal" data-target="#paymentModal">Sub Total: Rp ' . number_format($total, 2, ',', '.') . '</button>';
                echo '</div>';
            } else {
                echo '<div class="col-md-12">';
                echo '<p style="colo:#3B3B3C">Keranjang belanja kosong.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Pilih Metode Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="proses_pembayaran.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">Cash on Delivery (COD)</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
