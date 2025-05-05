<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];

// Update status pengaduan jadi "selesai"
mysqli_query($conn, "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='$id'");

header('Location: pengaduan.php');
