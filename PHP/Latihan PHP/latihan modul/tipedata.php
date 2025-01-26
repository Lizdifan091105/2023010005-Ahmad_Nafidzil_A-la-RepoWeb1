<?php
// Tipe data array (untuk menyimpan daftar barang)
$barang = ["Beras", "Gula", "Minyak Goreng"];

// Tipe data integer (untuk menyimpan jumlah barang)
$jumlah = [2, 1, 3]; // Dalam satuan (kg/liter)

// Tipe data float (untuk menyimpan harga satuan barang)
$harga = [12.5, 15.0, 13.5]; // Dalam ribuan rupiah

// Tipe data string (untuk nama pembeli)
$pembeli = "Aliyah Fadilah";

// Menghitung total harga setiap barang
$totalHarga1 = $jumlah[0] * $harga[0];
$totalHarga2 = $jumlah[1] * $harga[1];
$totalHarga3 = $jumlah[2] * $harga[2];

// Menghitung total pembayaran
$totalBayar = $totalHarga1 + $totalHarga2 + $totalHarga3;

// Menampilkan detail pembelian
echo "=== Detail Pembelian ===\n";
echo "Nama Pembeli: $pembeli\n";
echo "------------------------\n";
echo "Barang\t\tJumlah\tHarga Satuan\tTotal Harga\n";

echo "{$barang[0]}\t\t{$jumlah[0]}\tRp " . number_format($harga[0], 2) . "\t\tRp " . number_format($totalHarga1, 2) . "\n";
echo "{$barang[1]}\t\t{$jumlah[1]}\tRp " . number_format($harga[1], 2) . "\t\tRp " . number_format($totalHarga2, 2) . "\n";
echo "{$barang[2]}\t{$jumlah[2]}\tRp " . number_format($harga[2], 2) . "\t\tRp " . number_format($totalHarga3, 2) . "\n";

echo "------------------------\n";
echo "Total Bayar: Rp " . number_format($totalBayar, 2) . "\n";
?>
