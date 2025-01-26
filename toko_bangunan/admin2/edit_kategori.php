<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query_category = "SELECT * FROM categories WHERE id = $id";
$category = mysqli_fetch_assoc(mysqli_query($conn, $query_category));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = $_POST['nama_kategori'];

    $query = "UPDATE categories SET nama_kategori = '$nama_kategori' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: kategori.php");
        exit();
    } else {
        $error = "Gagal mengedit kategori!";
    }
}
?>
<?php include "header.php"?>
<div class="container my-5">
    <h1 class="text-center">Edit Kategori</h1>
    <form method="POST" id="editForm" class="mt-4">
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" 
                   value="<?= $category['nama_kategori'] ?>" required>
        </div>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#confirmationModal">Simpan</button>
    </form>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Perubahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menyimpan perubahan kategori ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="editForm">Ya, Simpan</button>
            </div>
        </div>
    </div>
</div>



<?php include "footer.php"?>

