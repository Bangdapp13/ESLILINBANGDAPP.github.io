<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-lg border-bottom" style="background: #01649F !important">
    <a class="navbar-brand mx-3 text-white" href="index.php">Eslilin Bangdap</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'tambah_produk.php') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="tambah_produk.php">Tambah Produk Lainnya</a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'tambah_produk_lainnya.php') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="tambah_produk_lainnya.php">Tambah Produk Terbaru</a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'data_users.php') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="data_users.php">Data User</a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'view_saran.php') ? 'active' : ''; ?>">
                <a class="nav-link text-white" href="view_saran.php">Lihat Saran</a>
            </li>
            <div class="nav-item"><a href="logout_admin.php" class="btn btn-danger mx-5 ">Logout</a></div>
        </ul>
    </div>
</nav>
<!-- Jika belum dimuat, tambahkan script ini setelah jQuery dan Popper.js -->
<script>
    // Script untuk menambahkan kelas active ke navbar link yang sesuai
    $(document).ready(function() {
        $('.navbar-nav .nav-item').on('click', function() {
            $('.navbar-nav').find('.active').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
