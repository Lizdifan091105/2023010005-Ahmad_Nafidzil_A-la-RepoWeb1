<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query sederhana untuk mengecek username dan password
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: ../admin2/dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Admin</title>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradasi biru ungu */
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 10px;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            font-weight: bold;
            color: #333;
        }

        .form-floating > label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="logo.png" alt="Logo" class="logo"> <!-- Ganti dengan logo jika ada -->
    <h2 class="text-center mb-4">Login Admin</h2>
    <form method="POST">
        <div class="mb-3 form-floating">
            <input type="text" name="username" class="form-control" id="username" required>
            <label for="username">Username</label>
        </div>
        <div class="mb-3 form-floating">
            <input type="password" name="password" class="form-control" id="password" required>
            <label for="password">Password</label>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <button type="submit" class="btn btn-custom w-100 mb-3">Login</button>
    </form>
    <div class="text-center">
        <a href="../index.php" class="btn btn-secondary w-100">Kembali ke Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
