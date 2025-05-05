<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$q = mysqli_query($conn, "SELECT p.*, u.nama 
                          FROM pengaduan p 
                          JOIN users u ON p.id_user = u.id_user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan Pelanggan</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Data Pengaduan Pelanggan</h2>

    <!-- Kembali Button -->
    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-primary">Kembali</a>
    </div>

    <!-- Tabel Data Pengaduan -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Isi Pengaduan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_assoc($q)) {
                echo "<tr>
                        <td>$no</td>
                        <td>{$data['nama']}</td>
                        <td>{$data['tanggal']}</td>
                        <td>{$data['isi_pengaduan']}</td>
                        <td>{$data['status']}</td>
                        <td>
                            <a href='proses_pengaduan.php?id={$data['id_pengaduan']}' class='btn btn-warning btn-sm'>Proses</a>
                        </td>
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
