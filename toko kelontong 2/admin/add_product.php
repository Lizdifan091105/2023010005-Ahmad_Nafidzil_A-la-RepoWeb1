<?php
include '../config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Pastikan untuk mengupload gambar

    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Tambah Produk</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Produk</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar URL</label>
                <input type="text" class="form-control" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>