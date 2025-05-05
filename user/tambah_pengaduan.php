<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pelanggan') {
    header('Location: login.php');
    exit;
}

if (isset($_POST['kirim'])) {
    $id_user = $_SESSION['id_user'];
    $tanggal = date('Y-m-d');
    $isi = $_POST['isi'];

    mysqli_query($conn, "INSERT INTO pengaduan (id_user, tanggal, isi_pengaduan, status) VALUES ('$id_user', '$tanggal', '$isi', 'menunggu')");

    header('Location: pengaduan_saya.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengaduan Baru</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Pengaduan Baru</h2>

    <div class="d-flex justify-content-center mb-4">
        <a href="pengaduan_saya.php" class="btn btn-secondary">Kembali</a>
    </div>

    <form method="post">
        <div class="mb-3">
            <label for="isi" class="form-label">Isi Pengaduan</label>
            <textarea name="isi" id="isi" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
    </form>
</div>

</body>
</html>
