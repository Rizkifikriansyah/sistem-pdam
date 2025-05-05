<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

// Ambil data tagihan
$q = mysqli_query($conn, "SELECT t.*, u.nama 
                          FROM tagihan t 
                          JOIN users u ON t.id_user = u.id_user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tagihan Air</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Data Tagihan Air</h2>

    <!-- Kembali Button -->
    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-primary">Kembali</a>
        <a href="tambah_tagihan.php" class="btn btn-success">Input Tagihan Baru</a>
    </div>

    <!-- Tabel Data Tagihan -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Bulan</th>
                <th>Pemakaian (m3)</th>
                <th>Total Tagihan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_assoc($q)) {
                echo "<tr>
                        <td>$no</td>
                        <td>{$data['nama']}</td>
                        <td>" . date('F Y', strtotime($data['bulan'])) . "</td>
                        <td>{$data['pemakaian']}</td>
                        <td>Rp " . number_format($data['total_tagihan']) . "</td>
                        <td>{$data['status']}</td>
                    </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
