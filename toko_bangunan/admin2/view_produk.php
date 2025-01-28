<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM products";
$products = mysqli_query($conn, $query);

?>
<?php include "header.php" ?> 

<div class="container-fluid my-4 px-4">
    <div class="content bg-white p-3 rounded shadow-sm">
        <!-- Tambahkan wrapper dengan overflow scroll -->
        <div class="table-responsive">
        <h1 class="text-center">Manajemen Daftar</h1>

            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Ketersediaan</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = mysqli_fetch_assoc($products)): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['nama_produk']) ?></td>
                            <td>Rp<?= number_format($product['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($product['deskripsi']) ?></td>
                            <td><?= htmlspecialchars($product['ketersediaan']) ?></td>

                            <td>
                                <?php if ($product['foto']): ?>
                                    <img src="../assets/img/<?= htmlspecialchars($product['foto']) ?>" 
                                         alt="<?= htmlspecialchars($product['nama_produk']) ?>" 
                                         class="img-fluid rounded" style="max-width: 100px; height: auto;">
                                <?php else: ?>
                                    <p>No image</p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_produk.php?id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                    data-id="<?= $product['id'] ?>" data-nama="<?= htmlspecialchars($product['nama_produk']) ?>">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <?php include "footer.php" ?> 
