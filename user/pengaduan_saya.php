<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pelanggan') {
    header('Location: login.php');
    exit;
}

$id_user = $_SESSION['id_user'];
$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_user='$id_user' ORDER BY id_pengaduan DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Saya</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Pengaduan Saya</h2>

    <div class="d-flex justify-content-center mb-4">
        <a href="dashboard_pelanggan.php" class="btn btn-secondary me-2">Kembali ke Dashboard</a>
        <a href="tambah_pengaduan.php" class="btn btn-primary">Tambah Pengaduan Baru</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Isi Pengaduan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($d = mysqli_fetch_assoc($pengaduan)) {
                    echo "<tr>
                            <td>$no</td>
                            <td>{$d['tanggal']}</td>
                            <td>{$d['isi_pengaduan']}</td>
                            <td><span class='badge bg-" . 
                                ($d['status'] == 'diproses' ? 'warning' : ($d['status'] == 'selesai' ? 'success' : 'secondary')) . 
                                "'>{$d['status']}</span></td>
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
