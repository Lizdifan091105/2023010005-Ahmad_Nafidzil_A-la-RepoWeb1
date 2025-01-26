<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Pastikan ID ada di dalam POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Hapus kategori berdasarkan ID
    $query = "DELETE FROM categories WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: kategori.php");
    } else {
        echo "Gagal menghapus kategori!";
    }
} else {
    echo "ID kategori tidak ditemukan.";
}
?>
