<?php
include("./config/koneksi.php");
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css_qk1.css">
    <title>Input Data Buku</title>
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
            <?php
            $page = isset($_GET['page']) ? explode("?", $_GET['page']) : null;
            if (!empty($page) && is_file($page[0])) {
                include($page[0]);
            } else {
                echo "<h3>Selamat datang di halaman ADMIN</h3>";
                echo "<h3>Pilih menu ADMIN BUKU untuk manajemen stock buku</h3>";
                echo "<h3>Pilih menu ADMIN PENERBIT untuk manajemen penerbit</h3>";
            }
            ?>
        </div>
    </section>
    <footer>Created by Indra</footer>
</body>

</html>