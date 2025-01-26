<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Validasi parameter ID
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID produk tidak valid atau tidak ditemukan.");
}

$product_id = intval($_GET['id']);

// Ambil data produk berdasarkan ID
$query = "SELECT foto FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $query);

// Periksa apakah produk ditemukan
if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);

    // Hapus file gambar jika ada
    if (!empty($product['foto']) && file_exists("../assets/img/" . $product['foto'])) {
        unlink("../assets/img/" . $product['foto']);
    }

    // Hapus data produk dari database
    $query_delete = "DELETE FROM products WHERE id = $product_id";
    if (mysqli_query($conn, $query_delete)) {
        // Redirect ke halaman dashboard dengan pesan sukses
        header("Location: dashboard.php?status=deleted");
        exit();
    } else {
        echo "Error saat menghapus data: " . mysqli_error($conn);
    }
} else {
    echo "Produk tidak ditemukan!";
}
?>
