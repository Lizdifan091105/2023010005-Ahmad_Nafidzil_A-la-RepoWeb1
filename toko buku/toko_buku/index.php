<?php
include("./config/koneksi.php");
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css_qk1.css">
    <title>Daftar Data Buku </title>
</head>

<body>
    <section>
        <h1>Buku Polibang Jepara</h1>
        <nav>
            <a href="index.php">HOME</a>
            <a href="admin.php">ADMIN</a>
            <a href="pengadaan.php">PENGADAAN</a>

        </nav>
        <main>
            <div class="container">
                <!-- Title Tabel -->
                <H1>Data Buku</H1>
                <!-- Pencarian Data -->
                <div class="col-sm-1">
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                </div>
                <table id="myTabel" border="1" cellpadding="1" cellspacing="1" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Buku</th>
                            <th>Kategori</th>
                            <th>Nama Buku</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Penerbit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT `buku`.*, `penerbit`.`nama` AS `namaPenerbit` FROM `buku` LEFT JOIN `penerbit` ON `buku`.`penerbit_id` = `penerbit`.`id`");
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['kategori'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['harga'] ?></td>
                                <td><?= $row['stok'] ?></td>
                                <td><?= $row['namaPenerbit'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    <!-- Algoritma Pencarian -->
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTabel");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


</body>

</html>