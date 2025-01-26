<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $gambar = $_FILES['gambar']['name'];
    $target = "../uploads/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $query = "INSERT INTO produk (nama_produk, deskripsi, harga, gambar) VALUES ('$nama_produk', '$deskripsi', '$harga', '$gambar')";
    mysqli_query($conn, $query);
    header('Location: ../dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nama_produk" placeholder="Nama Produk" required>
        <textarea name="deskripsi" placeholder="Deskripsi Produk"></textarea>
        <input type="number" name="harga" placeholder="Harga Produk" required>
        <input type="file" name="gambar" required>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
