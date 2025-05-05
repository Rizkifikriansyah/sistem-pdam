<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $bulan = $_POST['bulan'];
    $pemakaian = $_POST['pemakaian'];
    $tarif_per_m3 = 5000; // contoh harga per m3
    $total_tagihan = $pemakaian * $tarif_per_m3;

    mysqli_query($conn, "INSERT INTO tagihan 
        (id_user, bulan, pemakaian, total_tagihan, status) 
        VALUES 
        ('$id_user', '$bulan', '$pemakaian', '$total_tagihan', 'belum bayar')");

    header('Location: tagihan.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Tagihan Baru</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Input Tagihan Baru</h2>

    <!-- Kembali Button -->
    <div class="mb-3">
        <a href="tagihan.php" class="btn btn-primary">Kembali</a>
    </div>

    <!-- Form Input Tagihan -->
    <form method="post">
        <div class="mb-3">
            <label for="id_user" class="form-label">Pilih Pelanggan</label>
            <select name="id_user" id="id_user" class="form-select" required>
                <option value="">--Pilih--</option>
                <?php
                $pelanggan = mysqli_query($conn, "SELECT * FROM users WHERE role='pelanggan'");
                while ($p = mysqli_fetch_assoc($pelanggan)) {
                    echo "<option value='{$p['id_user']}'>{$p['nama']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="month" name="bulan" id="bulan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="pemakaian" class="form-label">Pemakaian (m3)</label>
            <input type="number" name="pemakaian" id="pemakaian" class="form-control" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    </form>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
