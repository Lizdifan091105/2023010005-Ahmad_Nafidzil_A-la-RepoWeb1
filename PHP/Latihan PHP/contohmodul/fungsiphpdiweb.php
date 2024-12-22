<html> 
 
<head> 
    <title>Contoh Penggunaan List dalam HTML</title> 
</head> 
 
<body> 
    <h2>Daftar Nama Barang</h2> 
    <ol> 
        <?php 
        for ($i = 1; $i <= 50; $i++) { 
            echo "<li>Barang ke-$i</li>"; 
        } 
        ?> 
    </ol> 
</body> 
 
</html>