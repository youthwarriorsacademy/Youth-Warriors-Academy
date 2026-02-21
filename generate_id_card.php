<?php
require('fpdf.php');
include "config.php";

$student_id = $_GET['student_id'];

$stmt = $conn->prepare("SELECT * FROM students WHERE student_id=?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,15,'Youth Warriors Academy',0,1,'C');

$pdf->SetFont('Arial','',14);
$pdf->Cell(0,10,'Student ID Card',0,1,'C');
$pdf->Ln(10);

$pdf->Cell(50,10,'Student ID: ');
$pdf->Cell(0,10,$data['student_id'],0,1);

$pdf->Cell(50,10,'Name: ');
$pdf->Cell(0,10,$data['student_name'],0,1);

$pdf->Cell(50,10,'Course: ');
$pdf->Cell(0,10,$data['course'],0,1);

$pdf->Cell(50,10,'Phone: ');
$pdf->Cell(0,10,$data['phone'],0,1);

$pdf->Image($data['image'],150,60,40);

$pdf->Output();
?>