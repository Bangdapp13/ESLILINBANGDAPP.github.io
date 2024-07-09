<?php
session_start();
include '../koneksi.php';

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php'); // Redirect ke halaman login jika belum login sebagai admin
    exit();
}

// Query untuk mengambil semua data user kecuali admin
$sql = "SELECT * FROM users WHERE role='user'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: #FFFFFF">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>


    <div class="container mt-5">
        <h2 class="mt-5 pt-5">Data Pengguna</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $no . '</td>';
                        echo '<td>' . $row['username'] . '</td>';
                        echo '<td>';
                        echo '<a href="proses_hapus_user.php?user_id=' . $row['id'] . '" class="btn btn-danger btn-sm">Hapus</a>';
                        echo '</td>';
                        echo '</tr>';
                        $no++;
                    }
                } else {
                    echo '<tr><td colspan="4">Tidak ada data user.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
