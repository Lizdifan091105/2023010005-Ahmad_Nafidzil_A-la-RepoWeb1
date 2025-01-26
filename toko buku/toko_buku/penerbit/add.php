<?php
if (isset($_POST['submit'])) {
    include("config/koneksi.php");
    $sql = mysqli_query($conn, "INSERT INTO penerbit VALUES ('{$_POST['id']}', '{$_POST['nama']}', '{$_POST['alamat']}', '{$_POST['kota']}', '{$_POST['telepon']}')");
    if ($sql) {
        echo "<p>Data berhasil di input</p>";
    } else {
        echo "<p>Data gagal di input: " . mysqli_error($conn) . "</p>";
    }
}
?>
<h2>Input Data Penerbit</h2>
<article>Silahkan Input Data Sesuai Form dibawah ini</article>
<div>
    <form name="penerbit" method="post" action="">
        <label for="id">ID Penerbit</label>
        <input type="text" id="id" name="id" placeholder="ID Penerbit">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Nama">

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" placeholder="Alamat"></textarea>

        <label for="kota">Kota</label>
        <input type="text" id="kota" name="kota" placeholder="Kota">

        <label for="telepon">Telepon</label>
        <input type="text" id="telepon" name="telepon" placeholder="Telepon">

        <input type="submit" name="submit" value="Simpan">
    </form>
</div>