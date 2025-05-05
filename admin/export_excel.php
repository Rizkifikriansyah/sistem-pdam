<?php
session_start();
include '../koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_tagihan.xls");

$q = mysqli_query($conn, "SELECT t.*, u.nama 
                          FROM tagihan t 
                          JOIN users u ON t.id_user = u.id_user");
?>

<h2>Laporan Tagihan Air</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Bulan</th>
        <th>Pemakaian (m3)</th>
        <th>Total Tagihan</th>
        <th>Status</th>
    </tr>
    <?php
    $no = 1;
    while ($data = mysqli_fetch_assoc($q)) {
        echo "<tr>
                <td>$no</td>
                <td>{$data['nama']}</td>
                <td>{$data['bulan']}</td>
                <td>{$data['pemakaian']}</td>
                <td>{$data['total_tagihan']}</td>
                <td>{$data['status']}</td>
              </tr>";
        $no++;
    }
    ?>
</table>
