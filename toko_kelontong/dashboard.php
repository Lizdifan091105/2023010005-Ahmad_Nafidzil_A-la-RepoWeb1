<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <a href="admin/add_product.php">Tambah Produk</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td><?= $row['deskripsi'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><img src="uploads/<?= $row['gambar'] ?>" width="100"></td>
            <td>
                <a href="admin/edit_product.php?id=<?= $row['id_produk'] ?>">Edit</a> |
                <a href="admin/delete_product.php?id=<?= $row['id_produk'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
