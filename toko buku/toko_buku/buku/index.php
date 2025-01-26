<?php
$listPenerbit = array();
$queryPenerbit = mysqli_query($conn, "SELECT * FROM penerbit");
while ($row = mysqli_fetch_assoc($queryPenerbit)) {
    $listPenerbit[$row['id']] = $row['nama'];
}
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

<h2>Data Buku</h2>
<article>Data Penerbit Polibang Jepara</article>
<button class="button" onclick="document.location='admin.php?page=buku/add.php'">TAMBAH</button>
<div>
    <table style="width:100%">
        <tr>
            <th>No</th>
            <th>ID Buku</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Penerbit</th>
            <th>Aksi </th>
        </tr>
        <?php
        include 'config/koneksi.php';
        $query = mysqli_query($conn, "SELECT * FROM buku");
        $no = 1;
        if ($query != null) :
            while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= $listPenerbit[$row['penerbit_id']] ?></td>
                    <td>
                        <a class="button" href="admin.php?page=buku/edit.php&id=<?= $row['id'] ?>">Edit</a> |
                        <a class="button button2" href="admin.php?page=buku/delete.php&id=<?= $row['id'] ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                    </td>
                </tr>
        <?php $no++;
            endwhile;
        endif; ?>
    </table>
</div>