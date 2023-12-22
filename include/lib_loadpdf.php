<?php
require "../class/PDF.php";

$pdf = new PDF();

$pdf->AliasNbPages();

$pdf->AddFont("NotoSans", "", "NotoSansTC-Regular.ttf", true);
$pdf->AddFont("NotoSans", "B", "NotoSansTC-Bold.ttf", true);

$pdf->AddPage();

$pdf->SetFont("NotoSans", "B", 24);
?>