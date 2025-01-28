
<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT products.id, products.nama_produk, products.deskripsi, products.harga, 
            categories.nama_kategori, products.foto, products.ketersediaan 
            FROM products 
            LEFT JOIN categories ON products.kategori_id = categories.id";

$products = mysqli_query($conn, $query);
?>

<?php include "header.php" ?> 

                
<div class="container-fluid my-4 px-4">
    <h1 class="text-center text-dark">Selamat Datang di Dashbord</h1>
        <div class="content p-3 shadow-sm">
        <!-- Tambahkan wrapper dengan overflow scroll -->
            <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Ketersediaan</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody  class="bg-white text-dark">
                    <?php while ($product = mysqli_fetch_assoc($products)): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['nama_produk']) ?></td>
                            <td><?= htmlspecialchars($product['nama_kategori'] ?: 'Tidak ada kategori') ?></td>
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

                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- Tambahkan Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk <strong id="productName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <!-- Tambahkan id di tombol konfirmasi -->
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Perbaikan Script -->
<script>
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const productId = button.getAttribute('data-id');
        const productName = button.getAttribute('data-nama');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        // Tetapkan nama produk ke modal
        document.getElementById('productName').textContent = productName;

        // Tetapkan link penghapusan ke tombol konfirmasi
        confirmDeleteBtn.href = `delete_produk.php?id=${productId}`;
    });
</script>


<?php include "footer.php" ?> 
