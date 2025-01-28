<?php
// Mulai sesi untuk mengecek status login
// session_start();
include './config/db.php';

// Ambil semua kategori untuk filter
$query_kategori = "SELECT * FROM categories";
$categories = mysqli_query($conn, $query_kategori);

// Filter produk berdasarkan kategori (jika ada)

    $query_produk = "SELECT * FROM products";

$products = mysqli_query($conn, $query_produk);

// Periksa apakah ada error dalam query
if (!$categories || !$products) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Toko Bangunan</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
  <style>
    /* General Styling */
body {
    padding-top: 70px; /* Jarak untuk navbar tetap */
    font-family: Arial, sans-serif;
    color: #333;
}


/* Navbar */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 70px;
    background-image: repeating-linear-gradient(
        90deg,
        #2f2f3f,
        #2f2f2f 10px,
        #1a1a1a 10px,
        #1a1a1a 20px
    );
    background-size: 100% 20px;
    background-position: 0 0;
    transition: background-position 0.1s ease;
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}



.navbar.scrolled {
    background-color: #343a40 !important;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.nav-link:hover {
    color: #ffc107 !important;
    text-shadow: 0px 2px 5px rgba(255, 193, 7, 0.7);
    transition: color 0.3s ease, text-shadow 0.3s ease;
}
/* Warna navbar ketika hamburger ditekan */
.navbar-collapse.show {
    background-image: repeating-linear-gradient(
        90deg,
        #2f2f3f,
        #2f2f2f 10px,
        #1a1a1a 10px,
        #1a1a1a 20px
    );
    background-size: 100% 20px;
    background-position: 0 0;
}

/* Animations */
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes zoomInUp {
    0% {
        opacity: 0;
        transform: scale(0.5) translateY(50px);
    }
    100% {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes bounceInUp {
    0% {
        opacity: 0;
        transform: translateY(200px);
    }
    60% {
        opacity: 1;
        transform: translateY(-30px);
    }
    80% {
        transform: translateY(10px);
    }
    100% {
        transform: translateY(0);
    }
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}


/* Animated Section */
.animated-section {
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 1s ease-out, transform 1s ease-out;
}

.animated-section.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Card Styling */
.custom-card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    /* overflow: hidden; */
}

.custom-card:hover {
    transform: translateY(-20px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}
.custom-card img {
    border-bottom: 2px solid #ddd; /* Border under the image */
}

.custom-card .card-img-top {
    object-fit: contain;
    width: 100%;
    padding: 5%;
    height: 300px;
    border-radius: 10px 10px 0 0;
}

/* Button Styling */
.btn-primary {
    background-color: #0074d9;
    border: none;
    border-radius: 25px;
    color: #fff;
    transition: background-color 0.3s ease, transform 0.3s ease;
}
#scrollspyHeading1{
    font-family: 'Arial', 'Helvetica', sans-serif;
    color: #212529; /* Warna teks default */
    background-color: #fff; /* Warna latar belakang default */
    margin: 0;
    padding: 0;
    line-height: 1.5;
}

.btn-primary:hover {
    background-color: #005bb5;
    transform: scale(1.1);
}
.highlight {
    color:rgb(60, 58, 207);
    font-weight: 700;
}
/* CSS Icon Brick */
.css-icon-brick {
    width: 50px;
    height: 50px;
    background-color: #0074d9;
    display: inline-block;
    position: relative;
    box-shadow: 0 0 0 2px #f9f9f9, 10px 10px 0 0 #0074d9, 20px 20px 0 0 #0074d9, 0 10px 0 0 #0074d9, 10px 20px 0 0 #0074d9;
    transform: rotate(45deg);
}

.icon-container {
    animation: bounce 2s infinite;
}

/* Responsive Design */
@media (max-width: 768px) {
    .tab-pane {
    display: none; /* Disembunyikan secara default */
}
.tab-pane.active {
    display: block !important; /* Tampilkan tab aktif */
}

    .produk {
         display: block !important;
    }

    .custom-card {
         display: block !important;
    }

    .custom-layout {
        flex-direction: column;
        height: auto;
    }

    .responsive-bg {
        width: 100%;
        height: 50vh;
    }

    .custom-content {
        width: 100%;
        height: auto;
    }
}

/* Footer */
footer {
    animation: fadeInUp 2s ease-out;
}
/* Mengatur layout section dengan grid */
.d-grid {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Dua kolom dengan lebar sama */
    height: 100%; /* Tinggi penuh */
    gap: 0; /* Tidak ada jarak antar kolom */
}

.left-section {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff; /* Warna latar belakang putih */
    padding: 2rem;
}

.right-section {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa; /* Warna latar belakang abu terang */
}

.responsive-image {
    max-width: 100%;
    height: auto; /* Memastikan gambar responsif */
    border-radius: 0.5rem; /* Opsional: sudut melengkung */
}

.section-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
    color: #333;
}

