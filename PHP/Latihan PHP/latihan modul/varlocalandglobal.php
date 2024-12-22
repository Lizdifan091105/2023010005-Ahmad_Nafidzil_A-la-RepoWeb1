<?php
// Variabel global
$nama = "Ahmad Nafidzil A'la ";

function tampilNama() {
    // Variabel lokal
    $age = 25;
    $gender="laki-laki";
    
    // Mengakses variabel global
    global $nama;
    
    echo "Nama: $nama<br>";
    echo "Umur: $age";
    echo "gender: $gender";

}

// Memanggil fungsi
tampilNama();
?>
