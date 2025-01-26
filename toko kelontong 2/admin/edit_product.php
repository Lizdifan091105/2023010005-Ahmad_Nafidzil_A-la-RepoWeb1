<?php
include '../config.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST[' name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";
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
    <title>Edit Produk</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Produk</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" name="name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" name="description" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar URL</label>
                <input type="text" class="form-control" name="image" value="<?php echo $product['image']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>