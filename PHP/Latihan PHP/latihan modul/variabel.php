<?php
// Variabel Global
$nama = "Ahmad nafidzl A'la";

function tampilkanNama() {
    // Variabel Lokal
    $nama = "Ahmad nafidzil";
    
    // Menampilkan nama lokal
    echo "Nama Lokal: " . $nama . "<br>";
    
    // Mengakses variabel global dengan global keyword
    global $nama;
    echo "Nama Global: " . $nama . "<br>";
}

tampilkanNama();
?>
