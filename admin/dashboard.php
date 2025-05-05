<?php
session_start();
include '../koneksi.php';

// Cek apakah sudah login dan role-nya admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

// Ambil data dashboard
// Total pelanggan
$q1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='pelanggan' AND status='aktif'");
$d1 = mysqli_fetch_assoc($q1);

// Tagihan belum lunas
$q2 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tagihan WHERE status='belum bayar'");
$d2 = mysqli_fetch_assoc($q2);

// Pengaduan aktif
$q3 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengaduan WHERE status='diproses'");
$d3 = mysqli_fetch_assoc($q3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Selamat Datang, <?php echo $_SESSION['nama']; ?> (Admin)</h2>

    <!-- Ringkasan Statistik -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Pelanggan Aktif</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $d1['total']; ?></h5>
                    <p class="card-text">Jumlah pelanggan yang terdaftar dan aktif.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Tagihan Belum Lunas</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $d2['total']; ?></h5>
                    <p class="card-text">Jumlah tagihan yang belum dibayar oleh pelanggan.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Pengaduan Aktif</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $d3['total']; ?></h5>
                    <p class="card-text">Jumlah pengaduan yang sedang diproses.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Akses Admin -->
    <div class="d-flex justify-content-center mb-5">
        <a href="pelanggan.php" class="btn btn-primary me-3">Manajemen Pelanggan</a>
        <a href="tagihan.php" class="btn btn-info me-3">Manajemen Tagihan</a>
        <a href="pengaduan.php" class="btn btn-warning me-3">Manajemen Pengaduan</a>
        <a href="laporan.php" class="btn btn-dark">Laporan</a>
    </div>

    <div class="text-center">
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
