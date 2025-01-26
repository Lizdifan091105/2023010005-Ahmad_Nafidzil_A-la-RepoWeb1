<?php

if(isset($_GET['id'])){
    include ("config/koneksi.php");
    $sql = mysqli_query($conn, "DELETE FROM penerbit WHERE penerbit = '{$_GET['id']}'");
    if($sql){
        echo "<p>Data berhasil di hapus</p>";
    }else{
        echo "<p>Data gagal di hapus: ".mysqli_error($conn)."</p>";
    }
}