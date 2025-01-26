<?php
include("config/koneksi.php");
if (isset($_POST['submit'])) {
    $sql = mysqli_query($conn, "UPDATE penerbit SET id = '{$_POST['id']}', nama = '{$_POST['nama']}', alamat = '{$_POST['alamat']}', kota = '{$_POST['kota']}', telepon = '{$_POST['telepon']}' WHERE id = '{$_GET['id']}'");
    if ($sql) {
        echo "<p>Data berhasil di perbarui</p>";
    } else {
        echo "<p>Data gagal di perbarui: " . mysqli_error($conn) . "</p>";
    }
}
$sql = mysqli_query($conn, "SELECT * FROM penerbit WHERE id = '{$_GET['id']}'");
$row = mysqli_fetch_assoc($sql);
?>
<h2>Input Data Penerbit</h2>
<article>Silahkan Input Data Sesuai Form dibawah ini</article>
<div>
    <form name="penerbit" method="post" action="">
        <label for="id">ID Penerbit</label>
        <input type="text" id="id" name="id" placeholder="ID Penerbit" value="<?= $row['id'] ?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Nama" value="<?= $row['nama'] ?>">

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" placeholder="Alamat"><?= $row['alamat'] ?></textarea>

        <label for="kota">Kota</label>
        <input type="text" id="kota" name="kota" placeholder="Kota" value="<?= $row['kota'] ?>">

        <label for="telepon">Telepon</label>
        <input type="text" id="telepon" name="telepon" placeholder="Telepon" value="<?= $row['telepon'] ?>">

        <input type="submit" name="submit" value="Simpan">
    </form>
</div>