<?php
session_start();
require('../fpdf186/fpdf.php');
include '../koneksi.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Laporan Tagihan Air', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No', 1);
$pdf->Cell(40, 10, 'Nama', 1);
$pdf->Cell(30, 10, 'Bulan', 1);
$pdf->Cell(30, 10, 'Pemakaian', 1);
$pdf->Cell(40, 10, 'Total', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Ln();

$q = mysqli_query($conn, "SELECT t.*, u.nama 
                          FROM tagihan t 
                          JOIN users u ON t.id_user = u.id_user");
$no = 1;
$pdf->SetFont('Arial', '', 10);

while ($data = mysqli_fetch_assoc($q)) {
    $pdf->Cell(10, 10, $no, 1);
    $pdf->Cell(40, 10, $data['nama'], 1);
    $pdf->Cell(30, 10, $data['bulan'], 1);
    $pdf->Cell(30, 10, $data['pemakaian'], 1);
    $pdf->Cell(40, 10, 'Rp ' . number_format($data['total_tagihan']), 1);
    $pdf->Cell(30, 10, $data['status'], 1);
    $pdf->Ln();
    $no++;
}

$pdf->Output();
