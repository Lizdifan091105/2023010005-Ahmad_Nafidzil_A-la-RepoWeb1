<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$query_categories = "SELECT * FROM categories";
$categories = mysqli_query($conn, $query_categories);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kategori_id = $_POST['kategori_id'];
    $ketersediaan = $_POST['ketersediaan'];



    $foto_new_name = ''; // Inisialisasi variabel foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_size = $_FILES['foto']['size'];
        $foto_ext = pathinfo($foto_name, PATHINFO_EXTENSION);

        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array(strtolower($foto_ext), $allowed_ext)) {
            $error = "Ekstensi file tidak valid! Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        }

        if ($foto_size > 5000000) {
            $error = "Ukuran file terlalu besar! Maksimum 5MB.";
        }

        if (empty($error)) {
            $targetDir = '../assets/img/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $foto_new_name = uniqid('', true) . '.' . $foto_ext;
            $foto_destination = $targetDir . $foto_new_name;

            if (!move_uploaded_file($foto_tmp, $foto_destination)) {
                $error = "Gagal mengunggah gambar.";
            }
        }
    }

    if (empty($error)) {
        $query = "INSERT INTO products (nama_produk, deskripsi, harga, kategori_id, foto, ketersediaan) 
        VALUES ('$nama_produk', '$deskripsi', '$harga', '$kategori_id', '$foto_new_name', '$ketersediaan')";

        if (mysqli_query($conn, $query)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Gagal menambahkan produk!";
        }
    }
}
?>
<?php include "header.php" ?> 

<script>
        function showPopup(event) {
            event.preventDefault();
            var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'), {
                keyboard: false
            });
            myModal.show();
        }

        function submitForm() {
            document.getElementById('product-form').submit();
        }
    </script>
<div class="container my-5">
    <h1 class="text-center text-dark mb-4">Tambah Produk</h1>
    <div class="card p-4">
        <form method="POST" id="product-form" enctype="multipart/form-data" class="text-dark">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" id="nama_produk" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="number" name="harga" class="form-control" id="harga" required>
            </div>
            <div class="mb-3">
    <label class="form-label">Ketersediaan</label><br>
    <div class="form-check">
        <input class="form-check-input bg-dark" type="radio" name="ketersediaan" id="tersedia" value="Tersedia" required>
        <label class="form-check-label  text-dark" for="tersedia">
            Tersedia
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input bg-dark" type="radio" name="ketersediaan" id="tidak-tersedia" value="Tidak Tersedia" required>
        <label class="form-check-label text-dark" for="tidak-tersedia">
            Tidak Tersedia
        </label>
    </div>
</div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select" id="kategori_id" required>
                    <option value="" selected>Pilih Kategori</option>
                    <?php while ($kategori = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Produk</label>
                <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <button type="button" class="btn btn-success w-100" onclick="showPopup(event)">Tambah</button>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Bootstrap -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menambahkan produk ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-success" onclick="submitForm()">Ya</button>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<?php include "footer.php" ?> 

