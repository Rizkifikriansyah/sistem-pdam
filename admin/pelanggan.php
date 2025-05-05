<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

// Ambil data pelanggan
$q = mysqli_query($conn, "SELECT * FROM users WHERE role='pelanggan'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Data Pelanggan</h2>

    <!-- Kembali dan Tambah Pelanggan Button -->
    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-primary">Kembali</a>
        <a href="tambah_pelanggan.php" class="btn btn-success">Tambah Pelanggan Baru</a>
    </div>

    <!-- Tabel Data Pelanggan -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Alamat</th>
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
                        <td>{$data['no_hp']}</td>
                        <td>{$data['alamat']}</td>
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
