<?php
    include ("config/koneksi.php");
    if(isset($_POST['submit'])){
        $sql = mysqli_query($conn, "UPDATE buku SET id = '{$_POST['id']}', kategori = '{$_POST['kategori']}', nama = '{$_POST['nama']}', harga = '{$_POST['harga']}', stok = '{$_POST['stok']}', penerbit_id = '{$_POST['penerbit_id']}' WHERE id = '{$_GET['id']}'");
        if($sql){
            echo "<p>Data berhasil di perbarui</p>";
        }else{
            echo "<p>Data gagal di perbarui: ".mysqli_error($conn)."</p>";
        }
    }
    $sql = mysqli_query($conn, "SELECT * FROM buku WHERE id = '{$_GET['id']}'");
    $row = mysqli_fetch_assoc($sql);
?>
<h2>Input Data Buku</h2>
<article>Silahkan Input Data Sesuai Form dibawah ini</article>
<div>
    <form name="buku" method="post" action="">
        <label for="id">ID Buku</label>
        <input type="text" id="id" name="id" placeholder="ID Buku" value="<?= $row['id'] ?>">

        <label for="kategori">Kategori</label>
        <input type="text" id="kategori" name="kategori" placeholder="Kategori" value="<?= $row['kategori'] ?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Nama" value="<?= $row['nama'] ?>">

        <label for="harga">Harga</label>
        <input type="text" id="harga" name="harga" placeholder="Harga" value="<?= $row['harga'] ?>">

        <label for="stok">Stok</label>
        <input type="text" id="stok" name="stok" placeholder="Stok" value="<?= $row['stok'] ?>">
        
        <label for="penerbit_id">Penerbit</label>
        <select id="penerbit_id" name="penerbit_id">
            <?php
                $query = mysqli_query($conn, "SELECT * FROM `penerbit`");
                while($data=mysqli_fetch_assoc($query)):
            ?>
            <option value="<?= $data['id'] ?>" <?= $row['penerbit_id'] == $data['id'] ? "selected" : "" ?>><?= $data['nama'] ?></option>
            <?php endwhile; ?>
        </select>

        <input type="submit" name="submit" value="Simpan">
    </form>
</div>