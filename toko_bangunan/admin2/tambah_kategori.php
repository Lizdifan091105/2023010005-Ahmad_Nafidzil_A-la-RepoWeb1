<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = $_POST['nama_kategori'];

    $query = "INSERT INTO categories (nama_kategori) VALUES ('$nama_kategori')";
    if (mysqli_query($conn, $query)) {
        header("Location: kategori.php");
        exit();
    } else {
        $error = "Gagal menambahkan kategori!";
    }
}
?>
<?php include "header.php" ?> 

<div class="container my-5">
    <h1 class="text-center text-dark">Tambah Kategori</h1>
    <form method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="nama_kategori" class="form-label text-dark">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" required>
        </div>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <button type="submit" class="btn btn-success w-100 mb-3">Tambah</button>
    </form>
   
</div>
<?php include "footer.php" ?> 

