<?php 
// Deklarasi variabel 
$txt = "Hello POLIBANG!"; 
$number = 10; 
// Menampilkan nilai variabel 
echo $txt;  // Output: Hello World! 
echo $number; // Output: 10 


//variabrel global
    $x = 5; // global scope 
 
    function myTest() 
    { 
        // penggunan x didalam function akan menghasilkan error 
        echo "<p>Variable x didalam function is: $x</p>"; 
    } 
    myTest(); 
 
    echo "<p>Variable x diluar function is: $x</p>"; 

    function myTest1() 
    { 
        $x = 5; // local scope 
        echo "<p>Variable x inside function is: $x</p>"; 
    } 
    myTest1(); 
 
    // penggunan x diluar function akan menghasilkan error 
    echo "<p>Variable x outside function is: $x</p>\n";

    $x1 = 5; 
    $y1 = 10; 
 
    function myTest2() 
    { 
        global $x1, $y1; 
        $y1 = $x1 + $y1; 
    } 
 
    myTest2(); 
    echo $y1; // outputs 15 
?>

