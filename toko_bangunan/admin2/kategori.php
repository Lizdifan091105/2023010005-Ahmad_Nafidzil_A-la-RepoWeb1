<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM categories";
$categories = mysqli_query($conn, $query);
?>
<?php include "header.php"?>
<div class="container my-5 text-dark">
    <h1 class="text-center">Manajemen Kategori</h1>
   
    <div class="table-responsive">
        <table class="table table-bordered text-dark">
            <thead class="table-dark">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 60%;">Nama Kategori</th>
                    <th style="width: 35%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($kategori = mysqli_fetch_assoc($categories)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $kategori['nama_kategori'] ?></td>
                    <td class="text-center">
                        <a href="edit_kategori.php?id=<?= $kategori['id'] ?>" class="btn btn-warning btn-sm me-2">Edit</a>
                        <!-- Tombol Hapus, memicu modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                data-id="<?= $kategori['id'] ?>" data-nama="<?= $kategori['nama_kategori'] ?>">
                            Hapus
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus kategori <strong id="categoryName"></strong>?
            </div>
            <div class="modal-footer">
                <form method="POST" id="deleteForm" action="delete_kategori.php">
                    <input type="hidden" name="id" id="categoryId">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Ambil tombol yang mengaktifkan modal
    var deleteButtons = document.querySelectorAll('[data-bs-toggle="modal"]');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Ambil id dan nama kategori dari atribut data
            var categoryId = button.getAttribute('data-id');
            var categoryName = button.getAttribute('data-nama');

            // Set nilai pada modal
            document.getElementById('categoryId').value = categoryId;
            document.getElementById('categoryName').textContent = categoryName;
        });
    });
</script>
<?php include "footer.php"?>

</body>
</html>