.section-description {
    font-size: 1.25rem;
    line-height: 1.5;
    color: #555;
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    .d-grid {
        grid-template-columns: 1fr; /* Satu kolom pada layar kecil */
    }

    .left-section, .right-section {
        padding: 1.5rem;
    }
}

#contact {
    background-color: #f9f9f9;
    /* padding-top: 50px; */
}
footer {
    background-color: #343a40;
    color: white;
   
    gap:1px;
    padding:20px;
}

footer a {
    color: white;
    text-decoration: none;
    transition: color 0.3s ease;
}

footer a:hover {
    color: #007bff;
}

footer .fab {
    font-size: 20px;
}

footer .container {
    max-width: 1140px;
}

/* Social Media Icons */
footer .fab {
    margin-right: 15px;
}

footer .fab:hover {
    transform: scale(1.1);
    transition: transform 0.2s;
}
  </style>
</head>
<body>
    <!-- Navbar -->
 <header>
    <nav id="navbar-example2" class="navbar navbar-expand-lg bg-info fixed-top px-3 mb-3">
        <a class="navbar-brand text-white" >Toko </a>
        <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-white" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto nav-pills">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="#scrollspyHeading1">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#scrollspyHeading2">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#produk">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#contact">Contact</a>
                </li>
                <?php if (isset($_SESSION['login'])): ?>
                    <li class="nav-item">
                        <a class="nav-link " href="admin2/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="admin2/login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>



<!-- Content Section (Scrollspy content) -->
<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
    
 
    <!-- Home -->
    <section id="scrollspyHeading1" class="vh-100 d-flex align-items-center justify-content-center animated-section" data-aos="fade-up">
    <div class="container text-center ">
        <div class="icon-container mb-4">
            <div class="css-icon-brick"></div>
        </div>
        <h1 class="display-4 animated-text">
            Selamat Datang di <span class="highlight">Toko Bangunan</span>
        </h1>
        <p class="lead mt-3">
            Solusi terbaik untuk kebutuhan bahan bangunan Anda
        </p>
        <a href="#produk" class="btn btn-primary mt-4 px-4 py-2" data-aos="zoom-in">
            Lihat Produk Kami
        </a>
    </div>
</section>


<section id="scrollspyHeading2" class="vh-100 d-flex flex-column flex-md-row animated-section">
    <!-- Bagian Kiri: Teks -->
    <div class="w-100 w-md-50 d-flex align-items-center bg-white p-5">
        <div data-aos="fade-left" >
            <h2 class="section-title">Tentang Kami</h2>
            <p class="section-description">
                Kami menyediakan berbagai macam bahan bangunan dengan kualitas terbaik. Kepuasan pelanggan adalah prioritas kami.
            </p>
        </div>
    </div>

    <!-- Bagian Kanan: Gambar -->
    <div class="w-100 w-md-50 d-flex justify-content-center align-items-center bg-light">
        <img src="assets/img/679460129e3d57.95984859.jpg" alt="Toko Bangunan" class="responsive-image">
    </div>
</section>
<section id="produk" class="animated-section">
    <div class="container my-5">
        <!-- Tab Navigasi untuk Kategori -->
        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">Semua Produk</button>
            </li>
            <?php 
            $categories = mysqli_query($conn, "SELECT * FROM categories");
            if ($categories && mysqli_num_rows($categories) > 0):
                while ($kategori = mysqli_fetch_assoc($categories)): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-<?= $kategori['id'] ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $kategori['id'] ?>" type="button" role="tab" aria-controls="pills-<?= $kategori['id'] ?>" aria-selected="false">
                            <?= $kategori['nama_kategori'] ?>
                        </button>
                    </li>
                <?php endwhile; 
            endif; ?>
        </ul>

        <!-- Konten Tab untuk Produk -->
        <div class="tab-content" id="pills-tabContent">
            <!-- Tab Semua Produk -->
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                <div class="row">
                    <?php 
                    $products = mysqli_query($conn, "SELECT * FROM products");
                    if ($products && mysqli_num_rows($products) > 0):
                        while ($product = mysqli_fetch_assoc($products)): ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card shadow-lg border-light rounded custom-card">
                                    <img src="assets/img/<?= $product['foto'] ?>" class="card-img-top" alt="<?= $product['nama_produk'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $product['nama_produk'] ?></h5>
                                        <p class="card-text"><?= $product['deskripsi'] ?></p>
                                        <p class="card-text text-success">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
                                        <p class="card-text"><small class="text-muted"><?= $product['ketersediaan'] ?></small></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; 
                    else: ?>
                        <p class="text-center">Produk tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tab Kategori Tertentu -->
            <?php 
            $categories = mysqli_query($conn, "SELECT * FROM categories");
            if ($categories && mysqli_num_rows($categories) > 0):
                while ($kategori = mysqli_fetch_assoc($categories)): ?>
                    <div class="tab-pane fade" id="pills-<?= $kategori['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $kategori['id'] ?>-tab" tabindex="0">
                        <div class="row">
                            <?php 
                            $kategori_id = $kategori['id'];
                            $query_produk_kategori = "SELECT * FROM products WHERE kategori_id = $kategori_id";
                            $products_kategori = mysqli_query($conn, $query_produk_kategori);
                            if ($products_kategori && mysqli_num_rows($products_kategori) > 0):
                                while ($product_kategori = mysqli_fetch_assoc($products_kategori)): ?>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                        <div class="card shadow-lg border-light rounded custom-card">
                                            <img src="assets/img/<?= $product_kategori['foto'] ?>" class="card-img-top" alt="<?= $product_kategori['nama_produk'] ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $product_kategori['nama_produk'] ?></h5>
                                                <p class="card-text"><?= $product_kategori['deskripsi'] ?></p>
                                                <p class="card-text text-success">Rp <?= number_format($product_kategori['harga'], 0, ',', '.') ?></p>
                                                <p class="card-text"><small class="text-muted"><?= $product_kategori['ketersediaan'] ?></small></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; 
                            else: ?>
                                <p class="text-center">Produk untuk kategori ini tidak ditemukan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; 
            endif; ?>
        </div>
    </div>
