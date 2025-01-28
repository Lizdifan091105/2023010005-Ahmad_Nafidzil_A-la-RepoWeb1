<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM feedback WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback berhasil dihapus!'); window.location='feedback.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
