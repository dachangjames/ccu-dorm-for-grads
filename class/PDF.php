<?php
require "../output/tfpdf.php";

class PDF extends tFPDF {
  const WIDTH = 190;
  const HEIGHT = 265;

  function Footer() {
    $this->SetY(-20);

    $this->SetFont("NotoSans", "", 10);

    $this->Cell(0, 16, "頁 " . $this->PageNo() . " / {nb}", 0, 0, "C");
  }
}

?>