</section>

<section id="contact" class="animated-section">
    <div class="container py-5">
        <h2 class="text-center mb-4" data-aos="fade-up">Contact Us</h2>
        <div class="row">
            <!-- Google Maps -->
            <div class="col-md-6 mb-4 col-12" data-aos="fade-right">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18..." class="w-100" style="height:300px; border:0;" allowfullscreen=""></iframe> -->
            </div>
            <!-- Contact Form -->
            <div class="col-md-6 col-12" data-aos="fade-left">
            <form method="POST" action="admin2/tambah_feedback.php">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="nama" placeholder="Nama Anda" required>
        <label for="name">Nama Anda</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        <label for="email">Email</label>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Pesan Anda" id="message" name="pesan" style="height: 100px" required></textarea>
        <label for="message">Pesan Anda</label>
    </div>
    <button type="submit" class="btn btn-primary w-100">Kirim</button>
</form>

            </div>
        </div>

        <!-- Additional Contact Information -->
        <div class="row mt-5">
            <div class="col-md-4 col-12">
                <h5>Kontak Kami</h5>
                <p><strong>Alamat:</strong> Jl. Contoh No.123, Jakarta, Indonesia</p>
                <p><strong>Email:</strong> info@example.com</p>
                <p><strong>Telepon:</strong> +62 123 456 789</p>
            </div>
            <div class="col-md-4 col-12">
                <h5>Jam Operasional</h5>
                <p><strong>Senin - Jumat:</strong> 09.00 - 17.00</p>
                <p><strong>Sabtu:</strong> 10.00 - 14.00</p>
                <p><strong>Minggu:</strong> Tutup</p>
            </div>
            <div class="col-md-4 col-12">
                <h5>Sosial Media</h5>
                <p><strong>Facebook:</strong> @example</p>
                <p><strong>Instagram:</strong> @example</p>
                <p><strong>Twitter:</strong> @example</p>
            </div>
        </div>
    </div>
</section>


  <section>
  <footer class="bg-dark text-white ">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-4 col-12">
                <h5>Company Name</h5>
                <p>We are committed to providing the best services to our customers.</p>
            </div>
            <!-- Quick Links -->
            <div class="col-md-4 col-12">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#produk" class="text-white">Products</a></li>
                    <li><a href="#contact" class="text-white">Contact Us</a></li>
                    <li><a href="#about" class="text-white">About Us</a></li>
                    <li><a href="#home" class="text-white">Services</a></li>
                </ul>
            </div>
            <!-- Social Media -->
            <div class="col-md-4 col-12">
                <h5>Follow Us</h5>
                <div>
                    <a href="https://facebook.com" class="text-white me-2" target="_blank">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                    <a href="https://instagram.com" class="text-white me-2" target="_blank">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                    <a href="https://twitter.com" class="text-white me-2" target="_blank">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <small>&copy; 2025 Company Name. All rights reserved.</small>
        </div>
    </div>
</footer>

  </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Navbar scroll effect
            const navbar = document.querySelector(".navbar");
            window.addEventListener("scroll", function () {
                if (window.scrollY > 50) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }
            });

            // AOS initialization
            AOS.init({
                duration: 1000,
                once: true,
            });

            // Animasi untuk komponen saat discroll
            const sections = document.querySelectorAll('.animated-section');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.3 });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
        const activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            const tab = new bootstrap.Tab(document.querySelector(activeTab));
            tab.show();
        }

        const tabs = document.querySelectorAll('.nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                localStorage.setItem('activeTab', `#${tab.getAttribute('data-bs-target').substring(1)}-tab`);
            });
        });
    });
    </script>
</body>
</html>
