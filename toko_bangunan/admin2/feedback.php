<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM feedback";
$feedcback = mysqli_query($conn, $query);
?>
<?php include "header.php"?>

<div class="container mt-5">
    <h1 class="text-center">Daftar Feedback</h1>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($feedcback->num_rows > 0): ?>
            <?php $no = 1; while ($row = $feedcback->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['pesan']); ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td>
                        <a href="hapus_feedback.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus feedback ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "footer.php"?>
