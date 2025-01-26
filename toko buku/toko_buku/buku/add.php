<?php
    if(isset($_POST['submit'])){
        include ("config/koneksi.php");
        $sql = mysqli_query($conn, "INSERT INTO buku VALUES ('{$_POST['id']}', '{$_POST['penerbit_id']}', '{$_POST['kategori']}', '{$_POST['nama']}', '{$_POST['harga']}', '{$_POST['stok']}')");
        if($sql){
            echo "<p>Data berhasil di input</p>";
        }else{
            echo "<p>Data gagal di input: ".mysqli_error($conn)."</p>";
        }
    }
?>
<h2>Input Data Buku</h2>
<article>Silahkan Input Data Sesuai Form dibawah ini</article>
<div>
    <form name="buku" method="post" action="">
        <label for="id">ID Buku</label>
        <input type="text" id="id" name="id" placeholder="ID buku">

        <label for="kategori">Kategori Buku</label>
        <input type="text" id="kategori" name="kategori" placeholder="Kategori">

        <label for="nama">Nama Buku</label>
        <input type="text" id="nama" name="nama" placeholder="Nama">

        <label for="penerbit_id">Penerbit</label>
        <select id="penerbit_id" name="penerbit_id">
            <?php
                $query = mysqli_query($conn, "SELECT * FROM `penerbit`");
                while($row=mysqli_fetch_assoc($query)):
            ?>
            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="harga">Harga</label>
        <input type="text" id="harga" name="harga" placeholder="Harga">

        <label for="stok">Stok</label>
        <input type="text" id="stok" name="stok" placeholder="Stok">

        <input type="submit" name="submit" value="Simpan">
    </form>
</div>