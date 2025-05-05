<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pelanggan') {
    header('Location: ../login.php');
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil total tagihan yang belum dibayar
$tagihan = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tagihan WHERE id_user='$id_user' AND status='belum bayar'");
$t = mysqli_fetch_assoc($tagihan);

// Ambil total pengaduan aktif
$pengaduan = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengaduan WHERE id_user='$id_user' AND status='diproses'");
$p = mysqli_fetch_assoc($pengaduan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pelanggan</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Dashboard Pelanggan</h2>

    <div class="d-flex justify-content-center mb-4">
        <a href="riwayat_tagihan.php" class="btn btn-primary me-2">Riwayat Tagihan</a>
        <a href="pengaduan_saya.php" class="btn btn-warning me-2">Pengaduan Saya</a>
        <a href="tambah_pengaduan.php" class="btn btn-success me-2">Ajukan Pengaduan</a>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tagihan Belum Dibayar</h5>
                    <p class="display-5"><?= $t['total'] ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pengaduan Diproses</h5>
                    <p class="display-5"><?= $p['total'] ?></p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
