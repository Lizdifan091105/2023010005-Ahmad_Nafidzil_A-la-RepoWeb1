<?php

?>
<style>
    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 10px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .button2 {
        background-color: #f44336;
        font-size: 12px;
    }
</style>
<h2>Data Penerbit</h2>
<article>Data Penerbit Polibang Jepara</article>
<button class="button" onclick="document.location='admin.php?page=penerbit/add.php'">TAMBAH</button>
<div>
    <table style="width:100%">
        <tr>
            <th>No</th>
            <th>ID Penerbit</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Telepon</th>
            <th>Aksi </th>
        </tr>
        <?php
        include 'config/koneksi.php';
        $query = mysqli_query($conn, "SELECT * FROM penerbit");
        $no = 1;
        if ($query != null) :
            while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['kota'] ?></td>
                    <td><?= $row['telepon'] ?></td>
                    <td>
                        <a class="button" href="admin.php?page=penerbit/edit.php&id=<?= $row['id'] ?>">Edit</a> |
                        <a class="button button2" href="admin.php?page=penerbit/delete.php&id=<?= $row['id'] ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                    </td>
                </tr>
        <?php $no++;
            endwhile;
        endif; ?>
    </table>
</div>