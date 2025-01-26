<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil data produk berdasarkan ID
$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Produk tidak ditemukan!");
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $harga = $_POST['harga'];
    $kategori_id = $_POST['kategori_id'];
    $ketersediaan = $_POST['ketersediaan'];

    // Jika ada file gambar baru diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_ext = pathinfo($foto_name, PATHINFO_EXTENSION);
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($foto_ext), $allowed_ext)) {
            $foto_new_name = uniqid('', true) . '.' . $foto_ext;
            $foto_destination = '../assets/img/' . $foto_new_name;

            // Hapus gambar lama jika ada
            if (!empty($product['foto']) && file_exists("../assets/img/" . $product['foto'])) {
                unlink("../assets/img/" . $product['foto']);
            }

            // Upload gambar baru
            if (move_uploaded_file($foto_tmp, $foto_destination)) {
                $query_update = "UPDATE products SET 
                    nama_produk = '$nama_produk', 
                    deskripsi = '$deskripsi', 
                    harga = '$harga', 
                    kategori_id = '$kategori_id', 
                    ketersediaan = '$ketersediaan',
                    foto = '$foto_new_name' 
                    WHERE id = $product_id";
            } else {
                $error = "Gagal mengunggah gambar.";
            }
        } else {
            $error = "Ekstensi file tidak valid.";
        }
    } else {
        // Jika tidak ada gambar baru diunggah
        $query_update = "UPDATE products SET 
            nama_produk = '$nama_produk', 
            deskripsi = '$deskripsi', 
            harga = '$harga', 
            kategori_id = '$kategori_id',
            ketersediaan = '$ketersediaan' 
            WHERE id = $product_id";
    }

    // Jalankan query update
    if (mysqli_query($conn, $query_update)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include "header.php" ?> 


<div class="container mt-5 text-dark">
    <div class="card shadow-sm border-0 p-4">
        <h1 class="text-center mb-4 fw-bold">Edit Produk</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($product['nama_produk']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= htmlspecialchars($product['deskripsi']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= $product['harga'] ?>" required>
            </div>

            <!-- Ketersediaan -->
            <label class="form-label fw-bold mb-3">Ketersediaan</label>
            <div class="form-check mb-2">
                <input class="form-check-input bg-primary border-2" type="radio" name="ketersediaan" id="tersedia" value="Tersedia" <?= $product['ketersediaan'] === 'Tersedia' ? 'checked' : '' ?> required>
                <label class="form-check-label text-dark fw-semibold" for="tersedia">
                    Tersedia
                </label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input bg-primary border-2" type="radio" name="ketersediaan" id="tidak-tersedia" value="Tidak Tersedia" <?= $product['ketersediaan'] === 'Tidak Tersedia' ? 'checked' : '' ?> required>
                <label class="form-check-label text-dark fw-semibold" for="tidak-tersedia">
                    Tidak Tersedia
                </label>
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select class="form-select" id="kategori_id" name="kategori_id" required>
                    <option value="" disabled>Pilih Kategori</option>
                    <?php
                    $categories = mysqli_query($conn, "SELECT * FROM categories");
                    while ($category = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?= $category['id'] ?>" <?= $product['kategori_id'] == $category['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['nama_kategori']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Gambar</label><br>
                <?php if (!empty($product['foto'])): ?>
                    <img src="../assets/img/<?= $product['foto'] ?>" alt="<?= htmlspecialchars($product['nama_produk']) ?>" class="img-thumbnail mb-3" width="150"><br>
                <?php endif; ?>
                <input type="file" class="form-control mt-2" id="foto" name="foto">
            </div>
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#confirmationModal">
              Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Perubahan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menyimpan perubahan ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="confirmSubmit">Ya, Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('confirmSubmit').addEventListener('click', function() {
    // Submit the form programmatically after confirmation
    document.querySelector('form').submit();
  });
</script>


<?php include "footer.php" ?>
