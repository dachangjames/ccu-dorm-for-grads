<?php
include "../include/lib_loadpdf.php";

$pdf->Cell(0, 16, "碩、博士生宿舍住宿名單", 0, 1, "C");
$pdf->Ln(5);

$pdf->SetFont("NotoSans", "", 15);

for ($i = 0; $i < 10; $i++) {
  $pdf->Cell(50, 10, "lorem" . $i, 1);
  $pdf->Cell(30, 10, "lorem" . $i, 1);
  $pdf->Cell(70, 10, "lorem" . $i, 1);
  $pdf->Cell(40, 10, "lorem" . $i, 1, 1);
}

$pdf->Output('I', '住宿名冊.pdf', true);
?>