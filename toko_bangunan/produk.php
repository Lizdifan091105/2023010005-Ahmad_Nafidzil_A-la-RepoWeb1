<?php
require 'config/db.php';

// Ambil semua kategori untuk filter
$query_kategori = "SELECT * FROM categories";
$categories = mysqli_query($conn, $query_kategori);

// Filter produk berdasarkan kategori (jika ada)
$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : null;
if ($kategori_id) {
    $query_produk = "SELECT * FROM products WHERE kategori_id = $kategori_id";
} else {
    $query_produk = "SELECT * FROM products";
}
$products = mysqli_query($conn, $query_produk);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Toko Bangunan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Toko Bangunan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <?php if (isset($_SESSION['login'])): ?>
                        <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="admin/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <h1 class="text-center mb-4">Produk Kami</h1>
        <form method="GET" class="mb-4">
            <select name="kategori_id" class="form-select w-50 mx-auto" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <?php while ($kategori = mysqli_fetch_assoc($categories)): ?>
                    <option value="<?= $kategori['id'] ?>" <?= $kategori_id == $kategori['id'] ? 'selected' : '' ?>>
                        <?= $kategori['nama_kategori'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
        <div class="row">
            <?php while ($product = mysqli_fetch_assoc($products)): ?>
                <div class="col-md-3">
                    <div class="card">
                        <!-- Gambar Produk -->
                        <img src="assets/img/<?= $product['foto'] ?>" class="card-img-top" alt="<?= $product['nama_produk'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['nama_produk'] ?></h5>
                            <p class="card-text">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

