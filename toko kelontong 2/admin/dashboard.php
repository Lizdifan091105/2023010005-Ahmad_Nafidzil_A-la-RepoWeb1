<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="add_product.php">Tambah Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="export.php">Export Data</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Selamat Datang di Dashboard Admin</h1>
        <p>Anda dapat mengelola produk di sini.</p>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>