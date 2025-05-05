<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Simple. Kalau mau aman bisa pakai password_hash
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO users 
        (username, password, nama, no_hp, alamat, role, status) 
        VALUES 
        ('$username', '$password', '$nama', '$no_hp', '$alamat', 'pelanggan', 'aktif')");
    
    header('Location: pelanggan.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan Baru</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Pelanggan Baru</h2>

    <!-- Kembali Button -->
    <div class="mb-3">
        <a href="pelanggan.php" class="btn btn-primary">Kembali</a>
    </div>

    <!-- Form Tambah Pelanggan -->
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control"></textarea>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    </form>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
