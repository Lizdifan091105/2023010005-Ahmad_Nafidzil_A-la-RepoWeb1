<?php
echo "Belajar Operator PHP\n\n";

// Operator Aritmatika
echo "Operator Aritmatika\n";
echo "5 + 10 = " . (5 + 10) . "\n";
echo "5 - 10 = " . (5 - 10) . "\n";
echo "5 * 10 = " . (5 * 10) . "\n";
echo "5 / 10 = " . (5 / 10) . "\n";
echo "5 % 10 = " . (5 % 10) . "\n";
echo "5 ** 10 = " . (5 ** 10) . "\n";
$a = 5;
$a = -$a;
echo "a = $a\n\n";

// Operator Penugasan
echo "Operator Penugasan\n";
$a = 15;
echo "int($a)\n";
$a = -5;
echo "int($a)\n";
$a = -500;
echo "int($a)\n\n";

// Operator Perbandingan
echo "Operator Perbandingan\n";
echo "90 > 80 = " . var_export(90 > 80, true) . "\n";
echo "3 < 2 = " . var_export(3 < 2, true) . "\n";
echo "3 <= 6 = " . var_export(3 <= 6, true) . "\n";
echo "5 < 3 = " . var_export(5 < 3, true) . "\n";
echo "'a' < 'b' = " . var_export('a' < 'b', true) . "\n";
echo "'abc' < 'b' = " . var_export('abc' < 'b', true) . "\n";
?>
