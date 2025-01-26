<?php
include("./config/koneksi.php");
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css_qk1.css">
    <title>Daftar Buku Pengadaan</title>
</head>

<body>
    <section>
        <h1>Buku Polibang Jepara</h1>
        <nav>
            <a href="index.php">HOME</a>
            <a href="admin.php?page=buku/index.php">ADMIN BUKU</a>
            <a href="admin.php?page=penerbit/index.php">ADMIN PENERBIT</a>
            <a href="pengadaan.php">PENGADAAN</a>

        </nav>
        <div class="container">
            <table border="1" cellpadding="1" cellspacing="1" style="width:100%">
                <thead>
                    <tr>
                        <th>ID Buku</th>
                        <th>Nama Buku</th>
                        <th>Penerbit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT `buku`.*, `penerbit`.`nama` AS `namaPenerbit` FROM `buku` LEFT JOIN `penerbit` ON `buku`.`penerbit_id` = `penerbit`.`id` ORDER BY `buku`.`stok` ASC");
                    while ($row = mysqli_fetch_assoc($query)) :
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['namaPenerbit'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
    <footer>Created by Indra</footer>
</body>

</html>