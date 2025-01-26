<?php
include 'config/db.php';

// Ambil data produk dari database
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Toko Kelontong</title>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Selamat Datang di Toko Kelontong</h1>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="login.php">Admin</a>
        </nav>
    </header>

    <!-- Banner -->
    <section class="banner">
        <h2>Toko Kelontong Terlengkap</h2>
        <p>Kami menyediakan berbagai kebutuhan rumah tangga dengan harga terjangkau!</p>
    </section>

    <!-- Produk -->
    <section class="produk">
        <h2>Produk Kami</h2>
        <div class="produk-container">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="produk-item">
                    <img src="uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_produk'] ?>">
                    <h3><?= $row['nama_produk'] ?></h3>
                    <p><?= $row['deskripsi'] ?></p>
                    <p><strong>Harga: Rp<?= number_format($row['harga'], 0, ',', '.') ?></strong></p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Toko Kelontong. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
