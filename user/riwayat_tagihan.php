<?php
session_start();
include '../koneksi.php';

// Hanya pelanggan yang boleh akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pelanggan') {
    header('Location: login.php');
    exit;
}

$id_user = $_SESSION['id_user'];
$tagihan = mysqli_query($conn, "SELECT * FROM tagihan WHERE id_user='$id_user' ORDER BY id_tagihan DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Tagihan Saya</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Riwayat Tagihan Saya</h2>

    <div class="d-flex justify-content-center mb-4">
        <a href="dashboard_pelanggan.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Pemakaian (m3)</th>
                    <th>Total Tagihan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($t = mysqli_fetch_assoc($tagihan)) {
                    echo "<tr>
                            <td>$no</td>
                            <td>" . date('F Y', strtotime($t['bulan'])) . "</td>
                            <td>{$t['pemakaian']}</td>
                            <td>Rp " . number_format($t['total_tagihan']) . "</td>
                            <td><span class='badge bg-" . 
                                ($t['status'] == 'belum bayar' ? 'warning' : 'success') . 
                                "'>{$t['status']}</span></td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
