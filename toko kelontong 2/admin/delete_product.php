<?php
include '../config.php';
$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header('Location: dashboard.php');
} else {
    echo "Error: " . $conn->error;
}
?>